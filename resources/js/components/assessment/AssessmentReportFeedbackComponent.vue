<template>
    <div id="assessment-form">
        <h1>Flexibility assessment - Report feedback</h1>

        <h2>About the report</h2>
        <p>Which of the flexibility offers would you choose, and why?
            <select class="form-control" v-model="assessment.data.reportFeedback.flexibilityOfferChosen">
                <option value="Secure">Secure</option>
                <option value="Dynamic">Dynamic</option>
                <option value="Restore">Restore</option>
            </select>
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

        <p>Is there anything else you would like to tell us?
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.anythingElseToShareReportFeedback"></textarea>            
        </p>
        
        <h2>Self assessment</h2>
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
            if (this.assessment.data.reportFeedback == undefined) {
                Vue.set(this.assessment.data, 'reportFeedback', {});
            }
        }
    }

</script>