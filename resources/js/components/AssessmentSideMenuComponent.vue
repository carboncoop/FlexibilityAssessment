<template>
    <div id="assessment-side-menu">
        <p> <strong>Name: {{name}}</strong> <font-awesome-icon icon="edit" title="Edit" style="cursor:pointer" 
                                                               v-b-modal.edit-metadata-modal size="xs" 
                                                               v-on:click="iniMetadataModal"
                                                               v-on:ok="saveMetadata" />
        </p>
        <p>Description: {{description}}</p>

        <b-modal id="edit-metadata-modal" ref="editMetadataModal" title="Edit assessment name and description" 
                 v-on:ok="saveMetadata" 
                 v-on:show="error=false">
            <p style="color:red" v-if="error">{{error}}</p>
            <table>
                <tr><td>Name</td><td><input type="text" v-model="newName"></td></tr>
                <tr><td>Description</td><td><input type="text" v-model="newDescription"></td></tr>
            </table>
        </b-modal>
    </div>

</template>

<style scoped>
    #assessment-side-menu{
        max-width:300px;
        position:fixed;
    }
</style>

<script>
    export default{
        props: {initialAssessment: Object},
        data: function () {
            return{
                name: this.initialAssessment.name,
                description: this.initialAssessment.description,
                author: this.initialAssessment.author,
                error: false,
                newName: '',
                newDescription: ''
            }
        },
        methods: {
            iniMetadataModal: function () {
                this.newName = this.name;
                this.newDescription = this.description;
            },
            saveMetadata: function () {
                let toSave = this.initialAssessment;
                toSave.name = this.newName;
                toSave.description = this.description;
                axios.put('/api/assessment/' + this.initialAssessment.id, toSave)
                        .then((response) => {
                            console.log(response);
                            this.name = this.newName;
                            this.description = this.newDescription;
                            this.$refs.editMetadataModal.hide();
                        })
                        .catch((error) => {
                            this.error = 'Error - ' + (error.response.data.message || error);
                        });
            }
        }
    }
</script>