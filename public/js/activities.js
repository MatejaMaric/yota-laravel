$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
    }
});

jQuery('select#call-sign').change(fillTable);
jQuery(document).ready(fillTable);

function fillTable() {
    tableData = jQuery('table#ajax-table>tbody').first();
    tableData.html('<tr><td class="font-weight-bold text-center" colspan="6">Loading...</td></tr>');

    sign = jQuery('select#call-sign').first().val();

    jQuery.post('/api/activities', {'call-sign': sign}, function (data, status) {
        if (status === 'success') {
            if (data.data.length > 0) {
                tableData.empty();
                for (var i = 0, len = data.data.length; i < len; i++) {
                    tr = '<tr><td>' + data.data[i].operatorCall + '</td>' +
                        '<td>' + data.data[i].fromTime + '</td>' +
                        '<td>' + data.data[i].toTime + '</td>' +
                        '<td>' + data.data[i].specialCall + '</td>' +
                        '<td>' + data.data[i].frequencies + '</td>' +
                        '<td>' + data.data[i].qso + '</td></tr>';
                    tableData.append(tr);
                }
            }
            else {
                tableData.html('<tr><td class="font-weight-bold text-center" colspan="6">No data...</td></tr>');
            }
        }
        else {
            tableData.html('<tr><td class="font-weight-bold text-center" colspan="6">Error!</td></tr>');
        }
    });
}