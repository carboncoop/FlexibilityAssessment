<template>
    <div id='organisation-users-component'>
        <button v-b-modal.new-user-modal dusk="new-button" style='float:right; margin: 0 25px 10px; cursor: pointer'>New</button>
        <b-table striped hover responsive fixed :items="usersForTable" :fields="tableColumns" :outlined="true">
                 <template slot="actions" slot-scope="data">
                <button v-b-modal.edit-user-modal v-bind:dusk="'edit-user-' + data.item.name" v-on:click="newUser.name=data.item.name; newUser.email=data.item.email; newUser.role=data.item.role; newUser.id=data.item.id"><a class="edit-user" ><font-awesome-icon icon="edit" size="xs" title="Edit user" style="cursor:pointer" /></a></button>
                <button v-b-modal.delete-user-modal v-bind:dusk="'delete-user-' + data.item.name" v-on:click="setUserToDelete(data.item.id)"><font-awesome-icon icon="trash" size="xs" title="Delete" style="cursor:pointer" /></button>
            </template>
        </b-table>

        <b-modal id="new-user-modal" ref="newUserModal" title="New user" 
                 v-on:ok="createUser" 
                 v-on:show="error=false" 
                 v-on:hidden="newUser.name=''; newUser.email=''; newUserRole=''; newUser.password=''; newUser.confirmPassword='';">
            <p style="color:red" v-if="error" v-html="error"></p>
            <table>
                <tr><td>Name</td><td><input type="text" name="name" dusk="input-name" class="form-control" v-model="newUser.name" placeholder="My name"></td></tr>
                <tr><td>Email</td><td><input type="text" name="email" dusk="input-email"  class="form-control" v-model="newUser.email" placeholder="email@email.com"></td></tr>
                <tr><td>Role</td><td><select class="form-control" dusk="select-role" v-model="newUser.role"><option value="administrator">Administrator</option><option value="assessor">Energy Officer</option><option value="invited">Invited user</option></select></td></tr>
                <tr><td>Password</td><td><input type="password" name="password" class="form-control" v-model="newUser.password" placeholder="****"></td></tr>
                <tr><td>Confirm password</td><td><input type="password" name="confirm-password" class="form-control" v-model="newUser.confirmPassword" placeholder="****"></td></tr>
            </table>
        </b-modal>

        <b-modal id="delete-user-modal" ref ="deleteUserModal" title="Are you sure you want to delete the user?" 
                 v-on:ok="deleteUser" 
                 v-on:show="error=false">
            <p style="color:red" v-if="error" v-html="error"></p>
            <p>This action cannot be undone</p>
        </b-modal>



        <b-modal id="edit-user-modal" ref="editUserModal" title="Edit user" 
                 v-on:ok="editUser" 
                 v-on:show="error=false" 
                 v-on:hidden="newUser.name=''; newUser.email=''; newUserRole='';"
                 ok-title="Save">
            <p style="color:red" v-if="error" v-html="error"></p>
            <table>
                <tr><td>Name</td><td><input type="text" name="name" dusk="edit-name" class="form-control" v-model="newUser.name" placeholder="My asessment"></td></tr>
                <tr><td>Email</td><td><input type="text" name="email" dusk="edit-email" class="form-control" v-model="newUser.email" placeholder="email@email.com"></td></tr>
                <tr><td>Role</td><td><select class="form-control" dusk="edit-role" v-model="newUser.role"><option value="administrator">Administrator</option><option value="assessor">Energy Officer</option><option value="invited">Invited user</option></select></td></tr>
            </table>
        </b-modal>

    </div>
</template>

<style scoped>
</style>

<script>    
    
    import {AxiosErrorCallback} from './mixins/AxiosErrorCallback.js';

    export default {
        mixins: [AxiosErrorCallback],
        props: {
            'users': Array
        },
        data: function () {
            return {
                newUser: {name: '', email: '', password: '', confirmPassword: '', id: 0},
                error: false,
                usersForTable: this.users,
                userToDelete: 0,
                tableColumns: {'name': {sortable: true}, 'email': {sortable: true}, 'role': {sortable: true}, last_login: {sortable: true}, actions: {}}
            };
        },
        methods: {
            createUser: function (evt) {
                this.error = false;
                evt.preventDefault(); // Prevent modal from closing

                if (!this.newUser.name)
                    this.error = 'Please enter a name';
                else if (!this.newUser.email)
                    this.error = 'Please enter an email';
                else if (!this.newUser.role)
                    this.error = 'Please choose a role';
                else if (this.newUser.password.length < 6)
                    this.error = 'Password too short';
                else if (this.newUser.password != this.newUser.confirmPassword)
                    this.error = 'Passwords don\'t match';
                else {
                    axios.post('/api/organisation-user', this.newUser)
                            .then((response) => {
                                this.usersForTable.push(response.data);
                                this.$refs.newUserModal.hide();
                            })
                            .catch((error) => {
                                this.axiosErrorCallback(error);
                            });
                }
            },
            setUserToDelete: function (id) {
                this.userToDelete = id;
            },
            deleteUser: function (evt) {
                evt.preventDefault(); // Prevent modal from closing
                this.error = false;
                axios.delete("/api/organisation-user/" + this.userToDelete)
                        .then((response) => {
                            let userToDelete = this.userToDelete;
                            let indexOfUser = this.usersForTable.findIndex(function (user) {
                                return user.id == userToDelete;
                            });
                            this.usersForTable.splice(indexOfUser, 1);
                            this.$refs.deleteUserModal.hide();
                        })
                        .catch((error) => {
                            this.axiosErrorCallback(error);
                        })
            },
            editUser: function (evt) {
                evt.preventDefault(); // Prevent modal from closing
                this.error = false;
                axios.put("/api/organisation-user/" + this.newUser.id, this.newUser)
                        .then((response) => {
                            let newUser = this.newUser;
                            let indexOfUser = this.usersForTable.findIndex(function (user) {
                                return user.id == newUser.id;
                            });
                            this.usersForTable[indexOfUser].name = this.newUser.name;
                            this.usersForTable[indexOfUser].email = this.newUser.email;
                            this.usersForTable[indexOfUser].role = this.newUser.role;
                            this.$refs.editUserModal.hide();
                        })
                        .catch((error) => {
                            this.axiosErrorCallback(error);
                        });
            }
        },
        mounted: function () {
            console.log(this.users);
        }
    }
</script>
