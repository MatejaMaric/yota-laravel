require('./bootstrap');

import Vue from 'vue';

import store from './store.js';

import callSignFilter from './components/call-sign-filter.vue';
import callSignDescription from './components/call-sign-description.vue';

import activitiesView from './components/activities.vue';
import reservationView from './components/reservation.vue';
import reservationsView from './components/reservations.vue';

new Vue({
  el: '#vue',
  store,
  components: {
    callSignDescription,
    callSignFilter,
    activitiesView,
    reservationView,
    reservationsView
  }
});
