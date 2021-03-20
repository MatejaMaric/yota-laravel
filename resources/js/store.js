import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    selectedSign: "all",
    callSigns: [],
    data: []
  },
  getters: {
    getSelectedSign(state) {
      return state.selectedSign;
    },
    getSigns(state) {
      return state.callSigns;
    },
    getData(state) {
      return state.data;
    }
  },
  mutations: {
    setSelectedSign(state, sign) {
      state.selectedSign = sign;
    },
    setSigns(state, signs) {
      state.callSigns = signs;
    },
    setData(state, data) {
      state.data = data;
    }
  },
  actions: {
    setSelectedSign(context, sign) {
      context.commit('setSelectedSign', sign);
    },
    async pullSigns(context) {
      await axios.get('/special-calls/show').then(response => {
        context.commit('setSigns', response.data);
      }).catch(error => {
        console.log(error);
      });
    },
    async pullActivities(context) {
      await axios.post('/api/activities', {'call-sign': this.state.selectedSign}).then(response => {
        context.commit('setData', response.data.data);
      }).catch(error => {
        console.log(error);
      });
    },
    async pullReservations(context) {
      await axios.post('/special-calls/reservations', {'call-sign': this.state.selectedSign}).then(response => {
        context.commit('setData', response.data.data);
      }).catch(error => {
        console.log(error);
      });
    }
  }
});
