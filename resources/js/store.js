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
    },
    getDataRow(state) {
      return (index) => _.cloneDeep(state.data[index]);
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
    },
    setDataRow(state, row) {
      state.data[row.index] = _.cloneDeep(row.data);
    },
    removeDataRow(state, index) {
      state.data.splice(index, 1);
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
    },
    async pushReservation(context, data) {
      context.commit('setDataRow', {
        index: data.index,
        data: data.reservation
      });
    },
    async removeReservation(context, index) {
      context.commit('removeDataRow', index);
    }
  }
});
