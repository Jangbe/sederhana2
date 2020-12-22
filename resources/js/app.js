require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';

Vue.use(VueRouter);
Vue.use(Toasted);

Vue.component('navigation', require('./components/Navigation.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('kategori', require('./components/Category.vue').default);
Vue.component('spinner', require('vue-simple-spinner'));

import App from './App.vue';

import routes from './router';
const user = new Vue({
    el: '#user',
    router: new VueRouter(routes),
    render: view => view(App),
});
