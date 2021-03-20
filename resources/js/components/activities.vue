<template>
  <div>
    <call-sign-filter @sign-changed="filterChanged()"></call-sign-filter>

    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered" style="white-space:nowrap;">
            <thead class="thead-dark">
                <tr>
                  <th>Operator</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Special Callsign</th>
                  <th>Frequencies</th>
                  <th>Modes</th>
                  <th>QSO</th>
                </tr>
            </thead>
            <tbody>
              <tr v-for="(activity, index) in activities" :key="index">
                <td>{{ activity.operatorCall }}</td>
                <td>{{ activity.fromTime }}</td>
                <td>{{ activity.toTime }}</td>
                <td>{{ activity.specialCall }}</td>
                <td>{{ activity.frequencies }}</td>
                <td>{{ activity.modes }}</td>
                <td>{{ activity.qso }}</td>
              </tr>
            </tbody>
        </table>
    </div>
  </div>
</template>

<script>
import callSignFilter from './call-sign-filter.vue';

export default {
  components: { callSignFilter },
  mounted() {
    this.$store.dispatch('pullActivities');
  },
  computed: {
    activities() {
      return this.$store.getters.getData;
    }
  },
  methods: {
    filterChanged() {
      this.$store.dispatch('pullActivities');
    }
  }
}
</script>
