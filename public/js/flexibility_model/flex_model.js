function immersion_heater() {
    var immersion_average_kw = 2.0;
    var immersion_availability = 0.8;
    return immersion_average_kw * immersion_availability;
}

function storage_heater(epc_rating) {
    var storage_heater_availability = epc_rating / 100.0;
    var storage_heater_average_kw = 1.5;
    var storage_heater_average_number = 1.5;
    return storage_heater_average_kw * storage_heater_availability * storage_heater_average_number;
}

function flex_model(flex_im_count, flex_im_score, flex_sh_count, flex_sh_score) {
    var immersion_weighting = immersion_heater(flex_im_score / flex_im_count);
    var storage_heater_weighting = storage_heater(flex_sh_score / flex_sh_count);
    return immersion_weighting * flex_im_count + storage_heater_weighting * flex_sh_count;
}

import openBEM from './openBEM/model-r10.js';

/*******************************
 * Flexibility Model
 * 
 * The model calculates how much load can be shifted for different electrical assets 
 * in a household and the potential income this can generate.
 * 
 * The model assumes that the load is shifted: the energy is not used at the time when 
 * it would normally be used but it is used at another time of the day. 
 * 
 * The total income calculation is calculated as the income from flexibility minus 
 * the cost of the energy at a different time of the day (high rate in case of 
 * differential tariffs), for example: the storage heaters will be charged at the 
 * high rate when they normally charge at the low rate. This will still generate 
 * an income for the househod because the fees of the Flexibility scheme will be 
 * higher than the extra expense.
 * 
 * The model is quite verbose with the aim of facilitating its interpretation
 * 
 */

class flexibilityModel {

    constructor() {
        // Default fees - https://flexiblepower.wpdserv.net/flexibility-services
        this.availabilityFee = 0.125;// £/kW/h
        this.utilisationFee = 0.175; // £/kWh

        // Flexibility awarded factors
        this.scheduledAvailabilityFactor = 1; // Fraction of the amount of availablity declared by the household that the Scheme secures and therefor pays for
        this.utilisedLoadFactor = 1; // Fraction of the available load that the scheme utilises and therefor pays for

    }

    run(data) {

        data.flexiblePowerAvailable = {};
        data.flexiblePowerScheduled = {};
        data.flexibleLoadYearUtilised = {};
        data.incomeYear = {};
        data.incomeYearTotal = 0;

        this.ini(data);
        this.storageHeatersFlexibility(data);
        this.immersionHeaterFlexibility(data);

        for (let source in data.incomeYear) {
            data.incomeYearTotal += data.incomeYear[source];
        }

        return data;

    }

    /****************************************************
     *  ini     
     *  
     *  If specified by the user, change the default fees and fractions of 
     *  flexibility scheduleds and utilised by the scheme
     *  
     *  
     *  User inputs:
     *      - data.fees.availability    £/kW/h (Optional)
     *      - data.fees.utilisation     £/kWh (Optional)
     *      - data.flexibilityAwardedFactors.scheduledAvailability      Number (0-1)  (Optional)
     *      - data.flexibilityAwardedFactors.utilisedLoad               Number (0-1)  (Optional)
     *      
     ****************************************************/
    ini(data) {
        if (data.fees != undefined) {
            if (data.fees.availability != undefined)
                this.availabilityFee = data.fees.availability;
            if (data.fees.utilisation != undefined)
                this.utilisationFee = data.fees.utilisation;
        }

        if (data.flexibilityAwardedFactors != undefined) {
            if (data.flexibilityAwardedFactors.scheduledAvailability != undefined)
                this.scheduledAvailabilityFactor = data.flexibilityAwardedFactors.scheduledAvailability;
            if (data.flexibilityAwardedFactors.utilisedLoad != undefined)
                this.utilisedLoadFactor = data.flexibilityAwardedFactors.utilisedLoad;
        }
    }

