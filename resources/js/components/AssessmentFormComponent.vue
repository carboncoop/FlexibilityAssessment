<template>
    <div id="assessment-form">
        <h1>Flexibility assessment</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <h2>Household data</h2>
        <table>
            <tr><td>Address 1</td><td><input class="form-control" type="text" v-model="data.address1" /></td></tr>
            <tr><td>Address 2</td><td><input class="form-control" type="text" v-model="data.address2" /></td></tr>
            <tr><td>Town</td><td><input class="form-control" type="text" v-model="data.town" /></td></tr>
            <tr><td>Postcode</td><td><input class="form-control" type="text" v-model="data.postcode" /></td></tr>
        </table>
        <h2>Energy assets</h2>
        <table id="energy-assets" class="table">
            <tr>
                <td>Have you got an Immersion Heater</td>
                <td>
                    <input type="radio" name="immersion-heater" value="Yes" v-model="data.immersionHeaters"  /> Yes <input type="radio" name="immersion-heater" value="No" v-model="data.inmersionHeaters" checked /> No
                    <div id="immersion-heater-extra" style="display:none">
                        Rating <input type="number" id="immersion-heater-rating" min="0" v-model="data.immersionHeatersNumber" /> kW
                    </div>
                </td>
            </tr>
            <tr>
                <td>Have you got Storage Heaters</td>
                <td>
                    <input type="radio" name="storage-heaters" v-model="data.storageHeaters" value="Yes" /> Yes <input type="radio" name="storage-heaters" v-model="data.storageHeaters" value="No"  checked /> No
                    <div id="storage-heaters-extra" style="display:none">
                        <p>How many? <input type="number" id="storage-heaters-quantity" v-model="data.storageHeatersNumber" min="0" /></p>                            
                        <p>Rating <input type="number" id="storage-heaters-rating" v-model="data.storageHeatersRating" min="0" /> kW</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Have you got an Electric Vehicle</td>
                <td>
                    <input type="radio" name="EV" v-model="data.electricVehicle" value="Yes" /> Yes <input type="radio" name="EV" v-model="data.electricVehicle" value="No" checked /> No
                    <div id="EV-extra" style="display:none">
                        Battery <input type="number" id="EV-battery" v-model="data.electricVehicleBattery" min="0" /> kWh
                    </div>
                </td>
            </tr>
        </table>

    </div>
</template>

<style scoped>

</style>

<script>
    export default{
        props: {initialAssessment: Object},
        data: function () {
            return{
                name: this.initialAssessment.name,
                description: this.initialAssessment.description,
                author: this.initialAssessment.author,
                data: this.initialAssessment.data
                //data: JSON.parse(this.initialAssessment.data)
            };
        },
        watch: {
            data: {
                deep: true,
                handler: function (newData) {
                    this.debouncedSaveData();
                }
            }
        },
        created: function () {
            this.debouncedSaveData = this.debounce(this.saveData, 1500);
        },
        mounted: function () {
            console.log(this.initialAssessment);
        },
        methods: {
            saveData: function (newData) {
                let toSave = this.initialAssessment;
                toSave.data = this.data;
                axios.put('/api/assessment/' + this.initialAssessment.id, toSave)
                        .then(function(){console.log('data saved')})
                        .catch((error) => {
                            window.alert('Error saving the data - ' + (error.response.data.message || error));
                        });
            },
            debounce: function (func, delay) {
                let inDebounce;
                return function () {
                    const context = this
                    const args = arguments
                    clearTimeout(inDebounce)
                    inDebounce = setTimeout(() => func.apply(context, args), delay)
                }
            }
        }
    }




    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    // from https://davidwalsh.name/javascript-debounce-function
    function debounce(func, delay) {
        let inDebounce
        return function () {
            const context = this
            const args = arguments
            clearTimeout(inDebounce)
            inDebounce = setTimeout(() => func.apply(context, args), delay)
        }
    }
</script>