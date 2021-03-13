require('./bootstrap');

//import store from './store.js';
require('./store');

import callSignDesc from './components/call-sign-description.vue';
import callSignFilter from './components/call-sign-filter.vue';
import activities from './components/activities.vue';
import reservation from './components/reservation.vue';
import reservations from './components/reservations.vue';

new Vue({
  el: '#vue',
  components: {
    callSignDesc,
    callSignFilter,
    activities,
    reservation,
    reservations
  }
});
