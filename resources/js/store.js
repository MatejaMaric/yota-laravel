import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
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
    fillSigns(context) {
      let data = ['test', 'TEST', 'TeSt'];
      context.commit('fillSigns', data);
    }
  }
});

export default store;
