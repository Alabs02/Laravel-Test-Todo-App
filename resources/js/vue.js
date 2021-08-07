window.Vue = require('vue').default;


Vue.component('app-component', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
});
