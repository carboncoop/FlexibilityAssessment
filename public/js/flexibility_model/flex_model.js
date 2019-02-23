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
 * The model assumes a flat tariff: the cost for the user is the same independently 
 * of when the energy is used. This way the income is calculated exclusively as 
 * revenue from the Flexibilty scheme.
 * 
 * For households with a differential tariff (like economy 7) the model overestimates 
 * the potential income. For example, the storage heaters will be charged at the 
 * high rate when they normally charge at the low rate. This would still generate 
 * an income for the househod because the fees of the Flexibility scheme will be 
 * higher than the extra expense. A more accurate calculation could be done if we 
 * knew the cost of the energy on each period of the differential tariff.
 * 
 */

class flexibilityModel {

    // Default fees 
    // https://flexiblepower.wpdserv.net/flexibility-services
    constructor() {
        this.availabilityFee = 0.125;// £/kW/h
        this.utilisationFee = 0.175; // £/kWh

    }

    run(data) {

        data.flexiblePower = [];
        data.flexibleLoad = [];
        data.incomeYear = [];

        this.iniFees(data);
        this.storageHeatersFlexibility(data);
        this.immersionHeaterFlexibility(data);
        return data;

    }

    /****************************************************
     *  iniFees      
     *  Change the default fees if specified by the user
     ****************************************************/
    iniFees(data) {
        if (data.fees != undefined) {
            if (data.fees.availability != undefined)
                this.availabilityFee = data.fees.availability;
            if (data.fees.utilisation != undefined)
                this.utilisationFee = data.fees.utilisation;
        }
    }

    /********************************************
     * storageHeatersFlexibility 
     * 
     * The EPC rating is used as the factor by which the amount of the charging 
     * time can be reduced during the normal charging period (night). The aim of 
     * using the EPC is to minimize the impact to the occupants thermal comfort.
     * 
     * We assume that houses with higher EPCs have better insulation and higher 
     * thermal capacity. In these cases a bigger load can be shifted and the house 
     * will still be at an acceptable temperature.
     * 
     * The income is calculated assuming all the available load is shifted (flexibleLoadFactor = 1)
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
     *      - data.flexiblePower.storageHeaters         kW
     *      - data.flexibleLoadYear.storageHeaters      kWh/year
     *      - data.flexibilityIncomeYear.storageHeaters     £
     *      
     *********************************************/

    storageHeatersFlexibility(data) {

        let flexiblePower = 0;
        let flexibleLoadYear = 0;
        let incomeYear = 0;

        if (data.storageHeaters != undefined && (data.storageHeaters.present === true || data.storageHeaters.present == "Yes")) {

            let chargingTimeDay = 7;
            let flexiblePowerFactor = data.household.EPC / 100;
            let flexibleLoadFactor = 1;
            data.storageHeaters.number = data.storageHeaters.number == undefined ? 0 : 1.0 * data.storageHeaters.number;
            data.storageHeaters.rating = data.storageHeaters.rating == undefined ? 0 : 1.0 * data.storageHeaters.rating;

            let daysOfHeating = 365;
            if (data.storageHeaters.heatingOffSummer != undefined && (data.storageHeaters.heatingOffSummer === true || data.storageHeaters.heatingOffSummer == "Yes"))
                daysOfHeating = 365 - 30 - 31 - 31; // Summer months: June, July and August

            if (data.storageHeaters.chargingTime != undefined)
                chargingTimeDay = data.storageHeaters.chargingTime;

            flexiblePower = flexiblePowerFactor * data.storageHeaters.number * data.storageHeaters.rating;
            flexibleLoadYear = flexibleLoadFactor * flexiblePower * daysOfHeating * chargingTimeDay;
            incomeYear = this.incomeFromFlexibility(flexiblePower, flexibleLoadYear, daysOfHeating * chargingTimeDay);

        }

        data.flexiblePower.storageHeaters = flexiblePower;
        data.flexibleLoad.storageHeaters = flexibleLoadYear;
        data.incomeYear.storageHeaters = incomeYear;
        return data;
    }

    /********************************************
     * immersionHeaterFlexibility 
     * 
     * The model assumes that 80% of the immersion heater power can be shifted. 
     * The remaining 20% is to allow the household keep some control.
     * The income is calculated assuming all the available load is shifted (flexibleLoadFactor = 1)
     * 
     *  Inputs from user:
     *      - data.household.occupancy      integer
     *      - data.immersionHeater.present   boolean/String  (Yes/No)
     *      - data.immersionHeater.rating    integer kW
     *      
     *  Global outputs:
     *      - data.flexiblePower.immersionHeater     kW
     *      - data.flexibleLoadYear.immersionHeater      kWh/year
     *      - data.flexibilityIncomeYear.immersionHeater     £
     *      
     *********************************************/

    immersionHeaterFlexibility(data) {

        let flexiblePower = 0;
        let flexibleLoad = 0;
        let incomeYear = 0;

        if (data.immersionHeater != undefined && (data.immersionHeater.present === true || data.immersionHeater.present == "Yes")) {

            let flexiblePowerFactor = 0.8;
            let flexibleLoadFactor = 1;
            data.immersionHeater.rating = data.immersionHeater.rating == undefined ? 0 : 1.0 * data.immersionHeater.rating;

            let immersionHeatingSystem = {// this is a typical hot immersion heater system that we can pass as an input to openBEM
                gains_W: {},
                energy_requirements: {},
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
                }
            };
            if (data.immersionHeater.controlType === "Programmer" || data.immersionHeater.controlType === "Advanced controls")
                immersionHeatingSystem.water_heating.hot_water_control_type = "Cylinder thermostat, water heating separately timed";
            else if (data.immersionHeater.controlType === "Thermostat")
                immersionHeatingSystem.water_heating.hot_water_control_type = "Cylinder thermostat, water heating not separately timed";

            let annualWaterHeatingDemand = openBEM.calc.water_heating(immersionHeatingSystem).water_heating.annual_waterheating_demand;
            //annualWaterHeatingDemand = annualWaterHeatingDemand.annual_waterheating_demand;
            let timeOfUseYear = annualWaterHeatingDemand / data.immersionHeater.rating;
            flexiblePower = flexiblePowerFactor * data.immersionHeater.rating;
            flexibleLoad = flexibleLoadFactor * flexiblePower * timeOfUseYear;
            let incomeYear = this.incomeFromFlexibility(flexiblePower, flexibleLoad, timeOfUseYear);
        }

        data.flexiblePower.immersionHeater = flexiblePower;
        data.flexibleLoad.immersionHeater = flexibleLoad;
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
    incomeFromFlexibility(power, load, availability) {
        return power * availability * this.availabilityFee + load * this.utilisationFee;
    }

    validateData(data, defaults) {
        for (let z in defaults)
        {
            if (data[z] == undefined)
                data[z] = defaults[z];
        }
        return data;
    }
}

export {flexibilityModel};