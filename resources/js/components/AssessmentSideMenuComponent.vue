<template>
    <div id="assessment-side-menu">
        <p> <strong>Name: {{assessment.name}}</strong> <font-awesome-icon dusk="edit-name-description" icon="edit" title="Edit" style="cursor:pointer" 
                                                                          v-b-modal.edit-metadata-modal size="xs" 
                                                                          v-on:click="iniMetadataModal" />
        </p>
        <p>Description: {{assessment.description}}</p>

        <hr />

        <div id='assessment-navigation'>
            <p>Project input:</p>
            <ul>
                <li dusk="show-questionnaire" v-on:click="$emit('updateView', 'assessment-questionnaire')">Questionnaire</li>
                <li dusk="show-form" v-on:click="$emit('updateView', 'assessment-form')">Assessment</li>
                <li dusk="show-report-feeback" v-on:click="$emit('updateView', 'assessment-report-feedback')">Report feedback</li>
            </ul>
            <p>Other:</p>
            <ul>
                <li dusk="show-report" v-on:click="$emit('updateView', 'assessment-report')">Report</li>
            </ul>
        </div>

        <b-modal id="edit-metadata-modal" ref="editMetadataModal" title="Edit assessment name and description" 
                 v-on:show="error=false"
                 v-on:ok.prevent="saveMetadata" >
            <p style="color:red" v-if="error">{{error}}</p>
            <table>
                <tr><td>Name</td><td><input type="text" v-model="newName" name="name"></td></tr>
                <tr><td>Description</td><td><input type="text" v-model="newDescription" name="description"></td></tr>
            </table>
        </b-modal>
    </div>

</template>

<style scoped>
    #assessment-side-menu{
        max-width:300px;
        position:fixed;
        padding-right: 30px;
    }
    #assessment-navigation p{
        margin-bottom: 0;
    }
    #assessment-navigation ul{
        padding-left: 20px;
    }
    #assessment-navigation li{
        list-style-type: none;
        cursor: pointer;
        margin: 0px;
    }
</style>

<script>
    export default{
        props: {initialAssessment: Object},
        data: function () {
            return{
                newName: '',
                newDescription: '',
                assessment: JSON.parse(JSON.stringify(this.initialAssessment)), // Deep cloning to ensure one way data flow (only from parent component to child)
                error: false
            };
        },
        watch: {
            initialAssessment: {
                deep: true,
                handler: function () {
                    this.assessment = JSON.parse(JSON.stringify(this.initialAssessment));
                }
            }
        },
        methods: {
            iniMetadataModal: function () {
                this.newName = this.assessment.name;
                this.newDescription = this.assessment.description;
            },
            saveMetadata: function () {
                let toSave = JSON.parse(JSON.stringify(this.assessment));
                toSave.name = this.newName;
                toSave.description = this.newDescription;
                let myself = this;
                this.$emit('assessmentChange', toSave,
                        function (response) {
                            console.log(response);
                            //this.name = this.newName;
                            //this.description = this.newDescription;
                            myself.$refs.editMetadataModal.hide();
                        },
                        function (error) {
                            myself.error = 'Error - ' + (error.response.data.message || error);
                        }
                );
            }
        }
    }
</script>