<template>
    <div id="assessment-form">
        <h1>Flexibility assessment</h1>
        <p>The way you pay for gas and electricity will probably change; if you 
            can be flexible with your energy demand you may be able to lower your 
            bills.</p>
        <p>Fill out this assessment, to generate a report which will give you information 
            on the flexibility of your energy consumption.</p>

        <h2 style="margin-top:35px">Household data</h2>
        <table id='household-data'>
            <tr>
                <td>Type of property</td>
                <td>
                    <select class="form-control" v-model="assessment.data.household.typeOfPropert">
                        <option value="Short tenement">Short tenement</option>
                        <option value="Retail tenement">Retail tenement</option>
                        <option value="Dense tenement">Dense tenement</option>
                        <option value="Standard tenement">Standard tenement</option>
                        <option value="Basement tenement">Basement tenement</option>
                        <option value="Large individual house">Large individual house</option>
                        <option value="Terrace house">Terrace house</option>
                        <option value="20th century house">20th century house</option>
                        <option value="Other flat block">Other flat block</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Do you know the EPC rating?</td>
                <td>
                    <input type="radio" name="EPC-rating-known" v-model="assessment.data.household.knownEPC" value="Yes"> Yes <input type="radio" name="EPC-rating-known" v-model="assessment.data.household.knownEPC" value="No" v-on:click="assessment.data.household.EPC = 55"> No <br />
                    <div v-if="assessment.data.household.knownEPC == 'Yes'">
                        Rating <input type='number' class="form-control" style="margin-left:25px" v-model='assessment.data.household.EPC' min='0' max='100'>
                    </div>
                </td>
            </tr>
            <tr>
                <td>How many people live in the household? <span title="Including children"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                <td><input type="number" class="form-control" min="1" v-model="assessment.data.household.occupancy"  /> </td>
            </tr>
            <tr>
                <td>Age of the house</td>
                <td>
                    <select class="form-control" v-model="assessment.data.household.ageOfTheHouse">
                        <option value="Pre-1919">Pre-1919</option>    
                        <option value="Post-1919">Post-1919</option>                        
                    </select>        
                </td>
            </tr>
            <tr>
                <td>Tenure</td>
                <td>
                    <select class="form-control" v-model="assessment.data.household.ownerShipStatus">
                        <option value="Private rental">Private rental</option>    
                        <option value="Mid-market rent">Mid-market rent</option>    
                        <option value="Social landlord">Social landlord</option>    
                        <option value="Owner">Owner</option>        
                        <option value="Other">Other</option>    
                    </select>     
                </td>
            </tr>
            <tr v-if="assessment.data.household.ownerShipStatus !== 'Owner'">
                <td>Relationship with landlord</td>
                <td><input type="radio" name="relationshipWithLandlord" value="Good" v-model="assessment.data.household.relationshipWithLandlord" checked /> Good <input type="radio" name="relationshipWithLandlord" value="Complicated" v-model="assessment.data.household.relationshipWithLandlord"/> Complicated<br />
                    Notes <textarea class="form-control" v-model="assessment.data.household.relationshipWithLandlordNotes" ></textarea></td>
            </tr>
            <tr><td></td><td></td></tr>
        </table>


        <h2>Energy assets</h2>
        <table id="energy-assets" class="table">
            <tr> 
                <td>Do you have an immersion heater</td>
                <td>
                    <input type="radio" name="immersionHeater" value="Yes" v-model="assessment.data.immersionHeater.present"  /> Yes <input type="radio" name="immersionHeater" value="No" v-model="assessment.data.immersionHeater.present" checked /> No
                    <div class='heaters' v-if="assessment.data.immersionHeater.present =='Yes'">
                        <table class='heaters'>
                            <tr v-if="!assessment.data.immersionHeater.ratingUnknown"><td>Rating</td><td><input class="form-control" type="number" min="0.1" step="0.1" v-model="assessment.data.immersionHeater.rating" style='display:inline-block' /> kW</td></tr>
                            <tr><td><span v-if="assessment.data.immersionHeater.ratingUnknown">Rating</span></td><td><p><input type="checkbox" class="form-control unknown" v-model="assessment.data.immersionHeater.ratingUnknown" />Unknown</p></td></tr> 
                            <tr>
                                <td>Controls</td>
                                <td>
                                    <select class="form-control" v-model="assessment.data.immersionHeater.controlType">
                                        <option value="None">None</option>
                                        <option value="Thermostat">Thermostat</option>
                                        <option value="Programmer">Programmer</option>
                                        <option value="Advanced controls">Advanced controls</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>

            <tr>
                <td>Do you have storage heaters</td>
                <td>
                    <input type="radio" name="storageHeaters" value="Yes" v-model="assessment.data.storageHeaters.present"  /> Yes <input type="radio" name="storageHeaters" value="No" v-model="assessment.data.storageHeaters.present" checked /> No
                    <table class='heaters' v-if="assessment.data.storageHeaters.present =='Yes'">
                        <tr><td>Manufacturer</td><td><input type='text' class="form-control" v-model='assessment.data.storageHeaters.manufacturer' /></td></tr>
                        <tr><td>Model/make</td><td><input type='text' class="form-control" v-model='assessment.data.storageHeaters.modelMake' /></td></tr>
                        <tr><td>How many?</td><td><input class="form-control" type="number" min="0" step="1" v-model="assessment.data.storageHeaters.number" style='display:inline-block' /></td></tr>
                        <tr v-if="!assessment.data.storageHeaters.ratingUnknown"><td>Rating</td><td><input class="form-control" type="number" min="0.1" step="0.1" v-model="assessment.data.storageHeaters.rating" style='display:inline-block' /> kW</td></tr>
                        <tr><td><span v-if="assessment.data.storageHeaters.ratingUnknown">Rating</span></td><td><p><input type="checkbox" class="form-control unknown" v-model="assessment.data.storageHeaters.ratingUnknown" />Unknown</p></td></tr> 

                        <tr>
                            <td>Controls</td>
                            <td>
                                <select class="form-control" v-model="assessment.data.storageHeaters.controlType">
                                    <option value="Input/output">Input/output</option>
                                    <option value="Timer">Timer</option>
                                    <option value="Advanced controls">Advanced controls</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>Do you have other electric heaters</td>
                <td>
                    <input type="radio" name="otherElectricHeaters" value="Yes" v-model="assessment.data.otherElectricHeaters.present" /> Yes <input type="radio" name="otherElectricHeaters" value="No" v-model="assessment.data.otherElectricHeaters.present" checked /> No
                    <table class='heaters' v-if="assessment.data.otherElectricHeaters.present =='Yes'">
                        <tr><td>Type</td><td>Manufacturer</td><td>Model/make</td><td><button v-on:click='addDevice("otherElectricHeaters")'>Add</button></td></tr>
                        <tr v-for='(heater,index) in assessment.data.otherElectricHeaters.list'>
                            <td><input class="form-control" type='text' v-model='heater.type' /></td>
                            <td><input class="form-control" type='text' v-model='heater.manufacturer' /></td>
                            <td><input class="form-control" type='text' v-model='heater.modelMake' /></td>
                            <td><font-awesome-icon icon="trash" size="xs" title="Delete" style="cursor:pointer" v-on:click='removeDevice("otherElectricHeaters",index)' /></td>
            </tr>
        </table>                    
        </td>
        </tr>

        <tr>
            <td>Do you have any smart home appliances (eg. grid-smart fridge)</td>
            <td>
                <input type="radio" name="smartDevices" value="Yes" v-model="assessment.data.smartDevices.present" /> Yes <input type="radio" name="smartDevices" value="No" v-model="assessment.data.smartDevices.present" checked /> No
                <table class='heaters' v-if="assessment.data.smartDevices.present =='Yes'">
                    <tr><td>Type</td><td>Manufacturer</td><td>Model/make</td><td><button v-on:click='addDevice("smartDevices")'>Add</button></td></tr>
                    <tr v-for='(device,index) in assessment.data.smartDevices.list'>
                        <td><input class="form-control" type='text' v-model='device.type'></td>
                        <td><input class="form-control" type='text' v-model='device.manufacturer'></td>
                        <td><input class="form-control" type='text' v-model='device.modelMake'></td>
                        <td><font-awesome-icon icon="trash" size="xs" title="Delete" style="cursor:pointer" v-on:click='removeDevice("smartDevices",index)' /></td>
        </tr>
        </table>                    
        </td>
        </tr>

        <tr>
            <td>Do you have an electric vehicle </td>
            <td>
                <input type="radio" name="electricVehicle" value="Yes" v-model="assessment.data.electricVehicle.present" /> Yes <input type="radio" name="electricVehicle" value="No" v-model="assessment.data.electricVehicle.present" checked /> No
                <table class='heaters' v-if="assessment.data.electricVehicle.present =='Yes'">
                    <tr><td>Model</td><td><input class="form-control" type='text' v-model='assessment.data.electricVehicle.model' /></td></tr>
                    <tr><td>Charging</td><td><input class="form-control" type='text' v-model='assessment.data.electricVehicle.chargingkW' /> kW</td></tr>
                    <tr><td>Battery</td><td><input class="form-control" type='text' v-model='assessment.data.electricVehicle.batterykWh' /> KWh</td></tr>
                    <tr><td>Charging control system</td><td><input class="form-control" type='text' v-model='assessment.data.electricVehicle.chargingControlSystem' /></td></tr>
                    <tr><td>Estimated Daily Mileage</td><td><input class="form-control" type='text' v-model='assessment.data.electricVehicle.estimatedDailyMileage' /></td></tr>
                </table>                    
            </td>
        </tr>

        <tr>
            <td>Do you have any smart home management tools in use?</td>
            <td>
                <input type="radio" name="smartHomeEnergyManagement" value="Yes" v-model="assessment.data.smartHomeEnergyManagement.present" /> Yes <input type="radio" name="smartHomeEnergyManagement" value="No" v-model="assessment.data.smartHomeEnergyManagement.present" checked /> No
                <table class='heaters' v-if="assessment.data.smartHomeEnergyManagement.present =='Yes'">
                    <tr><td>Type</td><td>Manufacturer</td><td>Model/make</td><td><button v-on:click='addDevice("smartHomeEnergyManagement")'>Add</button></td></tr>
                    <tr v-for='(device,index) in assessment.data.smartHomeEnergyManagement.list'>
                        <td><input class="form-control" type='text' v-model='device.type'></td>
                        <td><input class="form-control" type='text' v-model='device.manufacturer'></td>
                        <td><input class="form-control" type='text' v-model='device.modelMake'></td>
                        <td><font-awesome-icon icon="trash" size="xs" title="Delete" style="cursor:pointer" v-on:click='removeDevice("smartHomeEnergyManagement",index)' /></td>
        </tr>
        </table>                      
        </td>
        </tr>

        <tr><td>Energy Supplier</td><td><input class="form-control" type="text" v-model="assessment.data.energySupplier" /></td></tr>

        <tr>
            <td>Tariff type</td>
            <td>
                <select class="form-control" v-model="assessment.data.tariff.type">
                    <option value="E7">E7</option>    
                    <option value="E10/Comfort+">E10/Comfort+</option>    
                    <option value="Flat rate">Flat rate</option>     
                    <option value="Smart" disabled>Smart</option>    
                </select> 
                <div style="margin: 5px 0">
                    <div v-if="assessment.data.tariff.type != 'Flat rate'" style="vertical-alignment: top">
                        <table class="table-no-style">
                            <tr><td>Name</td><td><input style="margin-left: 15px" class="form-control" type="text" v-model='assessment.data.tariff.name'></td></tr>
                            <tr v-if="!assessment.data.tariff.unknown"><td>Highest rate</td><td><input style="margin-left: 15px" class="form-control" type='number' min='0.01' step="0.01" v-model='assessment.data.tariff.lowRate'> £/kWh</td></tr>
                            <tr v-if="!assessment.data.tariff.unknown"><td>Lowest and highest rate</td><td><input style="margin-left: 15px" class="form-control" type='number' min='0.01' step="0.01" v-model='assessment.data.tariff.highRate'> £/kWh</td></tr>
                            <tr><td><span v-if="assessment.data.tariff.unknown">Difference between lowest and highest rate</span></td><td><p><input type="checkbox" class="form-control unknown" v-model="assessment.data.tariff.unknown" />Unknown</p></td></tr> 
                        </table>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td>Meter payment method</td>
            <td>
                <select class="form-control" v-model="assessment.data.paymentMethod">
                    <option value="Pre-payment">Pre-payment</option>    
                    <option value="Credit">Credit</option>    
                </select> 
            </td>
        </tr>

        <tr><td>Total annual electricity use from bills</td><td><input class="form-control" type="number" min="0" step="1" v-model="assessment.data.energyUse" /> kWh</td></tr>

        <tr>
            <td>Mobile reception</td>
            <td>
                <select class="form-control" v-model="assessment.data.mobileReception">
                    <option value="Yes">Yes</option>    
                    <option value="No">No</option>    
                    <option value="Weak">Weak</option>     
                </select> 
            </td>
        </tr>

        <tr>
            <td>Internet connection</td>
            <td>
                <select class="form-control" v-model="assessment.data.internetConnection">
                    <option value="No">No</option>    
                    <option value="Dial up">Dial up</option>    
                    <option value="Broadband">Broadband</option>     
                </select> 
                <p v-if="assessment.data.internetConnection == 'Broadband'">WiFi <input type="radio" name="wifi" value="Yes" v-model="assessment.data.wifi" /> Yes <input type="radio" name="wifi" value="No" v-model="assessment.data.wifi" checked /> No</p>
            </td>
        </tr>

        <tr><td>Do you have a smart meter?</td><td><input type="radio" name="smartMeter" value="Yes" v-model="assessment.data.smartMeter"  /> Yes <input type="radio" name="smartMeter" value="No" v-model="assessment.data.smartMeter" checked /> No</td></tr></tr>


        </table>
    </div>
