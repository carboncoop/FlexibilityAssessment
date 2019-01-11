<template>
    <div id="assessment-form">
        <h1>Flexibility assessment</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <h2>Household data</h2>
        <table>
            <tr><td>Address 1</td><td><input name="address1" class="form-control" type="text" v-model="assessment.data.address1" /></td></tr>
            <tr><td>Address 2</td><td><input class="form-control" type="text" v-model="assessment.data.address2" /></td></tr>
            <tr><td>Town</td><td><input class="form-control" type="text" v-model="assessment.data.town" /></td></tr>
            <tr><td>Postcode</td><td><input class="form-control" type="text" v-model="assessment.data.postcode" /></td></tr>
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

</style>

<script>

    import {AssessmentInput} from './mixins/AssessmentInput.js';

    export default{
        mixins: [AssessmentInput]
    }

</script>