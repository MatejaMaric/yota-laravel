<template>
  <div>
    <div class="form-group">
        <label for="special-call">Special Callsign:</label>
        <select class="form-control" id="special-call" v-model="selected" name="scall" required>
          <option v-for="option in options" :key="option.id" :value="option.sign" v-text="option.sign"></option>
        </select> 
    </div>

    <div class="card mb-3">
      <div class="card-body pb-1">
        <div class="card-text" v-html="description"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch('pullSigns').then(() => {
      try {
        this.$store.dispatch('setSelectedSign', this.$store.getters.getSigns[0].sign);
      }
      catch {
        console.log('No call signs!');
      }
    });
  },
  computed: {
    options() {
      return this.$store.getters.getSigns;
    },
    selected: {
      get() {
        return this.$store.getters.getSelectedSign;
      },
      set(value) {
        this.$store.dispatch('setSelectedSign', value);
      }
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
