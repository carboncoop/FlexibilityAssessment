<template>
    <div id='assessment-aggregation-component'>

        <p>Filter assessments <input style="margin-right: 25px" v-model='filter' type='text' class='form-control filter'> <input type="checkbox" v-model="checkBoxAll" v-on:click="checkUncheckAll" /> <span v-if='checkBoxAll === true'>Unselect</span><span v-if='checkBoxAll === false'>Select</span> all</p>
        <b-table striped hover responsive fixed :items="assessmentsForTable" :fields="tableColumns" :outlined="true">
                 <template slot="checkbox" slot-scope="data">
                <input type="checkbox" v-model="assessmentsChecked[data.item.id]" v-on:click='updateReport' />
            </template>
        </b-table>

        <div id="report" v-if="report.numberOfAssessments > 0">
            <h2 style="margin-top:35px">Aggregated Flexibility report</h2>
            <table class="table">
                <tr><td>Number of assessments</td><td>{{report.numberOfAssessments}}</td></tr>
                <tr><td>Flexible power available (kW)</td><td>{{report.schemes.secure.powerAvailable.toFixed(2)}}</td></tr> <!-- This value is the same for the 3 schemes so we just show the secure one -->
                <tr><td>Total load shifted (kWh/year)</td><td>{{report.schemes.secure.loadUtilisedYear.toFixed(2)}}</td></tr> <!-- This value is the same for the 3 schemes so we just show the secure one -->
                <tr>
                    <td>Total income per scheme (£/year)</td>
                    <td>
                        <table>
                            <tr><td>Secure</td><td>Dynamic</td><td>Restore</td></tr>
                            <tr><td>{{report.schemes.secure.incomeYearTotal.toFixed(2)}}</td><td>{{report.schemes.dynamic.incomeYearTotal.toFixed(2)}}</td><td>{{report.schemes.restore.incomeYearTotal.toFixed(2)}}</td></tr>
                        </table>
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
    .first-column{
        width: 50px !important;
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
                schemesFees: {
                    secure: {availability: 0.125, utilisation: 0.175},
                    dynamic: {availability: 0.005, utilisation: 0.3},
                    restore: {availability: 0, utilisation: 0.6}
                },
                report: {
                    numberOfAssessment: 0,
                    schemes: {
                        secure: {powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0},
                        dynamic: {powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0},
                        restore: {powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0}
                    }
                }
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

                    // Generate report
                    this.report = {
                        numberOfAssessments: 0,
                        schemes: {
                            secure: {powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0},
                            dynamic: {powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0},
                            restore: {powerAvailable: 0, loadUtilisedYear: 0, incomeYearTotal: 0}
                        },
                    };
                    let myself = this;
                    assessmentsForReport.forEach(function (assessment) {
                        myself.report.numberOfAssessments++;
                        for (let scheme in myself.schemesFees) {
                            assessment.data.fees = myself.schemesFees[scheme];
                            myself.flexibilityModel.run(assessment.data);
                            myself.report.schemes[scheme].powerAvailable += assessment.data.powerAvailable.storageHeaters + assessment.data.powerAvailable.immersionHeater;
                            myself.report.schemes[scheme].loadUtilisedYear += assessment.data.loadUtilisedYear.storageHeaters + assessment.data.loadUtilisedYear.immersionHeater;
                            myself.report.schemes[scheme].incomeYearTotal += assessment.data.incomeYearTotal;
                        }
                    });
                    console.log(this.report);
                });
            }
        },
        created: function () {
            for (let key in this.assessments)
                this.assessmentsChecked[this.assessments[key].id] = false;
        }
    }
</script>