</template>

<style scoped>
    .red{
        color:red;
    }
    select{
        max-width:350px 
    }
    select, ol,textarea{
        margin:0;
    }
    li{
        cursor:pointer;
    }
    table{
        margin-bottom: 16px;
    }
    td{
        padding: 2px 15px;
        height:37px;
        vertical-align: top;
    }
    table#energy-assets, table#household-data{
        width: 100%;
    }
    #energy-assets td:first-child, #household-data td:first-child{
        width:280px
    }
    table.heaters{
        width: 100%;
    }
    table.heaters td{
        border:none;
        padding-bottom:0;
        padding-left:0;
        height:15px
    }    
    input[type=number]{
        width:100px;
        display:inline-block;
    }
    .table-no-style, .table-no-style tr, .table-no-style td{
        border: none;
        margin: 0
    }
    input.unknown{
        display: inline-block; 
        width:15px; 
        height:15px; 
        margin: 0 10px 0 15px;
    }
</style>

<script>

    import {AssessmentInput} from './mixins/AssessmentInput.js';
    import {flexibilityModel} from '../../../../public/js/flexibility_model/flex_model.js';

    export default{
        mixins: [AssessmentInput],
        data: function () {
            return {
                flexibilityModel: new flexibilityModel(),
                defaultValues: {
                    tariffLowRate: 0.11, // used Good Energy Economy 7 as reference https://www.goodenergy.co.uk/our-tariffs
                    tariffHighRate: 0.19,
                    storageHeatersRating: 2.7,
                    immersionHeaterRating: 2.5
                }
            };
        },
        methods: {
            addDevice: function (type) {
                this.assessment.data[type].list.push({type: "", manufacturer: "", modelMake: ""});
            },
            removeDevice: function (type, index) {
                this.assessment.data[type].list.splice(index, 1);
            }
        },
        watch: {
            assessment: {
                deep: true,
                handler: function () {
                    let dataForModel = JSON.parse(JSON.stringify(this.assessment.data));
                    if (dataForModel.tariff.type == "Flat rate")
                        dataForModel.tariff.rate = 0;
                    else if (dataForModel.tariff.unknown == true)
                        dataForModel.tariff.rate = this.defaultValues.tariffHighRate - this.defaultValues.tariffLowRate;
                    else
                        dataForModel.tariff.rate = dataForModel.tariff.highRate - dataForModel.tariff.lowRate;
                    dataForModel.immersionHeater.rating = this.defaultValues.immersionHeaterRating;
                    if (dataForModel.storageHeaters.ratingUnknown)
                        dataForModel.storageHeaters.rating = this.defaultValues.storageHeatersRating;
                    console.log(dataForModel)
                    this.flexibilityModel.run(dataForModel);
                    console.log("\nFlexible power available (kW): " + JSON.stringify(dataForModel.powerAvailable));
                    console.log("Flexibility scheduled (hours/year): " + JSON.stringify(dataForModel.flexibilityHoursScheduled));
                    console.log("Flexible load utilised (kWh/year): " + JSON.stringify(dataForModel.loadUtilisedYear));
                    console.log("Income year " + JSON.stringify(dataForModel.incomeYearBySource));
                    console.log("Income year total = " + dataForModel.incomeYearTotal);
                    console.log("Income year household = " + dataForModel.incomeYearTotalHousehold);
                    console.log("Income year aggregator = " + dataForModel.incomeYearTotalAggregator);
                    if (JSON.stringify(this.assessment.data) != JSON.stringify(dataForModel)) {
                        this.assessment.data = dataForModel;
                    }
                }
            }
        },
        created: function () {

            // Initialize required data to run the model

            if (this.assessment.data.household == undefined) {
                Vue.set(this.assessment.data, 'household', {EPC: 55, knownEPC: "No", occupancy: 1}); // default value to use (lowest rate of band D if user doesn't know the real one
            }

            if (this.assessment.data.immersionHeater == undefined) {
                Vue.set(this.assessment.data, 'immersionHeater', {});
                this.assessment.data.immersionHeater = {"present": 'No', rating: 0, controlType: "None", ratingUnknown: false};
            }

            if (this.assessment.data.storageHeaters == undefined) {
                Vue.set(this.assessment.data, 'storageHeaters', {});
                this.assessment.data.storageHeaters = {"present": 'No', number: 0, rating: 0, ratingUnknown: false};
            }

            if (this.assessment.data.otherElectricHeaters == undefined) {
                Vue.set(this.assessment.data, 'otherElectricHeaters', {});
                this.assessment.data.otherElectricHeaters = {"present": 'No', "list": [{type: "", manufacturer: "", modelMake: ""}]};
            }

            if (this.assessment.data.smartDevices == undefined) {
                Vue.set(this.assessment.data, 'smartDevices', {});
                this.assessment.data.smartDevices = {"present": 'No', "list": [{type: "", manufacturer: "", modelMake: ""}]};
            }

            if (this.assessment.data.electricVehicle == undefined) {
                Vue.set(this.assessment.data, 'electricVehicle', {});
                this.assessment.data.electricVehicle = {"present": 'No'};
            }

            if (this.assessment.data.smartHomeEnergyManagement == undefined) {
                Vue.set(this.assessment.data, 'smartHomeEnergyManagement', {});
                this.assessment.data.smartHomeEnergyManagement = {"present": 'No', "list": [{type: "", manufacturer: "", modelMake: ""}]};
            }

            if (this.assessment.data.energySupplier == undefined) {
                Vue.set(this.assessment.data, 'energySupplier', "");
            }

            if (this.assessment.data.tariff == undefined) {
                Vue.set(this.assessment.data, 'tariff', {type: "Flat rate", rate: 0, unknown: false, name: "", highRate: 0, lowRate: 0});
            }

            if (this.assessment.data.energyUse == undefined) {
                Vue.set(this.assessment.data, 'energyUse', 0);
            }

            if (this.assessment.data.mobileReception == undefined) {
                Vue.set(this.assessment.data, 'mobileReception', '');
            }

            if (this.assessment.data.internetConnection == undefined) {
                Vue.set(this.assessment.data, 'internetConnection', '');
            }

            if (this.assessment.data.wifi == undefined) {
                Vue.set(this.assessment.data, 'wifi', '');
            }

            if (this.assessment.data.smartMeter == undefined) {
                Vue.set(this.assessment.data, 'smartMeter', '');
            }
        }
    }

</script>