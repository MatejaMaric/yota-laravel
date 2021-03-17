<template>
  <tr>
    <td>{{ reservation.id }}</td>
    <td>
      <input type="checkbox" :checked="reservation.approved"/>
    </td>
    <td contenteditable="true">{{ reservation.operatorCall }}</td>
    <td contenteditable="true">{{ reservation.qso }}</td>
    <td contenteditable="true">{{ reservation.fromTime }}</td>
    <td contenteditable="true">{{ reservation.toTime }}</td>
    <td contenteditable="true">{{ reservation.specialCall }}</td>
    <td contenteditable="true">{{ reservation.frequencies }}</td>
    <td contenteditable="true">{{ reservation.modes }}</td>
    <td contenteditable="true">{{ reservation.operatorName }}</td>
    <td contenteditable="true">{{ reservation.operatorEmail }}</td>
    <td contenteditable="true">{{ reservation.operatorCall }}</td>
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
