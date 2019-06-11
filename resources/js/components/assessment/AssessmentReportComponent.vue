<template>
    <div id="assessment-report">
        <button class='btn no-print' style="float: right" v-on:click='print' title='To export the report use the "Save as PDF" functionality in the Print dialog'>Print</button>
        <h1>Flexibility assessment report</h1>
        <p>Thank you for taking the time to complete our Flexibility assessment. Using the answers you provided, this report tells you how much income you could generate by using your electricity flexibly. </p>
        <p>Please be aware that these results are only indicative.</p>

        <h2>How flexibility works</h2>

        <p>The companies that run the grid know when there is excess energy in the grid, and when there is not enough. When this happens, they have to pay to do something about it.</p>
        <p>That’s why they are keen for households to be flexible in when you use electricity. This means agreeing to let the grid company occasionally change when one of your devices turns on or off.  This flexibility lets the grid company increase or reduce the amount of energy used on the grid to deal with problems as they come up. </p>

        <table class="table" style="width:750px;line-height: 20px;margin:auto; text-align: center">
            <tr><td></td><td>Rating</td><td>Flexible power available</td><td>Estimated earnings </td></tr>
            <tr v-if='assessment.data.powerAvailable.storageHeaters > 0'>
                <td>Storage heaters</td>
                <td>{{(assessment.data.storageHeaters.number * assessment.data.storageHeaters.rating).toFixed(2)}}kW</td>
                <td>{{assessment.data.powerAvailable.storageHeaters.toFixed(2)}}kW </td>
                <td>{{assessment.data.incomeYear.storageHeaters.toFixed(2)}}£/year</td>
            </tr>
            <tr v-if='assessment.data.powerAvailable.immersionHeater > 0'>
                <td>Immersion heater</td>
                <td>{{assessment.data.immersionHeater.rating.toFixed(2)}}kW</td>
                <td>{{assessment.data.powerAvailable.immersionHeater.toFixed(2)}}kW</td>
                <td>{{assessment.data.incomeYear.immersionHeater.toFixed(2)}}£/year</td>
            </tr>
        </table>

        <h2>Potential income from flexibility</h2>
        <p>This is how much you may be able to make per year 
            for the energy assets you have in your household</p>
        <p><b>Secure scheme: £{{incomeYear.secure}}</b></p>
 

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
        </div>

        <h2 class="new-page">FAQ</h2>

        <h3>Who are the ‘grid companies’?</h3>
        <p>When we say ‘grid company’, we mean the Distribution Network Operators, or DNOs. These are the companies that own the cables that carry the electricity from the grid to your house.</p>
        <p>DNOs are very interested in flexibility. They know when there is extra energy in the grid and also when there is not enough. They are the ones that will pay households for shifting energy consumption.</p>

        <h3>What happens if I want to use a device but it has been switched off?</h3>
        <p>Xxxxxxx NEW CONTENT NEEDED xxxxxxxX</p>

        <h3>How have we calculated your available flexibility?</h3>
        <p>Our calculations are based on the information we gathered on the devices you have in your home, based on the assumption that you would have a smart controller fitted to these devices after you signed up.</p>
        <p>The model assumes that some of the power used by these devices is shifted. This doesn’t mean that you use more or less electricity, but that the energy is not used at the time when you would normally use it but at a different time of the day.</p>
        <p>How much energy can be shifted depends on the electrical devices in your house. This model takes into account storage heaters and immersion heaters but also how efficient your house is and how many people live in the house.</p>


        <h3>How is the flexibility from an immersion heater calculated?</h3>
        <p>The model assumes that 80% of the immersion heater power can be shifted. The remaining 20% cannot be shifted, allowing you to keep some control.</p>

        <h3>How is the flexibility from storage heaters calculated?</h3>
        <p>The EPC rating is used as the factor by which the amount of the charging time can be reduced during the normal charging period (night). The aim of using the EPC is to minimize the impact to the occupants' thermal comfort.</p>
        <p></p>The model assumes that houses with higher EPCs have better insulation and higher thermal capacity. In these cases a bigger load can be shifted and the house will still be at an acceptable temperature.</p>

        <h3>How is the income from flexibility calculated?</h3>
        <p>The income is calculated as the fees you get paid by the DNO minus the 
            cost of using the energy at a different time of the day</p>

        <h3>How many hours will my device be switched off for?</h3>
        <p>Xxxxxxx NEW CONTENT NEEDED xxxxxxxX</p>

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
        margin: 10px 5px;
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
        methods: {
            print: function () {
                window.print();
            }
        }
    }
</script>