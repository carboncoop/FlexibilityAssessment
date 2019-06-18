<template>
    <div id="assessment-report">
        <button class='btn no-print' style="float: right" v-on:click='print' title='To export the report use the "Save as PDF" functionality in the Print dialog'>Print</button>

        <h1>Flexibility assessment report</h1>
        <p>Thank you for taking the time to complete our Flexibility assessment. Using the answers you provided, this report tells you how much income you could generate by using your electricity flexibly.</p>
        <p>Please be aware that these results are only indicative as the market and prices for flexibility are not yet fully developed.</p>

        <h2>How flexibility works</h2>
        <p>Renewable electricity is now playing a crucial role in helping tackle climate change and building a sustainable society. We are using electricity more than ever before; in everything from electric heaters to cars.  But there’s a problem. Renewable energy comes from the wind, the rain, and the sun, but we can’t control the weather. Ideally, the electricity generated needs to match electricity use at all times, but we can’t turn the wind up and down on demand. </p>
        <p>The companies that run the grid know when there is excess energy in the grid, and when there is not enough. When this happens, they have to pay to do something about it.</p>
        <p>That’s why they are keen for households to be flexible in when you use electricity. This means agreeing to let the grid company occasionally change when one of your devices turns on or off. This flexibility lets the grid company increase or reduce the amount of energy used on the grid to deal with problems as they come up. </p>

        <table class="table" style="width:750px;line-height: 20px;margin:auto; text-align: center">
            <tr><td></td><td>Rating</td><td>Flexible power available</td><td>Estimated earnings </td></tr>
            <tr v-if='assessment.data.powerAvailable.storageHeaters > 0'>
                <td>Storage heaters</td>
                <td>{{(assessment.data.storageHeaters.number * assessment.data.storageHeaters.rating).toFixed(2)}}kW</td>
                <td>{{assessment.data.powerAvailable.storageHeaters.toFixed(2)}}kW </td>
                <td>{{incomePerAsset.secure.storageHeaters.toFixed(2)}}£/year</td>
            </tr>
            <tr v-if='assessment.data.powerAvailable.immersionHeater > 0'>
                <td>Immersion heater</td>
                <td>{{assessment.data.immersionHeater.rating.toFixed(2)}}kW</td>
                <td>{{assessment.data.powerAvailable.immersionHeater.toFixed(2)}}kW</td>
                <td>{{incomePerAsset.secure.immersionHeater.toFixed(2)}}£/year</td>
            </tr>
        </table>

        <h2>What would I need to change?</h2>
        <p>After you sign up, we would install a smart controller in your home. This will be a small box about the size of a wifi router. The smart controller will automatically receive flexibility requests from the grid.</p>
        <p>The smart controller will then control when your storage heaters and/or immersion elements charge up. It will make sure that your flexible devices provide heat for you when you need it, while also avoiding charging at times when the grid is overloaded.</p>
        <p>In order for the smart controller to work, it will need to know when you want heat in your house. This is still a trial project so we don’t know exactly how it would work yet. But you might need to change how you control your heating system, so that the smart controller can see your heating preferences and make sure you get heat when you need it. This could mean using a programmable thermostat, or setting your heating times using an app or webpage. </p>

        <h2>Potential income from flexibility</h2>
        <p>How much you earn will depend on how many flexible devices you have in your home, and how often the grid ends up asking for flexibility. Based on past experience and earnings in other areas, we have provided a r006Fugh estimate for you below. </p>
        <p style="text-align: center; margin-bottom: 50px"><b>Estimated income: <span style="red">£{{incomeYear.secure}} to income Y</span> per</b></p>

        
        <h2 class="new-page">FAQ</h2>

        <h3>Who are the ‘grid companies’?</h3>
        <p>When we say ‘grid company’, we mean the Distribution Network Operators, or DNOs. These are the companies that own the cables that carry the electricity from the grid to your house.</p>
        <p>DNOs are very interested in flexibility. They know when there is extra energy in the grid and also when there is not enough. They are the ones that will pay households for shifting energy consumption.</p>

        <h3>How have we calculated your available flexibility?</h3>
        <p>Our calculations are based on the information we gathered on the devices you have in your home, based on the assumption that you would have a smart controller fitted to these devices after you signed up.</p>
        <p>The model assumes that some of the power used by these devices is ‘shifted’. This doesn’t mean that you use more or less electricity, but that you use it at a different time of the day to when you normally would.</p>
        <p>How much energy can be shifted depends on the electrical devices in your house. This model takes into account storage heaters and immersion heaters but also how efficient your house is and how many people live in the house.</p>

        <h3>How is the flexibility from an immersion heater calculated?</h3>
        <p>The model assumes that 80% of the immersion heater power can be shifted. The remaining 20% cannot be shifted, allowing you to keep some control.</p>

        <h3>How is the flexibility from storage heaters calculated?</h3>
        <p>Your house’s Energy Performance Certificate (EPC) rating is used as the factor by which the amount of the charging time can be reduced during the normal charging period (normally night), to other times of day when flexibility is needed. The aim of using the EPC is to minimize the impact to your thermal comfort.</p>
        <p>The model assumes that houses with higher EPCs have better insulation and higher thermal capacity. In these cases a bigger load can be shifted and the house will still be at an acceptable temperature.</p>

        <h3>How is the income from flexibility calculated?</h3>
        <p>The income is calculated as the fees from the DNO minus the extra cost of using the energy at a different time of the day (because flexibility will sometimes result in your heaters charging during ‘peak’ rather than ‘off peak’ tariff rates). An admin charge of 30% covers the costs of the Flexible Power Community in running your aggregation platform. </p>

        <h3>How much time will I have to be flexible?</h3>
        <p>The model estimates that the DNOs will require between <span style="red">X and Y</span> hours of flexibility each year.</p>
        
        <h3>Will signing up for flexibility mean I can’t use my heaters when I want?</h3>
        <p>No. The smart controller is designed so that you can set your heating however you want, and it will make sure you get the heat you need. It will only respond to a grid flexibility request if it can do that without leaving you cold. </p>

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
                incomeYear: {secure: 0, dynamic: 0, restore: 0},
                incomePerAsset: {secure: {storageHeaters: 0, immersionHeater: 0}, dynamic: {storageHeaters: 0, immersionHeater: 0}, restore: {storageHeaters: 0, immersionHeater: 0}}
            };
        },
        mounted: function () {
            for (let scheme in this.schemes) {
                this.assessment.data.fees = this.schemes[scheme];
                let result = this.flexibilityModel.run(this.assessment.data);
                this.incomeYear[scheme] = result.incomeYearTotal.toFixed(2);
                this.incomePerAsset[scheme].storageHeaters = result.incomeYear.storageHeaters;
                this.incomePerAsset[scheme].immersionHeater = result.incomeYear.immersionHeater;
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