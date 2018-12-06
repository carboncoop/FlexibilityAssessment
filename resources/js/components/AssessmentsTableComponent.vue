<template>
    <div>

        <table class="table">
            <th>Name</th><th>Description</th><th>Author</th><th>Modified</th><th><button v-b-modal.new-assessment-modal>New</button></th>
            <tr v-for="assessment in assessmentsList">
                <td v-text="assessment.name"></td>
                <td v-text="assessment.description"></td>
                <td></td>
                <td v-text="assessment.updated_at"></td>
                <td></td>
            </tr>
        </table>

        <b-modal id="new-assessment-modal" ref="newAssessmentModal" title="New assessment" v-on:ok="createAssessment">
            <p style="color:red" v-if="error">{{error}}</p>
            <table>
                <tr><td>Name</td><td><input type="text" v-model="newAssessment.name" placeholder="My asessment"></td></tr>
                <tr><td>Description</td><td><input type="text" v-bind:value="newAssessment.description" placeholder="Description"></td></tr>
            </table>
        </b-modal>

    </div>
</template>

<script>
    export default {
        props: {'assessments': Array},
        data: function () {
            return {
                newAssessment: {name: '', description: ''},
                error: false,
                assessmentsList: this.assessments
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
                    axios.post('api/assessment', this.newAssessment)
                            .then((response) => {
                                this.assessmentsList.push(response.data);
                                this.$refs.newAssessmentModal.hide();
                            })
                            .catch((error) => {
                                this.error = 'Error - ' + error.response.data.message;
                            })
                }
            }
        },
        mounted: function () {
        }
    }
</script>
