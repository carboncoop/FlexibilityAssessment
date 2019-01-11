<template>
    <div id="assessment-questionnaire">
        <h1>Flexibility assessment questionnaire</h1>
        <p class="red">Do we want an intro here?</p>


        <h2>Platform feedback</h2>

        <p class="question">What was the most useful information provided to you on the platform/by the Energy Assessor, about the changes coming in the energy system? 
            <select class="form-control" v-model="assessment.data.mostUsefulInformation">
                <option v-for="section in sectionsInIntro" value="section">{{section}}</option>
                <option style="color: red">[From Carlos] I have copied and pasted all the sections, needs feedback</option>
            </select>
        </p>

        <p class="question">What was the least useful information? 
            <select class="form-control" v-model="assessment.data.leastUsefulInformation">
                <option v-for="section in sectionsInIntro" v-bind:value="{sectionaaaaaaa:'sdasdsection'}">{{section}}</option>
                <option style="color: red">[From Carlos] I have copied and pasted all the sections, needs feedback</option>
            </select>
        </p>

        <p class="question">Do you feel you have enough information to help you decide about whether you would sign up for a flexibility agreement?
            <select class="form-control" v-model="assessment.data.enoughInformationToDecide">
                <option value="1- Not at all">1- Not at all</option>
                <option value="2- Not enough">2- Not enough</option>
                <option value="3- Nearly enough">3- Nearly enough</option>
                <option value="4- Yes">4- Yes</option>
            </select>
        </p>


        <h2>Signup priorities & finances</h2>

        <p>How important would the following be, in tempting me to sign up to a flexibility agreement? (1 - most important, 5 - least important) <span class="red">Data doesn't get saved. Needs fixing</span>
        <ol v-drag-and-drop:options="sortableLIstOptions">
            <li v-text="assessment.data.signupPriorities[0]"></li>
            <li v-text="assessment.data.signupPriorities[1]"></li>
            <li v-text="assessment.data.signupPriorities[2]"></li>
            <li v-text="assessment.data.signupPriorities[3]"></li>
            <li v-text="assessment.data.signupPriorities[4]"></li>
        </ol>
        </p>

        <p>How much money would you need from a Flexibility Agreement before you felt that it was worth signing up?
            <select class="form-control" v-model="assessment.data.howMuchMoneyToSignUp">
                <option value="More than £200 per year">More than £200 per year</option>
                <option value="£200 per year">£200 per year</option>
                <option value="£100 per year">£100 per year</option>
                <option value="£50 per year">£50 per year</option>
                <option value="£0 / not important to me">£0 / not important to me</option>
            </select>
        </p>

        <p>Would you be prepared to pay any money upfront in order to join an aggregation system?  (tick as many as apply - <span class="red">link to tenure??</span> - <span class="red">Also in the spreadsheet this questions was shaded, was there a reason for that?</span>)
            <select class="form-control" v-model="assessment.data.preparedToPayUpfront">
                <option value="No - I wouldn't pay anything upfront">No - I wouldn't pay anything upfront</option>
                <option value="Yes - I would consider paying upfront to join, if it meant I got more back from the scheme">Yes - I would consider paying upfront to join, if it meant I got more back from the scheme</option>
                <option value="Yes - I would consider upgrading to new smart heaters so I could join">Yes - I would consider upgrading to new smart heaters so I could join</option>
            </select>
        </p>

        <p>How important would the following be, in putting me off signing up to a flexibility agreement? (1 - most important, 3 - least important) <span class="red">Data doesn't get saved. Needs fixing</span>
        <ol v-drag-and-drop:options="sortableLIstOptions">
            <li v-text="assessment.data.puttingMeOffRating[0]"></li>
            <li v-text="assessment.data.puttingMeOffRating[1]"></li>
            <li v-text="assessment.data.puttingMeOffRating[2]"></li>
        </ol>
        </p>

        <h2>Other feedback</h2>
        <p>Is there anything else you want to share
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.anythingElseToShare" />
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
            return {
                sectionsInIntro: [
                    '[Intro] What are the coming changes in the energy system?',
                    "What do 'flexibility' and 'aggregation' mean when you are talking about the energy system?",
                    'Flexibility Agreements with customers',
                    'Aggregation',
                    'What is the Energy Community Aggregation Service (ECAS)?',
                    "The changes in the grid, are beginning to be felt in people's homes'",
                    "Can I sign up for offering flexibility now?",
                    "How could a Flexibility Agreement work for an individual household in the future if we set up ECAS?",
                    "What about taking part in this research 'demonstration' project?",
                    "How can I sign up to take part in this research project",
                    "What would I get for taking part?"
                ],
                sortableLIstOptions: {
                    dropzoneSelector: 'ol',
                    draggableSelector: 'li',
                    excludeOlderBrowsers: true,
                    multipleDropzonesItemsDraggingEnabled: true,
                    showDropzoneAreas: true,
                    onDrop: function (event) {
                        //console.log(this.assessment.data.signupPriorities)
                    },
                    onDragstart: function (event) {},
                    onDragend: function (event) {}
                }
            };
        },
        created: function () {

            if (this.assessment.data.signupPriorities == undefined)
                this.assessment.data.signupPriorities = [
                    'The rewards offered (£)',
                    'A Community / Not for Profit provider ',
                    'The reduction in my carbon footprint ',
                    'The opportunity to learn more about my energy system',
                    'Being part of a group working with sustainable technology?'
                ];

            if (this.assessment.data.puttingMeOffRating == undefined)
                this.assessment.data.puttingMeOffRating = [
                    'If I had to change how I control my heaters',
                    'If I had to buy new heaters',
                    'If I needed my landlord\'s permission'
                ];

        }
    }


</script>