<template>
    <div id='assessment-aggregation-component'>

        <p>Filter assessments <input style="margin-right: 25px" v-model='filter' type='text' class='form-control filter'> <input type="checkbox" v-model="checkBoxAll" v-on:click="checkUncheckAll" /> <span v-if='checkBoxAll === true'>Unselect</span><span v-if='checkBoxAll === false'>Select</span> all</p>
        <b-table striped hover responsive fixed :items="assessmentsForTable" :fields="tableColumns" :outlined="true">
                 <template slot="checkbox" slot-scope="data">
                <input type="checkbox" v-model="assessmentsChecked[data.item.id]" v-on:click='updateReport' />
            </template>
        </b-table>

        <div id="report" v-if="numberOfAssessments > 0">
            <h2 style="margin-top:35px">Aggregated Flexibility report</h2>
            <table class="table">
                <tr><td>Number of assessments</td><td>{{numberOfAssessments}}</td></tr>
                <tr><td>Flexible power available (kW)</td><td>{{schemes[0].powerAvailable.toFixed(2)}}</td></tr> <!-- This value is the same for all the schemes so we just show the first one -->
                <tr><td>Total load shifted (kWh/year)</td><td>{{schemes[0].loadUtilisedYear.toFixed(2)}}</td></tr> <!-- This value is the same for all the schemes so we just show the first one -->
            </table>
            <table class="table">
                <tr>
                    <td></td>
                    <td>Secure min <span title="Based on secure scheme Bridgwater/Street zone (WPD) -> 105 hours of availability and 21 of utilisation "><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td>Secure max <span title="Based on secure scheme Woodall Spa zone (WPD) -> 600 hours of availability and 125 of utilisation"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td>User defined</td>
                </tr>
                <!-- We are using the option by default useDnoEstimatedHoursRequired = true, so scheduledAvailability is not taking into account when running the model
                <tr>
                     <td>Scheduled Availability factor  <span title="Fraction of power offered by household that is accepted by the DNO"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="scheme in schemes">{{scheme.scheduledAvailability}}</td>
                </tr>
                -->                
                <tr>
                    <td>Utilised factor  <span title="Fraction of available load offered to the DNO that is finally shifted"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 1">{{scheme.flexibilityAwardedFactors.utilisedLoad.toFixed(2)}}</span>
                        <span v-if="index > 1"><input class="form-control" type="number" min="0" max="1" step="0.01" v-model="scheme.flexibilityAwardedFactors.utilisedLoad" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Estimated Availibility Required <span title="Amount of hours per year that the DNO requires availability"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 1">{{scheme.dnoEstimatedAvailabilityRequired.toFixed(2)}}</span>
                        <span v-if="index > 1"><input class="form-control" type="number" min="0" step="1" v-model="scheme.dnoEstimatedAvailabilityRequired" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Availability fee (£/kW/h) <span title="Fee paid by the DNO for the amount of time and power that the household ensures will be available to be turned on/off"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 1">{{scheme.fees.availability.toFixed(3)}}</span>
                        <span v-if="index > 1"><input class="form-control" type="number" min="0" max="1" step="0.001" v-model="scheme.fees.availability" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Utilisation fee (£/kWh/year) <span title="Fee paid by the DNO for the amount of energy actually shifted by the household"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 1">{{scheme.fees.utilisation.toFixed(3)}}</span>
                        <span v-if="index > 1"><input class="form-control" type="number" min="0" max="1" step="0.001" v-model="scheme.fees.utilisation" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Aggregator factor <span title="Fraction of total income kept by the aggregator"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 1">{{scheme.aggregatorFeeFactor.toFixed(2)}}</span>
                        <span v-if="index > 1"><input class="form-control" type="number" min="0" max="1" step="0.001" v-model="scheme.aggregatorFeeFactor" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Income from other flexibility schemes factor (£/kW)</td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 1">{{scheme.incomeFromOtherFlexibilityFactor.toFixed(2)}}</span>
                        <span v-if="index > 1"><input class="form-control" type="number" min="0" max="100" step="0.01" v-model="scheme.incomeFromOtherFlexibilityFactor" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Total income household (£/year)</td>
                    <td v-for="(scheme, index) in schemes">
                        {{scheme.incomeYearTotalHousehold.toFixed(2)}}
                    </td>
                </tr>
                <tr>
                    <td>Total income aggregator (£/year)</td>
                    <td v-for="(scheme, index) in schemes">
                        {{scheme.incomeYearTotalAggregator.toFixed(2)}}
                    </td>
                </tr>
            </table>
            <button class="btn" v-on:click="downloadCSV">Download</button>
        </div>
    </div>
