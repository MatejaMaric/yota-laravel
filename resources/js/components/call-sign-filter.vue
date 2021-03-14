<template>
  <select v-model="selected">
    <option value="all">All</option>
    <option v-for="option in options" :value="option.sign" v-text="option.sign"></option>
  </select>
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch('fillSigns');
  },
  computed: {
    selected: {
      get() {
        return this.$store.getters.getSelectedSign;
      },
      set(value) {
        this.$store.dispatch('setSelectedSign', value);
      }
    },
    options() {
      return this.$store.getters.getSigns;
    }
  }
}
</script>
