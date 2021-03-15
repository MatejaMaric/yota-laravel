<template>
  <div>
    <label for="call-sign">Filter by special callsign: </label>
    <select id="call-sign" v-model="selected">
      <option value="all">All</option>
      <option v-for="option in options" :key="option.id" :value="option.sign" v-text="option.sign"></option>
    </select>
  </div>
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
        this.$emit('sign-changed');
      }
    },
    options() {
      return this.$store.getters.getSigns;
    }
  }
}
</script>
