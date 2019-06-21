
/*******************************
 * Flexibility Model
 * 
 * The model calculates how much load can be shifted for different electrical assets 
 * in a household and the potential income this can generate.
 * 
 * The model assumes that the load is shifted: the energy is not used at the time when 
 * it would normally be used but it is used at another time of the day. 
 *  
 * The total income is calculated as the income from flexibility minus 
 * the cost of the energy used at a different time of the day. For simplicity only 
 * one electrical tariff rate is used (for differential tariffs the high rate ahould be used).
 * 
 * The model is quite verbose with the aim of facilitating its interpretation.
 * 
 */


import openBEM from './openBEM/model-r10.js';


class flexibilityModel {

    constructor() {
        console.log("Debug Flexibility model");

        // Default values

        // Fees - https://flexiblepower.wpdserv.net/flexibility-services - Secure service
        this.availabilityFee = 0.125;// £/kW/h
        this.utilisationFee = 0.175; // £/kWh

        // The amount of of load shifted is calculated depending on the amount of hours 
        // the DNO schedules. The model allows for 2 posibilities:
        //      - The household declares how much time the load is available and 
        //      the DNO accepts certain amount of it (this is defined by the scheduledAvailabilityFactor)
        //      This is more likely to be useful in the future.
        //      - There is an estimated amount of hours per year that the DNO will 
        //      require to shift the load (defined by dnoEstimatedAvailabilityRequired)
        //      This is currently more realistic to use.
        // Which one to use is defined by the user: data.useDnoEstimatedHoursRequired (defaults to true)
        this.scheduledAvailabilityFactor = 1;
        this.dnoEstimatedAvailabilityRequired = 68; // hours/year

        // Fraction of the available load that the scheme utilises and therefor pays for
        this.utilisedLoadFactor = 1;

        // Electric tariff rate difference. We assume that, in the cases that the 
        // household has a differential rate, the shift is done from low to high rate
        this.electricalTariffRateDifferenceDifference = 0.08;     // £/kWh

        // Fraction deducted from household income and kept by the aggregator
        this.aggregatorFeeFactor = 0.3;

        // Income from other flexixibility option
        this.incomeFromOtherFlexibilityFactor = 10; // £/kW - raugh estimation

    }

    run(data) {

        data.powerAvailable = {};
        data.flexibilityHoursScheduled = {};
        data.loadUtilisedYear = {};
        data.incomeYearBySource = {};
        data.incomeYearTotal = 0;
        data.incomeYearTotalHousehold = 0;
        data.incomeYearTotalAggregator = 0;

        this.ini(data);
        this.storageHeatersFlexibility(data);
        this.immersionHeaterFlexibility(data);

        for (let source in data.incomeYearBySource) {
            data.incomeYearTotal += data.incomeYearBySource[source];
            data.incomeYearTotalHousehold += (1 - this.aggregatorFeeFactor) * data.incomeYearBySource[source];
            data.incomeYearTotalAggregator += this.aggregatorFeeFactor * data.incomeYearBySource[source];
        }

        return data;

    }

    /****************************************************
     *  ini     
     *  
     *  If specified by the user, we change the 
     *  - default fees
     *  - fractions of flexibility scheduleds and utilised by the scheme
     *  - diference in electric tariff rate at which the shifted load will be paid
     *  - the fraction of the income kept by the aggregator
     *  
     *  
     *  User inputs:
     *      - data.fees.availability    £/kW/h (Optional)
     *      - data.fees.utilisation     £/kWh (Optional)
     *      - data.flexibilityAwardedFactors.scheduledAvailability      Number (0-1)  (Optional)
     *      - data.flexibilityAwardedFactors.utilisedLoad               Number (0-1)  (Optional)
     *      - data.electricalTariffRateDifference     £/kWh (Optional)
     *      - data.dnoEstimatedAvailabilityRequired     hours/year (Optional)
     *      - data.aggregatorFeeFactor  Number (0-1)   (Optional)
     *      - data.incomeFromOtherFlexibilityFactor £/kW (Optional)
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

        if (data.tariff != undefined && data.tariff.rate != undefined)
            this.electricalTariffRateDifference = data.tariff.rate;

        if (data.dnoEstimatedAvailabilityRequired != undefined)
            this.dnoEstimatedAvailabilityRequired = data.dnoEstimatedAvailabilityRequired;

        if (data.aggregatorFeeFactor != undefined)
            this.aggregatorFeeFactor = data.aggregatorFeeFactor;

        if (data.incomeFromOtherFlexibilityFactor != undefined)
            this.incomeFromOtherFlexibilityFactor = data.incomeFromOtherFlexibilityFactor;
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
     *      - data.useDnoEstimatedHoursRequired.use      boolean or String (Yes/No) - defaults to true
     *      
     *  Global outputs:
     *      - data.powerAvailable.storageHeaters         kW
     *      - data.flexibilityHoursScheduled.storageHeaters         hours
     *      - data.loadUtilisedYear.storageHeaters      kWh/year
     *      - data.flexibilityIncomeYear.storageHeaters     £
     *      
     *********************************************/

