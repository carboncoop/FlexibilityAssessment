<template>
    <b-card id='organisation-details-component'>
        <table>
            <tr>
                <td>Name</td>
                <td><span dusk="organisation-name-text" v-text="dOrganisation.name" v-if="editMode == false" /><input dusk="organisation-name-input" class="form-control" name="name" v-model='dOrganisation.name'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><span  dusk="organisation-email-text" v-text="dOrganisation.email" v-if="editMode == false" /><input  dusk="organisation-email-input" class="form-control" name="email" v-model='dOrganisation.email'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>Telephone</td>
                <td><span  dusk="organisation-telephone-text" v-text="dOrganisation.telephone" v-if="editMode == false" /><input  dusk="organisation-telephone-input" class="form-control" name="telephone" v-model='dOrganisation.telephone'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>Address 1</td>
                <td><span  dusk="organisation-address1-text" v-text="dOrganisation.address1" v-if="editMode == false" /><input  dusk="organisation-address1-input" class="form-control" name="address1" v-model='dOrganisation.address1'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>Address 2</td>
                <td><span  dusk="organisation-address2-text" v-text="dOrganisation.address2" v-if="editMode == false" /><input  dusk="organisation-address2-input" class="form-control" name="address2" v-model='dOrganisation.address2'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>City/town</td>
                <td><span  dusk="organisation-city_town-text" v-text="dOrganisation.city_town" v-if="editMode == false" /><input  dusk="organisation-city_town-input" class="form-control" name="city_town" v-model='dOrganisation.city_town'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>Postcode</td>
                <td><span  dusk="organisation-postcode-text" v-text="dOrganisation.postcode" v-if="editMode == false" /><input  dusk="organisation-postcode-input" class="form-control" name="postcode" v-model='dOrganisation.postcode'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td>Postcode Zones</td>
                <td><span  dusk="organisation-postcode_zones-text" v-text="dOrganisation.postcode_zones" v-if="editMode == false" /><input  dusk="organisation-postcode_zones-input" class="form-control" name="postcode_zones" v-model='dOrganisation.postcode_zones'  v-if="editMode == true"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" v-on:click="editMode = true" v-if="editMode == false">Edit</button>
                    <button class="btn" v-on:click="editMode = false" v-if="editMode == true">Cancel</button>
                    <button class="btn" v-on:click="saveOrganisationDetails" v-if="editMode == true">Save</button>
                    <p dusk="organisation-edit-error" v-if="error" v-html="error" style="color: red;" />
                </td>
            </tr>
        </table>

    </b-card>
</template>

<style scoped>
    table{
        margin-left: 50px;
    }
    td{
        padding: 10px 15px;
        height: 58px;
    }
    input{
        display:inline-block;
        max-width: 300px;
        padding:0;
    }
</style>

<script>
    import {AxiosErrorCallback} from './mixins/AxiosErrorCallback.js';

    export default {
        mixins: [AxiosErrorCallback],
        props: {
            'organisation': Object
        },
        data: function () {
            return{
                dOrganisation: JSON.parse(JSON.stringify(this.organisation)),
                editMode: false,
                error: false
            };
        },
        methods: {
            saveOrganisationDetails: function () {
                axios.put('/api/organisation/' + this.organisation.id, this.dOrganisation)
                        .then((response) => {
                            this.error = false;
                            this.editMode = false;
                        })
                        .catch((error) => {
                            this.axiosErrorCallback(error);
                        });
            }
        },
        mounted: function () {
            console.log(this.organisation);
        }
    }
</script>
