/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

let recaptchaScript = document.createElement('script');
recaptchaScript.setAttribute('src', 'https://www.google.com/recaptcha/api.js');
document.head.appendChild(recaptchaScript);

Vue.component('shortlink', require('./components/Shortlink.vue').default);
Vue.component('options', require('./components/Options.vue').default);
Vue.component('progressbar', require('./components/ProgressBar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs. s
 */

const app = new Vue({
    el: '#app',
});
