<template>
    <div id="assessment-report">
        <button class='btn no-print' style="float: right" v-on:click='print' title='To export the report use the "Save as PDF" functionality in the Print dialog'>Print</button>
        <h1>Flexibility assessment report</h1>
        <p>The Flexibility Assessment Tool calculates the available flexibility of 
            your household and the potential income that can be generated from it.</p>
        <p>This is the report that summarizes the calculations and results. Please be aware 
            that they are only indicative.</p>

        <h2>Your flexible power</h2>

        <p>In the table below you can see how much flexible power is available in 
            your household and the potential amount of energy that can be shifted.</p>

        <table class="table" style="width:750px;line-height: 20px;margin:auto; text-align: center">
            <tr><td></td><td>Rating</td><td>Flexible power available</td><td>Potential energy shifted</td></tr>
            <tr v-if='assessment.data.powerAvailable.storageHeaters > 0'>
                <td>Storage heaters</td>
                <td>{{(assessment.data.storageHeaters.number * assessment.data.storageHeaters.rating).toFixed(2)}}kW</td>
                <td>{{assessment.data.powerAvailable.storageHeaters.toFixed(2)}}kW </td>
                <td>{{assessment.data.loadUtilisedYear.storageHeaters.toFixed(2)}}kWh/year</td>
            </tr>
            <tr v-if='assessment.data.powerAvailable.immersionHeater > 0'>
                <td>Immersion heater</td>
                <td>{{assessment.data.immersionHeater.rating.toFixed(2)}}kW</td>
                <td>{{assessment.data.powerAvailable.immersionHeater.toFixed(2)}}kW</td>
                <td>{{assessment.data.loadUtilisedYear.immersionHeater.toFixed(2)}}kWh/year</td>
            </tr>
        </table>


        <h2>Schemes</h2>           
        <p>The potential income from flexibility is calculated for three different
            type of schemes. Each of them respond to different requirements of the 
            National Grid. They also have different implications for the household 
            and provide different revenues.</p>


        <h2>Potential income from flexibility</h2>
        <p>In this table you can find how much you may be able to make per year with any of 
            the schemes described below and for the energy assets you have in your 
            household</p>
        <table id="potential-income" class="table">
            <tr><td>Secure</td><td>Dynamic</td><td>Restore</td></tr>
            <tr><td>£{{incomeYear.secure}}</td><td>£{{incomeYear.dynamic}}</td><td>£{{incomeYear.restore}}</td></tr>
        </table>     
        
        <div style='text-align:center;'>
            <div class='info-box-inline'>
                <h3>Secure scheme</h3>
                <p>This scheme aims to manage predictable needs of the grid. The 
                    household agrees in advance with the DNO how much power they 
                    can stop using and for how long. The DNO will pay a fee for this. 
                    The following week the DNO will use all or some of that power
                    and pay another fee for the total amount.</p>
                <p>The advantage of this scheme is that the household knows exactly when 
                    the DNO will use the energy. This allows the household to prepare themselves 
                    and choose which other moments of the week they use their energy. 
                    The con is that the fees are lower compared to the other schemes.</p>
            </div>

            <div class='info-box-inline'>
                <h3>Dynamic scheme</h3>
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
            </div>

            <div class='info-box-inline'>
                <h3>Restore scheme</h3>
                <p>This scheme deals with unexpected faults in the grid. Such events are rare and 
                    offer no warning as they depend on failure of equipment. Under such 
                    circumstances, response can be used to reduce the stress on the network. 
                    When taking part in this scheme there is no pre-agreement of when the 
                    household may have to stop using power. Payment is only for the 
                    amount of energy that is not used.</p>
            </div>
        </div>

        <h2 class="new-page">FAQ</h2>
        
        <h3>What is a DNO?</h3>
        <p>DNOs are the Distribution Network Operators. They are the companies 
            that own the cables that carry the electricity from the grid to your house.</p>
        <p>DNOs are very interested in flexibility. They know when there is 
            extra energy in the grid and also when there is not enough. They are 
            the ones that will pay households for shifting the energy consumption.</p>


        <h3>How is the available flexibility calculated?</h3>
        
        <p>The calculations are based in a model that takes your answers to the assessment 
            as inputs, it runs them through and algorithm and generates the results.</p>
        <p>The model assumes that some of the power used in the house is shifted. This means that
            the energy is not used at the time when you would normally use it but 
            at a different time of the day. </p>
        <p>How much energy can be shifted depends on the electrical devices in your house. 
            This model takes into account storage heaters and immersion heaters but 
            also how efficient your house is and the occupancy.</p>

        <h3>How is the flexibility from an immersion heater calculated?</h3>
        <p>The model assumes that 80% of the immersion heater power can be shifted. </p>
        <p>The remaining 20% is to allow the householder keep some control.</p>

        <h3>How is the flexibility from storage heaters calculated?</h3>
        <p>The EPC rating is used as the factor by which the amount of the charging 
            time can be reduced during the normal charging period (night). The aim of 
            using the EPC is to minimize the impact to the occupants' thermal comfort.</p>
        <p>The model assumes that houses with higher EPCs have better insulation and higher 
            thermal capacity. In these cases a bigger load can be shifted and the house 
            will still be at an acceptable temperature.</p>

        <h3>How is the income from flexibility calculated?</h3>
        <p>The income is calculated as the fees you get paid by the DNO minus the 
            cost of using the energy at a different time of the day</p>
        

        <h3>How much time will I have to be flexible?</h3>

        <p>The model estimates that every year the DNOs will ask households to turn 
            off electrical loads for around 125 hours.</p>

        <p class="no-print" style="font-size:14px; margin-top: 50px" v-if='reportUrl != ""'>Unique link to this report to share with household <br />
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
    h2{
        margin-top:25px;
    }
    h3{
        font-size:20px;
        font-weight:bold;
        margin-top: 15px
    }
    .info-box{
        background:#fef2ef;;
        border:1px solid;
        float:right;
        padding:15px;
        font-size: 15px;
        max-width:300px;
        margin: 10px 15px;
    }
    .info-box-inline{
        display:inline-block;
        vertical-align:top;
        background:#fef2ef;;
        border:1px solid;
        padding:15px;
        font-size: 15px;
        max-width:260px;
        margin: 10px 5px;
        height: 535px;
    }
    .info-box-inline h3{
        margin-top:0;
    }

    @media print {
        .no-print{
            display:none;
        }

        #assessment{
            margin-top:0px
        }
        .new-page{
            page-break-before: always;
            margin-top:50px;
        }
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
        },
        methods:{
            print: function(){
                window.print();
            }
        }
    }
</script>