    /********************************************
     * storageHeatersFlexibility 
     * 
     * The EPC rating is used as the factor by which the amount of the charging 
     * time can be reduced during the normal charging period (night). The aim of 
     * using the EPC is to minimize the impact to the occupants' thermal comfort.
     * 
     * We assume that houses with higher EPCs have better insulation and higher 
     * thermal capacity. In these cases a bigger load can be shifted and the house 
     * will still be at an acceptable temperature.
     * 
     *  Inputs from user:
     *      - data.household.EPC      Integer - defaults to 55 (lowest rate in band D)
     *      - data.storageHeaters.present   boolean or String (Yes/No)
     *      - data.storageHeaters.number    integer
     *      - data.storageHeaters.rating    integer kW
     *      - data.storageHeaters.chargingTime      integer hours/day - defaults to 7
     *      - data.storageHeaters.heatingOffSummer  boolean or String (Yes/No) - defaults to true
     *      
     *  Global outputs:
     *      - data.flexiblePowerAvailable.storageHeaters         kW
     *      - data.flexiblePowerScheduled.storageHeaters         kW
     *      - data.flexibleLoadYearUtilised.storageHeaters      kWh/year
     *      - data.flexibilityIncomeYear.storageHeaters     £
     *      
     *********************************************/

    storageHeatersFlexibility(data) {

        let flexiblePowerAvailable = 0;
        let flexiblePowerScheduled = 0;
        let flexibleLoadYearUtilised = 0;
        let incomeYear = 0;

        if (data.storageHeaters != undefined && (data.storageHeaters.present === true || data.storageHeaters.present == "Yes")) {

            let chargingTimeDay = 7;
            let flexiblePowerFactor = data.household.EPC / 100;

            data.storageHeaters.number = data.storageHeaters.number == undefined ? 0 : 1.0 * data.storageHeaters.number;
            data.storageHeaters.rating = data.storageHeaters.rating == undefined ? 0 : 1.0 * data.storageHeaters.rating;

            let daysOfHeating = 365;
            if (data.storageHeaters.heatingOffSummer != undefined && (data.storageHeaters.heatingOffSummer === true || data.storageHeaters.heatingOffSummer == "Yes"))
                daysOfHeating = 365 - 30 - 31 - 31; // Summer months: June, July and August

            if (data.storageHeaters.chargingTime != undefined)
                chargingTimeDay = data.storageHeaters.chargingTime;

            flexiblePowerAvailable = flexiblePowerFactor * data.storageHeaters.number * data.storageHeaters.rating;
            flexiblePowerScheduled = this.scheduledAvailabilityFactor * flexiblePowerAvailable;

            let flexibleLoadYearAvailable = flexiblePowerScheduled * daysOfHeating * chargingTimeDay;
            flexibleLoadYearUtilised = this.utilisedLoadFactor * flexibleLoadYearAvailable;

            incomeYear = this.incomeFromFlexibility(flexiblePowerScheduled, flexibleLoadYearUtilised, daysOfHeating * chargingTimeDay);

        }

        data.flexiblePowerAvailable.storageHeaters = flexiblePowerAvailable;
        data.flexiblePowerScheduled.storageHeaters = flexiblePowerScheduled;
        data.flexibleLoadYearUtilised.storageHeaters = flexibleLoadYearUtilised;
        data.incomeYear.storageHeaters = incomeYear;
        return data;
    }

    /********************************************
     * immersionHeaterFlexibility 
     * 
     * The model assumes that 80% of the immersion heater power can be shifted. 
     * The remaining 20% is to allow the household keep some control.
     * 
     *  Inputs from user:
     *      - data.household.occupancy      integer
     *      - data.immersionHeater.present   boolean/String  (Yes/No)
     *      - data.immersionHeater.rating    integer kW
     *      - data.immersionHeater.controlType  String (None, Thermostat, Programmer, Advanced controls)
     *      
     *  Global outputs:
     *      - data.flexiblePowerAvailable.immersionHeater     kW
     *      - data.flexiblePowerScheduled.immersionHeater     kW
     *      - data.flexibleLoadYearUtilised.immersionHeater      kWh/year
     *      - data.flexibilityIncomeYear.immersionHeater     £
     *      
     *********************************************/

