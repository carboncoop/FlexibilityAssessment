<template>
    <div id="assessment-form">
        <h1 style="margin-bottom: 25px">Flexibility assessment - Report feedback</h1>

        <p>Now you have seen the report, is there anything that you want clarified?
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.clarificationsNeeded"></textarea>            
        </p>

        <p>Your report estimates how much you could earn from flexibility. Is this enough to interest you?</p>
        <select class="form-control" v-model="assessment.data.reportFeedback.enoughEarnings">
            <option value="Yes, definitely">Yes, definitely</option>
            <option value="Yes, but only just">Yes, but only just</option>
            <option value="No, it’s too little">No, it’s too little</option>
            <option value="Money doesn’t matter, I wouldn’t do it anyway">Money doesn’t matter, I wouldn’t do it anyway</option>
        </select>

        <p>Would you be prepared to pay any money upfront in order to join an aggregation system?  (tick as many as apply)</p>            
        <p style="margin:0 25px 50px"><input type="checkbox" v-model="assessment.data.questionnaire.preparedToPayUpfront.no"> No - I wouldn't pay anything upfront</input><br />
            <input type="checkbox" v-model="assessment.data.questionnaire.preparedToPayUpfront.yesToJoin"> Yes - I would consider paying upfront to join, if it meant I got more back from the scheme</input><br />
            <input type="checkbox" v-model="assessment.data.questionnaire.preparedToPayUpfront.yesUpgradeHeating"> Yes - I would consider upgrading to new smart heaters so I could join</input><br />
        </p>
        
         <p>How much might you be prepared to pay?
            <textarea style='display:block' rows='2' cols='75' v-model="assessment.data.reportFeedback.preparedToPayUpfrontHowMuch"></textarea>            
        </p>

        <p>What do you think of the report? - what was good, and what needs improving?
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.whatDoYouThinkOfReport"></textarea>            
        </p>

        <p>What did you think of the language in the report- for example was it over simplified or did it come across as over complicated?           
            <select class="form-control" v-model="assessment.data.reportFeedback.reportLanguage">
                <option value='1- Too simple'>1- Too simple</option>
                <option value='2'>2</option>
                <option value='3- just right'>3- just right</option>
                <option value='4'>4</option>
                <option value='5- too complicated'>5- too complicated</option>
            </select>
        </p>

        <p>What did you think of the information in the report, would you like to have known more or less?    
            <select class="form-control" v-model="assessment.data.reportFeedback.howMuchInformationInReport">
                <option value='1- Too little'>1- Too little</option>
                <option value='2'>2</option>
                <option value='3- Just right'>3- Just right</option>
                <option value='4'>4</option>
                <option value='5- Too much'>5- Too much</option>
            </select>
        </p>

        <p>How easy do you think it would be for you to explain flexibility to your neighbor?
            <select class="form-control" v-model="assessment.data.reportFeedback.explainToNeighbor">
                <option value='Easy'>Easy</option>
                <option value='It’s complicated, but I’d manag'>It’s complicated, but I’d manage</option>
                <option value='Difficult'>Difficult</option>
                <option value='I wouldn’t even try'>I wouldn’t even try</option>
            </select>
        </p>

        <p>Is there anything else you would like to tell us?
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.anythingElseToShareReportFeedback"></textarea>            
        </p>

        <h2>Please also answer these questions if you are self assessing’</h2>
        <p>The following section is for assessments carried out by the members of the household instead of an Energy Officer</p>
        <p>How easy was it to navigate through the website and begin your self-assessment? 
            <select class="form-control" v-model="assessment.data.reportFeedback.howEasyWasToNavigateTheWebsite">
                <option value='1- Too little'>1- Very easy</option>
                <option value='2- Easy'>2- Easy</option>
                <option value='3- Just right'>3- Just right</option>
                <option value='4- Difficult'>4- Difficult</option>
                <option value='5- Too difficult'>5- Very difficult</option>
            </select>
        </p>
        <p>How clear was the guidance provided to help you fill in the self-assessment? 
            <select class="form-control" v-model="assessment.data.reportFeedback.howClearWasTheGuidance">
                <option value='1- Very clear'>1- Very clear</option>
                <option value='2- Clear'>2- Clear</option>
                <option value='3- Just right'>3- Just right</option>
                <option value='4- Not clear'>4- Not clear</option>
                <option value='5- I didn\'t understand it at all'>5- I didn't understand it at all</option>
            </select>
        </p>
        <p>How easy was it for you to find all the information you needed to fill in the self-assessment? 
            <select class="form-control" v-model="assessment.data.reportFeedback.howEasyWasToFindTheInformationYouNeeded">
                <option value='1- Too little'>1- Very easy</option>
                <option value='2- Easy'>2- Easy</option>
                <option value='3- Just right'>3- Just right</option>
                <option value='4- Difficult'>4- Difficult</option>
                <option value='5- Too difficult'>5- Very difficult</option>
            </select>
        </p>
        <p>How easy was it to understand the report? 
            <select class="form-control" v-model="assessment.data.reportFeedback.howEasyWasToUnderstandTheReport">
                <option value='1- Too little'>1- Very easy</option>
                <option value='2- Easy'>2- Easy</option>
                <option value='3- Just right'>3- Just right</option>
                <option value='4- Difficult'>4- Difficult</option>
                <option value='5- Too difficult'>5- Very difficult</option>
            </select>
        </p>
        <p>What would you change to make self-assessment easier?
            <textarea  style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.whatWouldYouChangeToMakeSelfAssessmentEasier"></textarea>
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

    export default{
        mixins: [AssessmentInput],
        created: function () {
            console.log(this.assessment.data)

            // For backwards compatibility
            if (this.assessment.data.reportFeedback == undefined || Array.isArray(this.assessment.data.reportFeedback) == true) {
                Vue.set(this.assessment.data, 'reportFeedback', {});
            }
            if (this.assessment.data.reportFeedback.preparedToPayUpfront == undefined) {
                Vue.set(this.assessment.data.reportFeedback, 'preparedToPayUpfront', {no: 0, yesToJoin: 0, yesUpgradeHeating: 0});
            }
            if (this.assessment.data.reportFeedback.clarificationsNeeded == undefined) {
                Vue.set(this.assessment.data.reportFeedback, 'clarificationsNeeded', "");
            }
            if (this.assessment.data.reportFeedback.enoughEarnings == undefined) {
                Vue.set(this.assessment.data.reportFeedback, 'enoughEarnings', "");
            }
            if (this.assessment.data.reportFeedback.preparedToPayUpfrontHowMuch == undefined) {
                Vue.set(this.assessment.data.reportFeedback, 'preparedToPayUpfrontHowMuch', "");
            }
            if (this.assessment.data.reportFeedback.howMuchInformationInReport == undefined) {
                Vue.set(this.assessment.data.reportFeedback, 'howMuchInformationInReport', "");
            }
            if (this.assessment.data.reportFeedback.explainToNeighbor == undefined) {
                Vue.set(this.assessment.data.reportFeedback, 'explainToNeighbor', "");
            }
        }
    }

</script>