<template>
  <div>
    <label for="call-sign">Filter by special callsign: </label>
    <select id="call-sign" v-model="selected">
      <option value="all">All</option>
      <option v-for="option in options" :key="option.id" :value="option.sign" v-text="option.sign"></option>
    </select>

    <div class="card mb-3" v-if="showDescriptions && (selected !== 'all')">
      <div class="card-body pb-1">
        <div class="card-text" v-html="description"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['showDescriptions'],
  mounted() {
    this.$store.dispatch('pullSigns');
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
    },
    description() {
      for (let i = 0; i < this.options.length; i++)
        if (this.options[i].sign === this.selected)
          return this.options[i].description;
      return '';
    }
  }
}
</script>
