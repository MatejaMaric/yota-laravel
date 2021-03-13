window._ = require('lodash');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');
window.Vuex = require('vuex');
Vue.use(Vuex);

window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js');
require('bootstrap');
