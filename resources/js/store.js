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
    fillSigns(state, signs) {
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
    async fillSigns(context) {
      await axios.get('/special-calls/show').then(response => {
        context.commit('fillSigns', response.data);
      }).catch(error => {
        console.log(error);
      });
    },
    async fillData(context) {
      await axios.post('/api/activities', {'call-sign': this.state.selectedSign}).then(response => {
        context.commit('setData', response.data.data);
      }).catch(error => {
        console.log(error);
      });
    }
  }
});
