<template>
    <div id="assessment-report">
        <h1>Flexibility assessment report</h1>
        <p class="red">Intro text about Flexibility</p>
        
        <h2>Schemes</h2>
        <p>In the UK there is currently only one Distribution Network Operator (DNO) that offers flexibility.
            DNOs are the companies that own and operate the cables and towers that bring electricity from 
            the grid to our homes and businesses.</p>
           
        <p> We have calculated the potential income from flexibility for three different schemes. Each of 
        these schemes respond to different requirements of the National Grid. They also have different implications 
        for the household and provide different revenues.</p>

        <p style="font-size:14px" v-if='reportUrl != ""'><a target='blank' v-bind:href='reportUrl'>Unique link</a> to this report to share with household <br />
            <a target='blank' v-bind:href='reportUrl' v-text="reportUrl"></a>
        </p>
    </div>
</template>

<style scoped>
    .red{
        color:red;
    }
</style>

<script>

    import {flexibilityModel} from '../../../../public/js/flexibility_model/flex_model.js';

    export default{
        props: {
            initialAssessment: Object,
            reportUrl: String
        },
        data: function () {
            return{
                assessment: JSON.parse(JSON.stringify(this.initialAssessment)),
                flexibilityModel: new flexibilityModel(),
                schemes: {
                    secure: {availability: 0.125, utilisation: 0.175},
                    dynamic: {availability: 0.05, utilisation: 0.3},
                    restore: {availability: 0, utilisation: 0.6}
                },
                incomeYear: {}
            }
        },
        mounted: function () {
            for (let scheme in this.schemes) {
                this.assessment.data.fees = this.schemes[scheme];
                this.incomeYear[scheme] = JSON.parse(JSON.stringify(this.flexibilityModel.run(this.assessment.data).incomeYearTotal));
            }
            console.log(this.incomeYear);
        }
    }
</script>