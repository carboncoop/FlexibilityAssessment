<template>
    <div id="assessment-report">
        <h1>Flexibility assessment report</h1>
        <p class="red">Intro text about Flexibility</p>

        <h2>Schemes</h2>           
        <p> We have calculated the potential income from flexibility for three different type of schemes. Each of 
            them respond to different requirements of the National Grid. They also have different implications 
            for the household and provide different revenues.</p>

        <h2>Potential income from flexibility</h2>
        <p>In this table you can find how much you may be able to make per year with any of 
            the schemes described above and for the energy assets you have in your 
            household</p>
        <table id="potential-income" class="table">
            <tr><td>Secure</td><td>Dynamic</td><td>Restore</td></tr>
            <tr><td>£{{incomeYear.secure}}</td><td>£{{incomeYear.dynamic}}</td><td>£{{incomeYear.restore}}</td></tr>
        </table>      

        <h3>Secure</h3>
        <p>DNOs know in advance when the electricity demand is high or low and also when 
            there is more or less energy available in the National Grid. This scheme 
            aims to manage these predictable situations.</p>
        <p>The household (or an automated system) will declare a week in advance how 
            much power and when can be turned on or off in the house. The DNO 
            will agree to some of that power and time and pay a fee. 
            The following week the DNO will use all or some of that power.
            When this happens another fee is paid to the household for the 
            total amount of energy the DNO uses.</p>
        <p>The advantage of this scheme is that the household knows exactly when 
            the DNO will use the energy. This allows the household to prepare themselves 
            and choose which other moments of the week they use their energy. 
            The con is that the fees are lower compared to the other schemes.</p>

        <h3>Dynamic</h3>
        <p>This scheme aims to support the grid in the case of a specific fault. 
            It works in a similar way than the Secure scheme: the household declares 
            a week in advance the power and the time they can turn things off. The 
            DNO will agree to that and pay a feed. Again, the DNO may or may not 
            require the household to stop using power and it will pay accordingly 
            to the amount of energy not used.</p>
        <p>The difference with the Secure scheme is that the DNO will only notify 
            the household to turn off things 15 minutes in advance. This can 
            be more inconvenient for the household. On the other hand the income 
            is usually higher</p>

        <h3>Restore</h3>
        <p>This scheme deals with unexpected faults in the grid. Such events are rare and 
            offer no warning as they depend on failure of equipment. Under such 
            circumstances, response can be used to reduce the stress on the network. 
            When taking part in this scheme there is no pre-agreement of when the 
            household may have to stop using power. Payment is only for the 
            amount of energy that is not used.</p>
        <p>The advantage of this scheme is that the income is higher than in any other scheme. 
            But the household never knows when they will have to stop using power.</p>

        <p style="font-size:14px; margin-top: 50px" v-if='reportUrl != ""'><a target='blank' v-bind:href='reportUrl'>Unique link</a> to this report to share with household <br />
            <a target='blank' v-bind:href='reportUrl' v-text="reportUrl"></a>
        </p>
    </div>
</template>

<style scoped>
    .red{
        color:red;
    }
    table#potential-income{
        width:75%;
        margin:auto;
        text-align: center;
    }
    h3{
        font-size:20px;
        font-weight:bold;
        margin-top: 15px
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
                    dynamic: {availability: 0.005, utilisation: 0.3},
                    restore: {availability: 0, utilisation: 0.6}
                },
                incomeYear: {secure: 0, dynamic: 0, restore: 0}
            };
        },
        mounted: function () {
            for (let scheme in this.schemes) {
                this.assessment.data.fees = this.schemes[scheme];
                this.incomeYear[scheme] = this.flexibilityModel.run(this.assessment.data).incomeYearTotal.toFixed(2);
            }
            console.log(this.incomeYear);
        }
    }
</script>