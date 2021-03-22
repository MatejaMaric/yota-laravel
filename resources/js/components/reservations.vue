<template>
  <div>
    <call-sign-filter @sign-changed="filterChanged()"></call-sign-filter>

    <div class="table-responsive mt-2">
        <table id="ajax-table" class="table table-striped table-bordered" style="white-space:nowrap;"><!-- table-hover -->
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Approved</th>
                    <th>Operator Callsign</th>
                    <th>QSO</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Special Callsign</th>
                    <th>Frequencies</th>
                    <th>Modes</th>
                    <th>Operator Name</th>
                    <th>Operator Email</th>
                    <th>Operator Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <reservation-view v-for="(reservation, index) in reservations" 
                :key="reservation.id" :reservation-index="index">
              </reservation-view>
            </tbody>
        </table>
    </div>
  </div>
</template>

<script>
import callSignFilter from './call-sign-filter.vue';
import reservationView from './reservation.vue';

export default {
  components: { callSignFilter, reservationView },
  mounted() {
    this.$store.dispatch('pullReservations');
  },
  computed: {
    reservations() {
      return this.$store.getters.getData;
    }
  },
  methods: {
    filterChanged() {
      this.$store.dispatch('pullReservations');
    }
  }
}
</script>

<style scoped>
@media only screen and (min-width:961px) {
  .table-responsive {
    max-height: 80vh;
  }
}
</style>
