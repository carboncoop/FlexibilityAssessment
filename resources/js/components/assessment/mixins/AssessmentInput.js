export const AssessmentInput = {
    props: {initialAssessment: Object},
    data: function () {
        return{
            assessment: JSON.parse(JSON.stringify(this.initialAssessment)) // Deep cloning to ensure one way data flow (only from parent component to child)
        }
    },
    watch: {
        assessment: {
            deep: true,
            handler: function () {
                this.debouncedOnAssessmentChange();
            }
        },
        initialAssessment: {
            deep: true,
            handler: function () {
                if (JSON.stringify(this.initialAssessment) != JSON.stringify(this.assessment))
                    this.assessment = JSON.parse(JSON.stringify(this.initialAssessment));
            }
        }
    },
    created: function () {
        this.debouncedOnAssessmentChange = this.debounce(this.onAssessmentChange, 1000);
    },
    methods: {
        onAssessmentChange: function () {
            console.log(this.assessment.data);
            this.$emit('assessmentChange', this.assessment,
                    function () {
                        console.log('data saved');
                    },
                    function (error) {
                        window.alert('Error saving the data - ' + (error.response.data.message || error))
                    }
            );
        },
        debounce: function (func, delay) {
            let inDebounce;
            return function () {
                const context = this;
                const args = arguments;
                clearTimeout(inDebounce);
                inDebounce = setTimeout(() => func.apply(context, args), delay);
            }
        }
    }
};