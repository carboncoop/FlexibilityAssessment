<template>
    <div id="assessment-form">
        <h1>Flexibility assessment - Report feedback</h1>
        <p class="red">Do we want an intro here?</p>

        <p>Which of the flexibility offers would you choose, and why?
            <select class="form-control" v-model="assessment.data.reportFeedback.flexibilityOfferChosen">
                <option style="color: red">Update when we know the possible schemes</option>
            </select>
        </p>

        <p>What do you think of the report? - what was good, and what needs improving?
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.whatDoYouThinkOfReport"></textarea>            
        </p>

        <p>Is the report language too simple or complicated?           
            <select class="form-control" v-model="assessment.data.reportFeedback.reportLanguage">
                <option value='1- Too simple'>1- Too simple</option>
                <option value='2'>2</option>
                <option value='3- just right'>3- just right</option>
                <option value='4'>4</option>
                <option value='5- too complicated'>5- too complicated</option>
            </select>
        </p>

        <p>Is there too much or too little information given in the report?       
            <select class="form-control" v-model="assessment.data.reportFeedback.howMuchInformationInReport">
                <option value='1- Too little'>1- Too little</option>
                <option value='2'>2</option>
                <option value='3- Just right'>3- Just right</option>
                <option value='4'>4</option>
                <option value='5- Too much'>5- Too much</option>
            </select>
        </p>

        <p>Anything else you want to share?
            <textarea style='display:block' rows='4' cols='75' v-model="assessment.data.reportFeedback.anythingElseToShareReportFeedback"></textarea>            
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