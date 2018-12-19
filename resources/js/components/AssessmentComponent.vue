<template>
    <div>
        <assessment-side-menu v-bind:initial-assessment='assessment' v-on:assessmentChange='updateAssessment'></assessment-side-menu>
        <assessment-form v-bind:initial-assessment='assessment' v-on:assessmentChange='updateAssessment'></assessment-form>
    </div>
</template>

<style scoped>    
    #assessment-side-menu{
        width: 200px;
    }
    #assessment-form{
        margin-left:200px
    }
</style>


<script>
    import AssessmentForm  from './AssessmentFormComponent';
    import AssessmentSideMenu from './AssessmentSideMenuComponent';
    export default{
        props: {'initialAssessment': Object},
        data: function () {
            return {
                assessment: JSON.parse(JSON.stringify(this.initialAssessment)), // Deep cloning to ensure one way data flow (only from parent component to child)  
            };
        },
        components: {
            AssessmentForm,
            AssessmentSideMenu
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
            }
        },
        mounted: function () {
        }
    }
</script>