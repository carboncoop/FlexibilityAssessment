<template>
    <div id="assessment-questionnaire">
        <h1>Flexibility assessment questionnaire</h1>
        <p>Complete this section to give us all the information you would need to 
            sign up for a flexibility agreement.</p>


        <h2>Platform feedback</h2>

        <p class="question">What was the most useful information provided to you on the platform/by the Energy Assessor, about the changes coming in the energy system?
            <select class="form-control" v-model="assessment.data.questionnaire.mostUsefulInformation">
                <option v-for="(section, index) in sectionsInIntro" v-bind:value="section">{{section}}</option>
            </select>
        </p>

        <p class="question">What was the least useful information?
            <select class="form-control" v-model="assessment.data.questionnaire.leastUsefulInformation">
                <option v-for="(section, index) in sectionsInIntro" v-bind:value="section">{{section}}</option>
            </select>
        </p>

        <p class="question">Which do you think left you with the clearest information about flexibility:
            <select class="form-control" v-model="assessment.data.questionnaire.clearestInformation">
                <option value="The event I attended">The event I attended</option>
                <option value="The website">The website</option>
                <option value="Talking with the Energy Officer">Talking with the Energy Officer</option>
            </select>
        </p>

        <p class="question">Do you feel you have enough information to help you decide about whether you would sign up for a flexibility agreement?
            <select class="form-control" v-model="assessment.data.questionnaire.enoughInformationToDecide">
                <option value="1- Not at all">1- Not at all</option>
                <option value="2- Not enough">2- Not enough</option>
                <option value="3- Nearly enough">3- Nearly enough</option>
                <option value="4- Yes">4- Yes</option>
            </select>
        <p>Please add any comments</p>
        <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.questionnaire.enoughInformationToDecideComments"></textarea>            

        </p>

        <h2>Heating controls</h2>

        <p>If you signed up for flexibility you would have a smart controller installed and you would need to set your heating times in a way that the smart controller could read. This could be via a programmable thermostat, an app, or a webpage. Which method of setting your heating would you prefer?</p>
        <select class="form-control" v-model="assessment.data.questionnaire.heatingSettingUpMethod">
            <option value='A programmable thermostat'>A programmable thermostat</option>
            <option value='App'>App</option>
            <option value='Webpage'>Webpage</option>
        </select>

        <p>If you currently set your heating only using the knobs on the heaters, it might take time to get used to using  thermostat, app or webpage to set your heating. But the new system would also give you much more control and could help you cut costs. How would you feel about changing to a new system of heating controls?</p>
        <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.questionnaire.changeToANewSystem"></textarea>            


        <h2>Signup priorities & finances</h2>

        <p>How important would the following be, in attracting you to sign up to a flexibility agreement? (Drag & drop, 1 - most important, 5 - least important)
        <ol class="dropZoneSignUpPriorities" v-drag-and-drop:options="sortableLIstOptions" data-id="signupPriorities">
            <li class="drag-item" v-for="item in assessment.data.questionnaire.signupPriorities" :key="item" :data-id="item">
                <div>{{ item }}</div>
            </li>
        </ol>
        </p>

        <p>How much money would you need from a Flexibility Agreement before you felt that it was worth signing up?
            <select class="form-control" v-model="assessment.data.questionnaire.howMuchMoneyToSignUp">
                <option value="More than £200 per year">More than £200 per year</option>
                <option value="£200 per year">£200 per year</option>
                <option value="£100 per year">£100 per year</option>
                <option value="£50 per year">£50 per year</option>
                <option value="£0 / not important to me">£0 / not important to me</option>
            </select>
        </p>

        <p>How important would the following be, in putting you off signing up to a flexibility agreement? (Drag & Drop, 1 - most important, 3 - least important)
        <ol class="dropzoneputtingMeOffRating" v-drag-and-drop:options="sortableLIstOptions" data-id="puttingMeOffRating">
            <li class="drag-item" v-for="item in assessment.data.questionnaire.puttingMeOffRating" :key="item" :data-id="item">
                <div>{{ item }}</div>
            </li>
        </ol>
        </p>

        <p>What other information would you want before you made a decision on whether to sign up for a flexibility agreement in the future, and what further questions do you have about how the energy system is changing and about flexibility? 
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.questionnaire.otherInfoBeforeDecision" />
        </p>

        <h2>Other feedback</h2>
        <p>Is there anything else you want to share
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.questionnaire.anythingElseToShareQuestionnaire" />
        </p>
    </div>
</template>

<style scoped>
    .red{
        color:red;
    }
    select{
        max-width:350px 
    }
    select, ol,textarea{
        margin:5px 0 35px;
    }
    li{
        cursor:pointer;
    }
</style>

<script>

    import {AssessmentInput} from './mixins/AssessmentInput.js';
    import VueDraggable from 'vue-draggable';
    Vue.use(VueDraggable);

    export default{
        mixins: [AssessmentInput],
        data: function () {
            const updateSortableArray = this.updateSortableArray;
            return {
                sectionsInIntro: [
                    'Information on the coming changes in the energy system',
                    'Information on how these changes might affect you in your home',
                    'Information explaining what ‘Flexibility’ and ‘Aggregation’ are',
                    'Information explaining what Flexible Power Community is aiming to do',
                    'Information about why you cannot sign up for flexibility yet'
                ],
                sortableLIstOptions: {
                    dropzoneSelector: 'ol',
                    draggableSelector: 'li',
                    excludeOlderBrowsers: true,
                    multipleDropzonesItemsDraggingEnabled: true,
                    showDropzoneAreas: true,
                    onDrop: function (event) {
                        updateSortableArray(event.owner.children, event.droptarget.dataset.id);
                    }
                }
            };
        },
        methods: {
            updateSortableArray: function (items, property) {
                this.assessment.data.questionnaire[property] = [];
                for (let i = 0; i < items.length; i++) {
                    if (items[i].innerText != "")
                        this.assessment.data.questionnaire[property].push(items[i].innerText)
                }
            },
        },
        created: function () {
            if (this.assessment.data.questionnaire == undefined) {
                Vue.set(this.assessment.data, 'questionnaire', {});

                this.assessment.data.questionnaire.signupPriorities = [
                    'The rewards offered (£)',
                    'A Community / Not for Profit provider ',
                    'The reduction in my carbon footprint ',
                    'The opportunity to learn more about my energy system',
                    'Being part of a group working with sustainable technology?'
                ];

                this.assessment.data.questionnaire.puttingMeOffRating = [
                    'If I had to change how I control my heaters',
                    'If I had to buy new heaters',
                    'If I needed my landlord\'s permission'
                ];
            }

            // For backwards compatibility
            if (this.assessment.data.questionnaire.heatingSettingUpMethod == undefined) {
                Vue.set(this.assessment.data.questionnaire, 'heatingSettingUpMethod', "");
            }
            if (this.assessment.data.questionnaire.changeToANewSystem == undefined) {
                Vue.set(this.assessment.data.questionnaire, 'changeToANewSystem', "");
            }
            if (this.assessment.data.questionnaire.leastUsefulInformation == undefined) {
                Vue.set(this.assessment.data.questionnaire, 'leastUsefulInformation', "");
            }
            if (this.assessment.data.questionnaire.enoughInformationToDecideComments == undefined) {
                Vue.set(this.assessment.data.questionnaire, 'enoughInformationToDecideComments', "");
            }

        }
    }

</script>