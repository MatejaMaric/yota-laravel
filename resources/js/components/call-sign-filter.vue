<template>
  <select v-model="selected">
    <option value="all">All</option>
    <option v-for="option in options" :value="option" v-text="option"></option>
  </select>
</template>

<script>
import store from '../store.js';

export default {
  data() {
    return {
      selected: store.state.selectedSign,
      //options: store.state.callSigns
    }
  },
  mounted() {
    store.dispatch('getSigns');
  },
  computed: {
    options() {
      return store.state.callSigns;
    }
  }
}
</script>
