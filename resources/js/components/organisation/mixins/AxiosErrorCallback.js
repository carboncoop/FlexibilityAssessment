export const AxiosErrorCallback = {
    methods: {
        axiosErrorCallback: function (error) {
            console.log(error);
            this.error = 'Error ';
            if (error.response.data.errors) {
                for (let errorKey in error.response.data.errors) {
                    this.error += "<br /> " + error.response.data.errors[errorKey];
                }
                ;
            }
            else if (error.response.data.message)
                this.error += '- ' + error.response.data.message;
            else
                this.error += '- ' + error;
        }
    }
}