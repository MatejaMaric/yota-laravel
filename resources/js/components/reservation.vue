<template>
  <tr>
    <td v-text="reservation.id"></td>
    <td><input type="checkbox" v-model="reservation.approved"/></td>
    <td><input type="text" v-model="reservation.operatorCall"></td>
    <td><input type="text" v-model="reservation.qso"></td>
    <td><input type="text" v-model="reservation.fromTime"></td>
    <td><input type="text" v-model="reservation.toTime"></td>
    <td><input type="text" v-model="reservation.specialCall"></td>
    <td><input type="text" v-model="reservation.frequencies"></td>
    <td><input type="text" v-model="reservation.modes"></td>
    <td><input type="text" v-model="reservation.operatorName"></td>
    <td><input type="text" v-model="reservation.operatorEmail"></td>
    <td><input type="text" v-model="reservation.operatorPhone"></td>
    <td>
      <button class="btn btn-primary mr-2" @click="updateRow">Update</button>
      <button class="btn btn-warning mr-2" @click="restoreRow">Restore</button>
      <button class="btn btn-danger" @click="deleteRow">Delete</button>
    </td>
  </tr>
</template>

<script>
export default {
  props: [ 'reservationIndex' ],
  data() {
    return {
      reservation: this.$store.getters.getDataRow(this.reservationIndex)
    }
  },
  methods: {
    updateRow() {
      this.$store.dispatch('pushReservation', {
        index: this.reservationIndex,
        reservation: this.reservation
      });
    },
    restoreRow() {
      this.reservation = this.$store.getters.getDataRow(this.reservationIndex);
    },
    deleteRow() {
      this.$store.dispatch('removeReservation', this.reservationIndex);
    }
  }
}
</script>

<style scoped>
td {
  text-align: center;
  vertical-align: middle;
}
input {
  background-color: white;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 0.2em;
}
</style>
