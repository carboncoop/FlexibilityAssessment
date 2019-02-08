
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');
require('./bootstrap');

// FontAwesome icons - only the ones used. Find all here: https://fontawesome.com/cheatsheet
import { library } from '@fortawesome/fontawesome-svg-core';
import { faTrash } from '@fortawesome/free-solid-svg-icons';
import { faEdit } from '@fortawesome/free-solid-svg-icons';
import { faQuestionCircle } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faTrash, faEdit, faQuestionCircle);


/**
 * Register components
 */

Vue.component('assessments-table', require('./components/assessment/AssessmentsTableComponent.vue'));
Vue.component('assessment', require('./components/assessment/AssessmentComponent.vue'));
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('organisation-users',require('./components/organisation/OrganisationUsersComponent.vue'));
Vue.component('organisation-details',require('./components/organisation/OrganisationDetailsComponent.vue'));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
