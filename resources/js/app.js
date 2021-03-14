require('./bootstrap');

import Vue from 'vue';

import store from './store.js';

import callSignFilter from './components/call-sign-filter.vue';
import callSignDesc from './components/call-sign-description.vue';

import activities from './components/activities.vue';
import reservation from './components/reservation.vue';
import reservations from './components/reservations.vue';

new Vue({
  el: '#vue',
  store,
  components: {
    callSignDesc,
    callSignFilter,
    activities,
    reservation,
    reservations
  }
});
