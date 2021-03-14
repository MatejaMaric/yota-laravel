<template>
  <select v-model="selected">
    <option value="all">All</option>
    <option v-for="option in options" :value="option" v-text="option"></option>
  </select>
</template>

<script>
import store from '../store.js';

export default {
  mounted() {
    store.dispatch('fillSigns');
  },
  computed: {
    selected: {
      get() {
        return store.getters.getSelectedSign;
      },
      set(value) {
        store.dispatch('setSelectedSign', value);
      }
    },
    options() {
      return store.getters.getSigns;
    }
  }
}
</script>
