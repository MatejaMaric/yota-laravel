<template>
  <div>
    <call-sign-filter></call-sign-filter>

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
            </tbody>
        </table>
    </div>
  </div>
</template>

<script>
import callSignFilter from './call-sign-filter.vue';

export default {
  components: { callSignFilter }
}
</script>
