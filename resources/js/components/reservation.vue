<template>
  <tr>
    <td v-text="reservation.id"></td>
    <td><input type="checkbox" :checked="reservation.approved"/></td>
    <td><input type="text" v-model="reservation.operatorCall"></td>
    <td><input type="text" v-model="reservation.qso"></td>
    <td><input type="text" v-model="reservation.fromTime"></td>
    <td><input type="text" v-model="reservation.toTime"></td>
    <td><input type="text" v-model="reservation.specialCall"></td>
    <td><input type="text" v-model="reservation.frequencies"></td>
    <td><input type="text" v-model="reservation.modes"></td>
    <td><input type="text" v-model="reservation.operatorName"></td>
    <td><input type="text" v-model="reservation.operatorEmail"></td>
    <td><input type="text" v-model="reservation.operatorCall"></td>
    <td>
      <button class="btn btn-primary mr-2">Update</button>
      <button class="btn btn-warning mr-2">Restore</button>
      <button class="btn btn-danger">Delete</button>
    </td>
  </tr>
</template>

<script>
export default {
  props: [ 'reservationIndex' ],
  computed: {
    reservation() {
      return this.$store.getters.getData[this.reservationIndex];
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
