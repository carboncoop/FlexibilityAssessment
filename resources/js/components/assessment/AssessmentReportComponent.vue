<template>
    <div id="assessment-report">
        <h1>Flexibility assessment report</h1>
        <p>You can download this report in pdf format <a target='blank' v-bind:href='reportUrl'>here</a></p>
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
    </div>
</template>

<style scoped>

</style>

<script>
    export default{
        props: {
            initialAssessment: Object,
            reportUrl: String
        },
        mounted:function(){
            console.log(this.reportUrl);
        }
    }
</script>