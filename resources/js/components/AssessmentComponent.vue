<template>
    <div>
        <assessment-side-menu v-bind:initialAssessment='assessment'></assessment-side-menu>
        <assessment-form v-bind:initialAssessment='assessment'></assessment-form>
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
        props: {'assessment': Object},
        components: {
            AssessmentForm,
            AssessmentSideMenu
        },
        mounted:function(){console.log(this.assessment);}
    }
</script>