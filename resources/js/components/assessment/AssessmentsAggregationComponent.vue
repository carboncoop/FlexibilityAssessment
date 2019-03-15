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
                    <td v-for="scheme in schemes">{{scheme.name}}</td>
                </tr>
                <!-- We are using the option by default useDnoEstimatedHoursRequired = true, so scheduledAvailabilityFactor is not taking into account when running the model
                <tr>
                     <td>Scheduled Availability factor  <span title="Fraction of power offered by household that is accepted by the DNO"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="scheme in schemes">{{scheme.scheduledAvailabilityFactor}}</td>
                </tr>
                -->                
                <tr>
                    <td>Utilised factor  <span title="Fraction of available load offered to the DNO that is finally shifted"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 2">{{scheme.flexibilityAwardedFactors.utilisedLoadFactor.toFixed(2)}}</span>
                        <span v-if="index > 2"><input class="form-control" type="number" min="0" max="1" step="0.01" v-model="scheme.flexibilityAwardedFactors.utilisedLoadFactor" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Estimated Availibility Required <span title="Amount of hours per year that the DNO requires availability"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 2">{{scheme.dnoEstimatedAvailabilityRequired.toFixed(2)}}</span>
                        <span v-if="index > 2"><input class="form-control" type="number" min="0" step="1" v-model="scheme.dnoEstimatedAvailabilityRequired" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Availability fee (£/kW/h) <span title="Fee paid by the DNO for the amount of time and power that the household ensures will be available to be turned on/off"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 2">{{scheme.fees.availability.toFixed(3)}}</span>
                        <span v-if="index > 2"><input class="form-control" type="number" min="0" max="1" step="0.001" v-model="scheme.fees.availability" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Utilisation fee (£/kWh/year) <span title="Fee paid by the DNO for the amount of energy actually shifted by the household"><font-awesome-icon icon="question-circle" size="xs" /></span></td>
                    <td v-for="(scheme, index) in schemes">
                        <span v-if="index <= 2">{{scheme.fees.utilisation.toFixed(3)}}</span>
                        <span v-if="index > 2"><input class="form-control" type="number" min="0" max="1" step="0.001" v-model="scheme.fees.utilisation" v-on:change="updateReport" /></span>
                    </td>
                </tr>
                <tr>
                    <td>Total income per scheme (£/year)</td>
                    <td v-for="(scheme, index) in schemes">
                        {{scheme.incomeYearTotal.toFixed(2)}}
                    </td>
                </tr>
            </table>
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
        width:85px
    }
</style>

<script>
    import {flexibilityModel} from '../../../../public/js/flexibility_model/flex_model.js';
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
                schemes: [
                    {
                        name: "Secure",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailabilityFactor: 1, utilisedLoadFactor: 1},
                        dnoEstimatedAvailabilityRequired: 125,
                        fees: {availability: 0.125, utilisation: 0.175}
                    },
                    {
                        name: "Dynamic",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailabilityFactor: 1, utilisedLoadFactor: 1},
                        dnoEstimatedAvailabilityRequired: 125,
                        fees: {availability: 0.005, utilisation: 0.3}
                    },
                    {
                        name: "Restore",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailabilityFactor: 1, utilisedLoadFactor: 1},
                        dnoEstimatedAvailabilityRequired: 125,
                        fees: {availability: 0, utilisation: 0.6}
                    },
                    {
                        name: "User defined",
                        powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0,
                        flexibilityAwardedFactors: {scheduledAvailabilityFactor: 1, utilisedLoadFactor: 1},
                        dnoEstimatedAvailabilityRequired: 125,
                        fees: {availability: 0.125, utilisation: 0.175}
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
                    let assessmentsForReport = [];
                    // The assessments for the reports are the ones that are shown in the table and also checked
                    for (let key in this.assessmentsForTable) {
                        if (this.assessmentsChecked[this.assessmentsForTable[key].id] === true)
                            assessmentsForReport.push(this.assessmentsForTable[key]);
                    }
                    // Ini report
                    this.numberOfAssessments = assessmentsForReport.length;
                    this.schemes.forEach(function (scheme) {
                        scheme.powerAvailable = 0;
                        scheme.loadUtilisedYear = 0;
                        scheme.incomeYearTotal = 0;
                    });
                    //Generate report
                    let myself = this;
                    assessmentsForReport.forEach(function (assessment) {
                        myself.schemes.forEach(function (scheme) {
                            assessment.data.fees = scheme.fees;
                            assessment.data.flexibilityAwardedFactors = scheme.flexibilityAwardedFactors;
                            assessment.data.dnoEstimatedAvailabilityRequired = scheme.dnoEstimatedAvailabilityRequired;
                            myself.flexibilityModel.run(assessment.data);
                            scheme.powerAvailable += assessment.data.powerAvailable.storageHeaters + assessment.data.powerAvailable.immersionHeater;
                            scheme.loadUtilisedYear += assessment.data.loadUtilisedYear.storageHeaters + assessment.data.loadUtilisedYear.immersionHeater;
                            scheme.incomeYearTotal += assessment.data.incomeYearTotal;
                        });
                    });
                    console.log(this.schemes);
                });
            }
        },
        created: function () {
            for (let key in this.assessments)
                this.assessmentsChecked[this.assessments[key].id] = false;
        }
    }
</script>
