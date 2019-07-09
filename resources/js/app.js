require('./bootstrap');

import Vue from 'vue'
import VModal from 'vue-js-modal'

Vue.use(VModal)

Vue.component('project-create-modal', require('./components/ProjectCreateModal.vue').default);
Vue.component('project-delete-modal', require('./components/ProjectDeleteModal.vue').default);

const app = new Vue({
    el: '#app',
});
