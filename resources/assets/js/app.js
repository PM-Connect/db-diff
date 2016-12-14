
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Utils
Vue.component('alerts', require('./components/Alerts/Alerts.vue'));

// Components
Vue.component('database-list', require('./components/Database/List.vue'));
Vue.component('diff-list', require('./components/Diff/List.vue'));

const app = new Vue({
    el: '#app'
});