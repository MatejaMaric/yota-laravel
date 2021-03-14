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
    }
  },
  mutations: {
    setSelectedSign(state, sign) {
      state.selectedSign = sign;
    },
    fillSigns(state, signs) {
      state.callSigns = signs;
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
    }
  }
});