</template>

<style scoped>
    .filter{
        margin-top: 35px;
        max-width:250px;
        display:inline-block;
    }
    td.first-column{
        width: 50px !important;
        text-align:center !important;
    }

    input[type=number]{
        width:105px
    }
</style>

<script>
    import {flexibilityModel} from '../../../../public/js/flexibility_model/flex_model.js';
    import * as jsonexport from "jsonexport/dist";
    export default {
        props: {
            'assessments': Array
        },
        data: function () {
            return {
                checkBoxAll: false,
                assessmentsForTable: this.assessments,
                assessmentsChecked: {},
                tableColumns: {'checkbox': {label: 'Add to report', class: "first-column"}, 'name': {sortable: true}, 'description': {}, 'postcode': {sortable: true}, 'owner_name': {sortable: true}},
                filter: "",
                flexibilityModel: new flexibilityModel(),
                numberOfAssessments: 0,
                assessmentsForCSV: [],
                schemes: [
                    {
                        // Secure scheme Rugeley SGT zone (WPD)
                        name: 'Secure min <span title="Based on secure scheme Rugeley SGT zone (WPD) -> 105 hours of availability and 21 of utilisation "><font-awesome-icon icon="question-circle" size="xs" /></span>',
                        headerCSV: "Scheme min",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailability: 1, utilisedLoad: 0.2},
                        dnoEstimatedAvailabilityRequired: 105,
                        fees: {availability: 0.125, utilisation: 0.175},
                        aggregatorFeeFactor: 0.3,
                        incomeFromOtherFlexibilityFactor: 5
                    },
                    {
                        // Secure scheme Woodall Spa zone (WPD)
                        name: 'Secure max <span title="Based on secure scheme Woodall Spa zone (WPD) -> 600 hours of availability and 125 of utilisation"><font-awesome-icon icon="question-circle" size="xs" /></span>',
                        headerCSV: "Scheme max",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailability: 1, utilisedLoad: 0.2},
                        dnoEstimatedAvailabilityRequired: 360,
                        fees: {availability: 0.125, utilisation: 0.175},
                        aggregatorFeeFactor: 0.3,
                        incomeFromOtherFlexibilityFactor: 5
                    },
                    {
                        name: "User defined",
                        headerCSV: "Scheme user defined",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailability: 1, utilisedLoad: 0.2},
                        dnoEstimatedAvailabilityRequired: 105,
                        fees: {availability: 0.125, utilisation: 0.175},
                        aggregatorFeeFactor: 0.3,
                        incomeFromOtherFlexibilityFactor: 5
                    }
                ]
            };
        },
        watch: {
            filter: function () {
                if (this.filter.length < 3)
                    this.assessmentsForTable = this.assessments;
                else {
                    // Find the assessments taht match the filter value
                    this.assessmentsForTable = [];
                    this.assessments.forEach(function (assessment) {
                        let filterLC = this.filter.toLowerCase();
                        if (assessment.name.toLowerCase().indexOf(filterLC) != -1
                                || assessment.description != undefined && assessment.description.toLowerCase().indexOf(filterLC) != -1
                                || assessment.postcode.toLowerCase().indexOf(filterLC) != -1
                                || assessment.owner_name.toLowerCase().indexOf(filterLC) != -1)
                            this.assessmentsForTable.push(assessment);
                    }, this);
                    this.updateReport();
                }
            }
        },
        methods: {
            checkUncheckAll: function () {
                // I don't know why but thc checkbox is false when ticked and viceversa
                if (this.checkBoxAll === false) {
                    for (let key in this.assessments)
                        this.assessmentsChecked[this.assessments[key].id] = true;
                }
                else {
                    for (let key in this.assessments)
                        this.assessmentsChecked[this.assessments[key].id] = false;
                }
                this.updateReport();
            },
            updateReport: function () {
                this.$nextTick(function () {
                    let assessmentsForReport = this.getAssessmentsForReport();
                    // Ini report
                    this.numberOfAssessments = assessmentsForReport.length;
                    this.schemes.forEach(function (scheme) {
                        scheme.powerAvailable = 0;
                        scheme.loadUtilisedYear = 0;
                        scheme.incomeYearTotalHousehold = 0;
                        scheme.incomeYearTotalAggregator = 0;
                    });
                    //Generate report
                    let myself = this;
                    assessmentsForReport.forEach(function (assessment) {
                        let assessmentCSV = JSON.parse(JSON.stringify(assessment));
                        myself.schemes.forEach(function (scheme) {
                            assessment.data.fees = scheme.fees;
                            assessment.data.flexibilityAwardedFactors = scheme.flexibilityAwardedFactors;
                            assessment.data.dnoEstimatedAvailabilityRequired = scheme.dnoEstimatedAvailabilityRequired;
                            assessment.data.aggregatorFeeFactor = scheme.aggregatorFeeFactor;
                            assessment.data.incomeFromOtherFlexibilityFactor = scheme.incomeFromOtherFlexibilityFactor;
                            myself.flexibilityModel.run(assessment.data);
                            for (let source in assessment.data.powerAvailable) {
                                scheme.powerAvailable += assessment.data.powerAvailable[source];
                                scheme.loadUtilisedYear += assessment.data.loadUtilisedYear[source];
                            }
                            scheme.incomeYearTotalHousehold += assessment.data.incomeYearTotalHousehold;
                            scheme.incomeYearTotalAggregator += assessment.data.incomeYearTotalAggregator;
                            assessmentCSV[scheme.headerCSV + " - Household income year" ] = assessment.data.incomeYearTotalHousehold;
                            assessmentCSV[scheme.headerCSV + " - Aggregator income year" ] = assessment.data.incomeYearTotalAggregator;
                        });
                        delete assessmentCSV.user;
                        delete assessmentCSV.data.flexibilityHoursScheduled;
                        delete assessmentCSV.data.incomeYearBySource;
                        delete assessmentCSV.data.incomeYearTotal;
                        delete assessmentCSV.data.incomeYearTotalHousehold;
                        delete assessmentCSV.data.incomeYearTotalAggregator;
                        delete assessmentCSV.data.loadUtilisedYear;
                        if (assessmentCSV.data.questionnaire != undefined){
                            assessmentCSV.data.questionnaire.signupPriorities = assessmentCSV.data.questionnaire.signupPriorities.join(" - ");                        
                            assessmentCSV.data.questionnaire.puttingMeOffRating = assessmentCSV.data.questionnaire.puttingMeOffRating.join(" - ");
                        }



                        myself.assessmentsForCSV.push(assessmentCSV);
                    });
                    console.log(this.schemes);
                });
            },
            downloadCSV: function () {
                // Generate CSV        
                let csv_file = "";
                let today = new Date();
                let filename = "flexibilityAssessmentReport - " + today.getFullYear()
                        + '-' + (today.getMonth() + 1) + '-' + today.getDate() + " " + today.getHours()
                        + ":" + today.getMinutes() + ":" + today.getSeconds() + ".csv";
                jsonexport(this.assessmentsForCSV, function (err, csv) {
                    if (err)
                        return console.log(err);
                    console.log(csv);
                    csv_file = csv;
                });
                // Download file
                var blob = new Blob([csv_file], {type: 'text/csv;charset=utf-8;'});
                console.log(blob);
                if (navigator.msSaveBlob) { // IE 10+
                    navigator.msSaveBlob(blob, filename);
                }
                else {
                    var link = document.createElement("a");
                    if (link.download !== undefined) { // feature detection
                        // Browsers that support HTML5 download attribute
                        var url = URL.createObjectURL(blob);
                        link.setAttribute("href", url);
                        link.setAttribute("download", filename);
                        link.style.visibility = 'hidden';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                }
            },
            getAssessmentsForReport: function () {
                let assessmentsForReport = [];
                // The assessments for the reports are the ones that are shown in the table and also checked
                for (let key in this.assessmentsForTable) {
                    if (this.assessmentsChecked[this.assessmentsForTable[key].id] === true)
                        assessmentsForReport.push(this.assessmentsForTable[key]);
                }
                return assessmentsForReport;
            }
        },
        created: function () {
            for (let key in this.assessments)
                this.assessmentsChecked[this.assessments[key].id] = false;
        }
    }
</script>