    immersionHeaterFlexibility(data) {

        let flexiblePowerAvailable = 0;
        let flexiblePowerScheduled = 0;
        let flexibleLoadYearUtilised = 0;
        let incomeYear = 0;

        if (data.immersionHeater != undefined && (data.immersionHeater.present === true || data.immersionHeater.present == "Yes")) {

            let flexiblePowerFactor = 0.8;
            data.immersionHeater.rating = data.immersionHeater.rating == undefined ? 0 : 1.0 * data.immersionHeater.rating;

            let immersionHeatingSystem = this.getImmersionHeaterSystem(data.household.occupancy, data.immersionHeater.controlType);

            let annualWaterHeatingDemand = openBEM.calc.water_heating(immersionHeatingSystem).water_heating.annual_waterheating_demand;
            let timeOfUseYear = annualWaterHeatingDemand / data.immersionHeater.rating;

            flexiblePowerAvailable = flexiblePowerFactor * data.immersionHeater.rating;
            flexiblePowerScheduled = this.scheduledAvailabilityFactor * flexiblePowerAvailable;

            let flexibleLoadAvailable = flexiblePowerScheduled * timeOfUseYear;
            flexibleLoadYearUtilised = this.utilisedLoadFactor * flexibleLoadAvailable;

            incomeYear = this.incomeFromFlexibility(flexiblePowerScheduled, flexibleLoadYearUtilised, timeOfUseYear);
        }

        data.flexiblePowerAvailable.immersionHeater = flexiblePowerAvailable;
        data.flexiblePowerScheduled.immersionHeater = flexiblePowerScheduled;
        data.flexibleLoadYearUtilised.immersionHeater = flexibleLoadYearUtilised;
        data.incomeYear.immersionHeater = incomeYear;

        return data;
    }

    /******************************************
     *  incomeDay
     *  
     *  Calculates the income generated by a flexible asset
     *  
     * @param power Integer kW
     * @param load Integer  kWh
     * @param availability Integer  hours
     * @returns income generated in a day in £
     */
    incomeFromFlexibility(scheduledPower, utilisedLoad, availability) {
        return scheduledPower * availability * this.availabilityFee + utilisedLoad * this.utilisationFee;
    }

    /************************************
     * getImmersionHeaterSystem
     * 
     * Returns a immersion heater system as specified in  openBEM
     */
    getImmersionHeaterSystem(occupancy, controlType) {
        let immersionHeatingSystem = {
            gains_W: {},
            energy_requirements: {},
            occupancy: occupancy,
            water_heating: {
                override_annual_energy_content: false,
                low_water_use_design: false,
                hot_water_control_type: "no_cylinder_thermostat",
                pipework_insulation: "All accesible piperwok insulated",
                storage_type: {
                    category: "Cylinders with immersion",
                    declared_loss_factor_known: false,
                    loss_factor_b: 0.076,
                    manufacturer_loss_factor: 0,
                    name: "Cylinder with electric immersion, 170 litres, 12mm loose fit jacket ",
                    source: "--",
                    storage_volume: 170,
                    tag: "HWS14",
                    temperature_factor_a: 0,
                    temperature_factor_b: 0.6,
                    volume_factor_b: 0.817,
                },
                solar_water_heating: false,
                hot_water_store_in_dwelling: 1
            },
            heating_systems: [{
                    combi_loss: 0,
                    efficiency: 1,
                    fraction_water_heating: 1,
                    instantaneous_water_heating: false,
                    name: "Electric Immersion System",
                    primary_circuit_loss: "No",
                    provides: "water",
                }]
        };

        if (controlType === "Programmer" || controlType === "Advanced controls")
            immersionHeatingSystem.water_heating.hot_water_control_type = "Cylinder thermostat, water heating separately timed";
        else if (controlType === "Thermostat")
            immersionHeatingSystem.water_heating.hot_water_control_type = "Cylinder thermostat, water heating not separately timed";
        
        return immersionHeatingSystem;
    }

}

export {flexibilityModel};