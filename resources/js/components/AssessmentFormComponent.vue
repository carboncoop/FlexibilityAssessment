<template>
    <div id="assessment-form">
        <h1>Flexibility assessment</h1>
        <p class="red">Do we want an intro here?</p>

        <h2>Household data</h2>
        <table>
            <tr><td>Address 1</td><td><input name="address1" class="form-control" type="text" v-model="assessment.data.address1" /></td></tr>
            <tr><td>Address 2</td><td><input class="form-control" type="text" v-model="assessment.data.address2" /></td></tr>
            <tr><td>Town</td><td><input class="form-control" type="text" v-model="assessment.data.town" /></td></tr>
            <tr><td>Postcode</td><td><input class="form-control" type="text" v-model="assessment.data.postcode" /></td></tr>
            <tr>
                <td>Type of property</td>
                <td>
                    <select class="form-control" v-model="assessment.data.typeOfProperty">
                        <option value="More than £200 per year">More than £200 per year</option>
                        <option value="£200 per year">£200 per year</option>
                        <option value="£100 per year">£100 per year</option>
                        <option value="£50 per year">£50 per year</option>
                        <option value="£0 / not important to me">£0 / not important to me</option>
                    </select>
                </td>
            </tr>
        </table>
        <h2>Energy assets</h2>
        <table id="energy-assets" class="table">
            <tr> 
                <td>Have you got an Immersion Heater</td>
                <td>
                    <input type="radio" name="immersion-heater" value="Yes" v-model="assessment.data.immersionHeaters"  /> Yes <input type="radio" name="immersion-heater" value="No" v-model="assessment.data.inmersionHeaters" checked /> No
                    <div id="immersion-heater-extra" style="display:none">
                        Rating <input type="number" id="immersion-heater-rating" min="0" v-model="assessment.data.immersionHeatersNumber" /> kW
                    </div>
                </td>
            </tr>
            <tr>
                <td>Have you got Storage Heaters</td>
                <td>
                    <input type="radio" name="storage-heaters" v-model="assessment.data.storageHeaters" value="Yes" /> Yes <input type="radio" name="storage-heaters" v-model="assessment.data.storageHeaters" value="No"  checked /> No
                    <div id="storage-heaters-extra" style="display:none">
                        <p>How many? <input type="number" id="storage-heaters-quantity" v-model="assessment.data.storageHeatersNumber" min="0" /></p>                            
                        <p>Rating <input type="number" id="storage-heaters-rating" v-model="assessment.data.storageHeatersRating" min="0" /> kW</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Have you got an Electric Vehicle</td>
                <td>
                    <input type="radio" name="EV" v-model="assessment.data.electricVehicle" value="Yes" /> Yes <input type="radio" name="EV" v-model="assessment.data.electricVehicle" value="No" checked /> No
                    <div id="EV-extra" style="display:none">
                        Battery <input type="number" id="EV-battery" v-model="assessment.data.electricVehicleBattery" min="0" /> kWh
                    </div>
                </td>
            </tr>
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
        margin:5px 0 35px;
    }
    li{
        cursor:pointer;
    }
</style>

<script>

    import {AssessmentInput} from './mixins/AssessmentInput.js';

    export default{
        mixins: [AssessmentInput]
    }

</script>