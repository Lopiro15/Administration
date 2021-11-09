require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

window.Vue = require('vue');

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('addville', require('./components/AddVilleComponent.vue').default);
Vue.component('editville', require('./components/EditVilleComponent.vue').default);

Vue.component('addpoint', require('./components/AddPointComponent.vue').default);
Vue.component('editpoint', require('./components/EditPointComponent.vue').default);

Vue.component('graphe', require('./components/GrapheComponent.vue').default);

import Home from './components/DashboardComponent.vue';
import Point from './components/PointComponent.vue';
import Ville from './components/VilleComponent.vue';

const routes = [{
        path: '/',
        component: Home
    },
    {
        path: '/point',
        component: Point
    },
    {
        path: '/ville',
        component: Ville
    }
];

const router = new VueRouter({ routes });

const app = new Vue({
    el: '#app',
});

const apphome = new Vue({
    el: '#apphome',
    router: router
});