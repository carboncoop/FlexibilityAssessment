<template>
    <div id="assessment-form">
        <h1>Flexibility assessment</h1>
        <p class="red">Do we want an intro here?</p>

        <h2>Household data</h2>
        <table id='household-data'>
            <tr>
                <td>Type of property</td>
                <td>
                    <select class="form-control" v-model="assessment.data.household.typeOfPropert">
                        <option value="Flat (conversion)">Flat (conversion)</option>
                        <option value="Flat (purpose built)">Flat (purpose built)</option>
                        <option value="Mid-terrace">Mid-terrace</option>
                        <option value="End-terrace">End-terrace</option>
                        <option value="Semi-detached">Semi-detached</option>
                        <option value="Detached">Detached</option>
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
                        <option value="A category">A category</option>    
                        <option style="color:red" value="Add categories">Add categories</option>                        
                    </select>        
                </td>
            </tr>
            <tr>
                <td>Ownership status</td>
                <td>
                    <select class="form-control" v-model="assessment.data.household.ownerShipStatus">
                        <option value="Private rental">Private rental</option>    
                        <option value="Social landlord">Social landlord</option>    
                        <option value="Owner">Owner</option>    
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
                <td>Have you got an immersion heater</td>
                <td>
                    <input type="radio" name="immersionHeater" value="Yes" v-model="assessment.data.immersionHeater.present"  /> Yes <input type="radio" name="immersionHeater" value="No" v-model="assessment.data.immersionHeater.present" checked /> No
                    <div class='heaters' v-if="assessment.data.immersionHeater.present =='Yes'">
                        <table class='heaters'>
                            <tr><td>Rating</td><td><input class="form-control" type="number" min="0.1" step="0.1" v-model="assessment.data.immersionHeater.rating" style='display:inline-block' /> kW</td></tr>
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
                <td>Have you got storage heaters</td>
                <td>
                    <input type="radio" name="storageHeaters" value="Yes" v-model="assessment.data.storageHeaters.present"  /> Yes <input type="radio" name="storageHeaters" value="No" v-model="assessment.data.storageHeaters.present" checked /> No
                    <table class='heaters' v-if="assessment.data.storageHeaters.present =='Yes'">
                        <tr><td>Manufacturer</td><td><input type='text' class="form-control" v-model='assessment.data.storageHeaters.manufacturer' /></td></tr>
                        <tr><td>Model/make</td><td><input type='text' class="form-control" v-model='assessment.data.storageHeaters.modelMake' /></td></tr>
                        <tr><td>How many?</td><td><input class="form-control" type="number" min="0" step="1" v-model="assessment.data.storageHeaters.number" style='display:inline-block' /></td></tr>
                        <tr><td>Rating</td><td><input class="form-control" type="number" min="0.1" step="0.1" v-model="assessment.data.storageHeaters.rating" style='display:inline-block' /> kW</td></tr>
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
                <td>Have you got other electric heaters</td>
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
            <td>Have you got any smart device</td>
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
            <td>Have you got an electric vehicle </td>
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
            <td>Have you got any smart home management tools in use <span class='red'>Is this included in other questions (like controls for heating)?</span></td>
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
                <select class="form-control" v-model="assessment.data.tariffType">
                    <option value="E7">E7</option>    
                    <option value="E10/Comfort+">E10/Comfort+</option>    
                    <option value="Flat rate">Flat rate</option>     
                    <option value="Smart">Smart</option>    
                </select> 
            </td>
        </tr>

        <tr><td>Total annual energy use from bills</td><td><input class="form-control" type="number" min="0" step="1" v-model="assessment.data.energyUse" /> kWh</td></tr>

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

        <tr><td>Have you got a smart meter?</td><td><input type="radio" name="smartMeter" value="Yes" v-model="assessment.data.smartMeter"  /> Yes <input type="radio" name="smartMeter" value="No" v-model="assessment.data.smartMeter" checked /> No</td></tr></tr>


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
        max-width: 700px;
    }
    #energy-assets td:first-child, #household-data td:first-child{
        width:280px
    }
    table.heaters{
        width:350px;
    }
    table.heaters td{
        border:none;
        width:300px;
        padding-bottom:0;
        padding-left:0;
        height:15px
    }    
    input[type=number]{
        width:100px;
        display:inline-block;
    }
</style>

<script>

    import {AssessmentInput} from './mixins/AssessmentInput.js';
    import {flexibilityModel} from '../../../../public/js/flexibility_model/flex_model.js';

    export default{
        mixins: [AssessmentInput],
        data: function () {
            return {
                flexibilityModel: new flexibilityModel()
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
                    this.flexibilityModel.run(dataForModel);
                    if (JSON.stringify(this.assessment.data) != JSON.stringify(dataForModel)) {
                        this.assessment.data = dataForModel;
                        console.log("Flexible power " + JSON.stringify(dataForModel.flexiblePower));
                        console.log("Flexible load " + JSON.stringify(dataForModel.flexibleLoad));
                        console.log("Income year " + JSON.stringify(dataForModel.incomeYear));
                        console.log("Income year total = " + dataForModel.incomeYearTotal);
                    }
                }
            }
        },
        created: function () {

            // Initialize required data to run the model

            if (this.assessment.data.household == undefined) {
                Vue.set(this.assessment.data, 'household', {EPC: 55, knownEPC: "No"}); // default value to use (lowest rate of band D if user doesn't know the real one
            }

            if (this.assessment.data.immersionHeater == undefined) {
                Vue.set(this.assessment.data, 'immersionHeater', {});
                this.assessment.data.immersionHeater = {"present": 'No', rating: 1, controlType: "None"};
            }

            if (this.assessment.data.storageHeaters == undefined) {
                Vue.set(this.assessment.data, 'storageHeaters', {});
                this.assessment.data.storageHeaters = {"present": 'No', number: 0, rating: 1};
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

            if (this.assessment.data.tariffType == undefined) {
                Vue.set(this.assessment.data, 'tariffType', "");
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