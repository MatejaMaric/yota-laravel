require('./bootstrap');

import Vue from 'vue';

import store from './store.js';

import callSignDescription from './components/call-sign-description.vue';

import activitiesView from './components/activities.vue';
import reservationsView from './components/reservations.vue';

new Vue({
  el: '#vue',
  store,
  components: {
    callSignDescription,
    activitiesView,
    reservationsView
  }
});
