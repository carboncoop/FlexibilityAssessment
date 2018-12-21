<template>
    <div>
        <assessment-side-menu dusk="assessment-side-menu-component" v-bind:initial-assessment='assessment' v-on:assessmentChange='updateAssessment' v-on:updateView='updateView'></assessment-side-menu>
        <assessment-form dusk="assessment-form-component" v-if="view == 'assessment-form'" v-bind:initial-assessment='assessment' v-on:assessmentChange='updateAssessment'></assessment-form>
        <assessment-report v-if="view == 'assessment-report'" v-bind:initial-assessment='assessment'></assessment-report>
    </div>
</template>

<style scoped>    
    #assessment-side-menu{
        width: 200px;
    }
    #assessment-form, #assessment-report{
        margin-left:200px
    }
</style>


<script>
    import AssessmentForm  from './AssessmentFormComponent';
    import AssessmentSideMenu from './AssessmentSideMenuComponent';
    import AssessmentReport from './AssessmentReportComponent';

    export default{
        props: {'initialAssessment': Object},
        data: function () {
            return {
                assessment: JSON.parse(JSON.stringify(this.initialAssessment)), // Deep cloning to ensure one way data flow (only from parent component to child)  
                view: 'assessment-form'
            };
        },
        components: {
            AssessmentForm,
            AssessmentSideMenu,
            AssessmentReport
        },
        methods: {
            updateAssessment: function (updatedAssessment, thenCallback, catchCallback) {
                let myself = this;
                axios.put('/api/assessment/' + this.initialAssessment.id, updatedAssessment)
                        .then((response) => {
                            thenCallback(response);
                            myself.assessment = updatedAssessment;
                        })
                        .catch((error) => {
                            catchCallback(error);
                        });
            },
            updateView: function (newView) {
                this.view = newView;
            }
        },
        mounted: function () {
        }
    }
</script>