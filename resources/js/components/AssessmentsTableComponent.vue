<template>
    <div id='assessment-table-component'>
        <table class="table">
            <th>Name</th><th>Description</th><th>Author</th><th>Modified</th><th><button v-b-modal.new-assessment-modal dusk="new-button">New</button></th>
            <tr v-for="assessment in assessmentsList">
                <td v-text="assessment.name"></td>
                <td v-text="assessment.description"></td>
                <td></td>
                <td v-text="assessment.updated_at"></td>
                <td class='assessment-actions'>
                    <button><a class="open-assessment" v-bind:assessment-id="assessment.id" v-bind:href="'/assessment/' + assessment.id + '/edit'"><font-awesome-icon icon="edit" size="xs" title="Open" style="cursor:pointer" /></a></button>
                    <button v-b-modal.delete-assessment-modal class="delete-button" v-bind:assessment-name="assessment.name" v-on:click="setAssessmentToDelete(assessment.id)"><font-awesome-icon icon="trash" size="xs" title="Delete" style="cursor:pointer" /></button>
                </td>
            </tr>
        </table>

        <b-modal id="new-assessment-modal" ref="newAssessmentModal" title="New assessment" 
                 v-on:ok="createAssessment" 
                 v-on:show="error=false" 
                 v-on:hidden="newAssessment.name=''; newAssessment.description=''">
            <p style="color:red" v-if="error">{{error}}</p>
            <table>
                <tr><td>Name</td><td><input type="text" name="name" v-model="newAssessment.name" placeholder="My asessment"></td></tr>
                <tr><td>Description</td><td><input type="text" name="description" v-model="newAssessment.description" placeholder="Description"></td></tr>
            </table>
        </b-modal>

        <b-modal id="delete-assessment-modal" ref ="deleteAssessmentModal" title="Are you sure you want to delete the assessment?" 
                 v-on:ok="deleteAssessment" 
                 v-on:show="error=false">
            <p style="color:red" v-if="error">{{error}}</p>
            <p>This action cannot be undone</p>
        </b-modal>

    </div>
</template>

<style scoped>
    .assessment-actions{
        min-width:125px;
        padding-left: 12px
    }
</style>

<script>
    export default {
        props: {'assessments': Array},
        data: function () {
            return {
                newAssessment: {name: '', description: '', data: {address1:''}},
                error: false,
                assessmentsList: this.assessments,
                assessmentToDelete: 0
            };
        },
        methods: {
            createAssessment: function (evt) {
                this.error = false;
                evt.preventDefault(); // Prevent modal from closing

                if (!this.newAssessment.name) {
                    this.error = 'Please enter your name';
                }
                else {
                    axios.post('/api/assessment', this.newAssessment)
                            .then((response) => {
                                this.assessmentsList.push(response.data);
                                this.$refs.newAssessmentModal.hide();
                            })
                            .catch((error) => {
                                this.error = 'Error - ' + (error.response.data.message || error);
                            })
                }
            },
            setAssessmentToDelete: function (id) {
                this.assessmentToDelete = id;
            },
            deleteAssessment: function (evt) {
                evt.preventDefault(); // Prevent modal from closing
                this.error = false;
                axios.delete("/api/assessment/" + this.assessmentToDelete)
                        .then((response) => {
                            let assessmentToDelete = this.assessmentToDelete;
                            let indexOfAssessment = this.assessmentsList.findIndex(function (assessment) {
                                return assessment.id == assessmentToDelete;
                            });
                            this.assessmentsList.splice(indexOfAssessment, 1);
                            this.$refs.deleteAssessmentModal.hide();
                        })
                        .catch((error) => {
                            this.error = 'Error - ' + (error.response.data.message || error);
                        })
            }

        },
        mounted: function () {
            console.log(this.assessments);
        }
    }
</script>
