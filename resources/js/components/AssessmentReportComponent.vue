<template>
    <div id="assessment-report">
        <h1>Flexibility assessment report</h1>
        <p>{{initialAssessment.name}}</p>
    </div>
</template>

<style scoped>

</style>

<script>
    export default{
        props: {initialAssessment: Object},
        /* watch: {
         initialAssessment: {
         deep: true,
         handler: function () {
         this.assessment = this.initialAssessment;
         }
         }
         }*/
    }
</script>