    storageHeatersFlexibility(data) {

        let powerAvailable = 0;
        let flexibilityHoursScheduled = 0;
        let loadUtilisedYear = 0;
        let incomeYear = 0;

        if (data.storageHeaters != undefined && (data.storageHeaters.present === true || data.storageHeaters.present == "Yes")) {

            let flexiblePowerFactor = data.household.EPC / 100;

            data.storageHeaters.number = data.storageHeaters.number == undefined ? 0 : 1.0 * data.storageHeaters.number;
            data.storageHeaters.rating = data.storageHeaters.rating == undefined ? 0 : 1.0 * data.storageHeaters.rating;

            powerAvailable = flexiblePowerFactor * data.storageHeaters.number * data.storageHeaters.rating;

            if (data.useDnoEstimatedHoursRequired == undefined || data.dnoEstimatedHourRequired == "Yes" || data.dnoEstimatedHourRequired === true)
                flexibilityHoursScheduled = this.dnoEstimatedAvailabilityRequired;
            else {
                let chargingTimeDay = data.storageHeaters.chargingTime != undefined ? data.storageHeaters.chargingTime : 7;
                let daysOfHeating = 365 - 30 - 31 - 31; // Summer months: June, July and August;
                if (data.storageHeaters.heatingOffSummer != undefined && (data.storageHeaters.heatingOffSummer === false || data.storageHeaters.heatingOffSummer == "No"))
                    daysOfHeating = 365;
                flexibilityHoursScheduled = this.scheduledAvailabilityFactor * daysOfHeating * chargingTimeDay;
            }

            let flexibleLoadYearAvailable = powerAvailable * flexibilityHoursScheduled;
            loadUtilisedYear = this.utilisedLoadFactor * flexibleLoadYearAvailable;

            incomeYear = this.incomeFromFlexibility(powerAvailable, loadUtilisedYear, flexibilityHoursScheduled);

        }

        data.powerAvailable.storageHeaters = powerAvailable;
        data.flexibilityHoursScheduled.storageHeaters = flexibilityHoursScheduled;
        data.loadUtilisedYear.storageHeaters = loadUtilisedYear;
        data.incomeYearBySource.storageHeaters = incomeYear;
        return data;
    }

    /********************************************
     * immersionHeaterFlexibility 
     * 
     * The model assumes that 80% of the immersion heater power can be shifted. 
     * The remaining 20% is to allow the household keep some control.
     * 
     *  Inputs from user:
     *      - data.household.occupancy      integer (not used when useDnoEstimatedHoursRequired == true)
     *      - data.immersionHeater.present   boolean/String  (Yes/No)
     *      - data.immersionHeater.rating    integer kW
     *      - data.immersionHeater.controlType  String (None, Thermostat, Programmer, Advanced controls)
     *      - data.useDnoEstimatedHoursRequired      boolean or String (Yes/No) - defaults to true
     *      
     *  Global outputs:
     *      - data.powerAvailable.immersionHeater     kW
     *      - data.flexibilityHoursScheduled.immersionHeater     hours
     *      - data.loadUtilisedYear.immersionHeater      kWh/year
     *      - data.flexibilityIncomeYear.immersionHeater     £
     *      
     *********************************************/

    immersionHeaterFlexibility(data) {

        let powerAvailable = 0;
        let flexibilityHoursScheduled = 0;
        let loadUtilisedYear = 0;
        let incomeYear = 0;

        if (data.immersionHeater != undefined && (data.immersionHeater.present === true || data.immersionHeater.present == "Yes")) {

            let flexiblePowerFactor = 0.8;
            data.immersionHeater.rating = data.immersionHeater.rating == undefined ? 0 : 1.0 * data.immersionHeater.rating;
            powerAvailable = flexiblePowerFactor * data.immersionHeater.rating;

            if (data.useDnoEstimatedHoursRequired == undefined || data.useDnoEstimatedHoursRequired.use == undefined || data.dnoEstimatedHourRequired.use == "Yes" || data.dnoEstimatedHourRequired === true)
                flexibilityHoursScheduled = this.dnoEstimatedAvailabilityRequired;
            else {
                let immersionHeatingSystem = this.getImmersionHeaterSystem(data.household.occupancy, data.immersionHeater.controlType);
                let annualWaterHeatingDemand = openBEM.calc.water_heating(immersionHeatingSystem).water_heating.annual_waterheating_demand;
                let timeOfUseYear = annualWaterHeatingDemand / data.immersionHeater.rating;
                flexibilityHoursScheduled = this.scheduledAvailabilityFactor * timeOfUseYear;
            }

            let flexibleLoadAvailable = powerAvailable * flexibilityHoursScheduled;
            loadUtilisedYear = this.utilisedLoadFactor * flexibleLoadAvailable;

            incomeYear = this.incomeFromFlexibility(powerAvailable, loadUtilisedYear, flexibilityHoursScheduled);
        }

        data.powerAvailable.immersionHeater = powerAvailable;
        data.flexibilityHoursScheduled.immersionHeater = flexibilityHoursScheduled;
        data.loadUtilisedYear.immersionHeater = loadUtilisedYear;
        data.incomeYearBySource.immersionHeater = incomeYear;

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
    incomeFromFlexibility(power, utilisedLoad, availability) {
        return power * availability * this.availabilityFee
                + utilisedLoad * this.utilisationFee
                - utilisedLoad * this.electricalTariffRateDifference
                + power * this.incomeFromOtherFlexibilityFactor;
    }

    /************************************
     * getImmersionHeaterSystem
     * 
     * Returns a immersion heater system as specified in  openBEM
     * 
     * @param occupancy Integer
     * @param controlType   String (None, Thermostat, Programmer, Advanced controls)
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