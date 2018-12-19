<template>
    <div>
        <assessment-side-menu v-bind:initial-assessment='initialAssessment' v-on:assessmentChange='updateAssessment'></assessment-side-menu>
        <assessment-form v-bind:initial-assessment='initialAssessment' v-on:assessmentChange='updateAssessment'></assessment-form>
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
                            myself.initialAssessment = updatedAssessment;
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