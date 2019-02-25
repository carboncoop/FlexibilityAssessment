<template>
    <div id='assessment-table-component'>
        <button v-b-modal.new-assessment-modal dusk="new-button" style='float:right; margin: 0 25px 10px; cursor: pointer'>New</button>
        <p>Filter assessments <input v-model='filter' type='text' class='form-control filter'></p>
        <b-table striped hover responsive fixed :items="assessmentsForTable" :fields="tableColumns" :outlined="true">
                 <template slot="actions" slot-scope="data">
                     <a class="open-assessment" v-bind:assessment-id="data.item.id" v-bind:href="'/assessment/' + data.item.id + '/edit'"><button><font-awesome-icon icon="edit" size="xs" title="Open" style="cursor:pointer" /></button></a>
                <button v-b-modal.delete-assessment-modal class="delete-button" v-bind:assessment-name="data.item.name" v-on:click="setAssessmentToDelete(data.item.id)"><font-awesome-icon icon="trash" size="xs" title="Delete" style="cursor:pointer" /></button>
            </template>
        </b-table>

        <b-modal id="new-assessment-modal" ref="newAssessmentModal" title="New assessment" 
                 v-on:ok="createAssessment" 
                 v-on:show="error=false" 
                 v-on:hidden="newAssessment.name=''; newAssessment.description=''; newAssessment.address1=''; newAssessment.address2=''; newAssessment.town=''; newAssessment.postcode=''; newAssessment.email=''">
            <p style="color:red" v-if="error" v-html="error"></p>
            <table>
                <tr><td>Name*</td><td><input type="text" name="name" class="form-control" v-model="newAssessment.name" placeholder="My asessment"></td></tr>
                <tr><td>Description</td><td><input type="text" name="description" class="form-control" v-model="newAssessment.description" placeholder="Description"></td></tr>
                <tr><td>Address 1</td><td><input type="text" name="address1" class="form-control" v-model="newAssessment.address1" placeholder="Address 1"></td></tr>
                <tr><td>Address 2</td><td><input type="text" name="address2" class="form-control" v-model="newAssessment.address2" placeholder="Address 2"></td></tr>
                <tr><td>Town</td><td><input type="text" name="town" class="form-control" v-model="newAssessment.town" placeholder="Glasgow"></td></tr>
                <tr><td>Postcode*</td><td><input type="text" name="postcode" class="form-control" v-model="newAssessment.postcode" placeholder="G41..."></td></tr>
                <tr><td>Contact email*</td><td><input type="email" name="email" class="form-control" v-model="newAssessment.email" placeholder="myemail@domain.com"></td></tr>
            </table>
        </b-modal>

        <b-modal id="delete-assessment-modal" ref ="deleteAssessmentModal" title="Are you sure you want to delete the assessment?" 
                 v-on:ok="deleteAssessment" 
                 v-on:show="error=false">
            <p style="color:red" v-if="error" v-html="error"></p>
            <p>This action cannot be undone</p>
        </b-modal>

    </div>
</template>

<style scoped>
    .filter{
        max-width:250px;
        display:inline-block;
    }
</style>

<script>
    export default {
        props: {
            'assessments': Array,
            'administratorView': Boolean
        },
        data: function () {
            return {
                newAssessment: {name: '', description: ''},
                error: false,
                assessmentsForTable: this.assessments,
                assessmentToDelete: 0,
                tableColumns: this.administratorView === true ? {'name': {sortable: true}, 'description': {}, 'postcode': {sortable: true}, 'owner_name': {sortable: true}, 'updated_at': {sortable: true}, actions: {label: ''}} : {'name': {sortable: true}, 'description': {}, 'postcode': {sortable: true}, 'updated_at': {sortable: true}, actions: {label: ''}},
                filter: ""
            };
        },
        watch: {
            filter: function () {
                if (this.filter.length < 3)
                    this.assessmentsForTable = this.assessments;
                else {
                    this.assessmentsForTable = [];
                    this.assessments.forEach(function (assessment) {
                        let filterLC = this.filter.toLowerCase();
                        if (assessment.name.toLowerCase().indexOf(filterLC) != -1
                                || assessment.description != undefined && assessment.description.toLowerCase().indexOf(filterLC) != -1
                                || assessment.postcode.toLowerCase().indexOf(filterLC) != -1
                                || assessment.owner_name.toLowerCase().indexOf(filterLC) != -1)
                            this.assessmentsForTable.push(assessment);
                    }, this);
                }
            }
        },
        methods: {
            createAssessment: function (evt) {
                this.error = false;
                evt.preventDefault(); // Prevent modal from closing

                if (!this.newAssessment.name) {
                    this.error = 'Please enter a name';
                }
                else if (!this.newAssessment.postcode) {
                    this.error = 'Please enter a postcode';
                }
                else {
                    axios.post('/api/assessment', this.newAssessment)
                            .then((response) => {
                                this.assessmentsForTable.push(response.data);
                                this.$refs.newAssessmentModal.hide();
                            })
                            .catch((error) => {
                                this.errorCallback(error);
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
                            let indexOfAssessment = this.assessmentsForTable.findIndex(function (assessment) {
                                return assessment.id == assessmentToDelete;
                            });
                            this.assessmentsForTable.splice(indexOfAssessment, 1);
                            this.$refs.deleteAssessmentModal.hide();
                        })
                        .catch((error) => {
                            this.errorCallback(error);
                        });
            },
            errorCallback: function (error) {
                this.error = 'Error ';
                if (error.response.data.errors) {
                    for (let errorKey in error.response.data.errors) {
                        this.error += "<br /> " + error.response.data.errors[errorKey];
                    }
                    ;
                }
                else if (error.response.data.message)
                    this.error += '- ' + error.response.data.message;
                else
                    this.error += '- ' + error;
            }

        },
        mounted: function () {
            console.log(this.assessments);
        }
    }
</script>
