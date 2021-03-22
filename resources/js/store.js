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
      await axios.post('/api/reservations', {
        action: 'update',
        ...data.reservation
      }).then(() => {
        context.commit('setDataRow', {
          index: data.index,
          data: data.reservation
        });
      }).catch(error => {
        console.log(error);
        alert("Couldn't update reservation! Bad data!");
      });
    },
    async removeReservation(context, index) {
      let data = {
        action: 'delete',
        ...this.state.data[index]
      };
      if (confirm(`Are you sure you want to delete reservation #${data.id} made by ${data.operatorCall}?`) === true) {
        await axios.post('/api/reservations', data).then(() => {
          context.commit('removeDataRow', index);
        }).catch(error => {
          console.log(error);
          alert('Unable to remove reservation!');
        });
      }
    }
  }
});
