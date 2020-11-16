$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
    }
});

jQuery('select#call-sign').change(fillTable);
jQuery(document).ready(fillTable);

function fillTable() {
    tableData = jQuery('table#ajax-table>tbody').first();
    tableData.html('<tr><td class="font-weight-bold text-center" colspan="13">Loading...</td></tr>');

    sign = jQuery('select#call-sign').first().val();

    jQuery.post('/special-calls/reservations', {'call-sign': sign}, function (data, status) {
        if (status === 'success') {
            if (data.data.length > 0) {
                tableData.empty();
                for (var i = 0, len = data.data.length; i < len; i++) {
                    tr = '<tr>';
                    tr += '<td>' + data.data[i].id + '</td>';
                    if (data.data[i].approved === 1)
                        tr += '<td class="text-center"><input type="checkbox" checked></td>';
                    else
                        tr += '<td class="text-center"><input type="checkbox"></td>';

                    tr +=
                        '<td contenteditable="true">' + data.data[i].operatorCall + '</td>' +
                        '<td contenteditable="true">' + data.data[i].qso + '</td>' +
                        '<td contenteditable="true">' + data.data[i].fromTime + '</td>' +
                        '<td contenteditable="true">' + data.data[i].toTime + '</td>' +
                        '<td contenteditable="true">' + data.data[i].specialCall + '</td>' +
                        '<td contenteditable="true">' + data.data[i].frequencies + '</td>' +
                        '<td contenteditable="true">' + data.data[i].modes + '</td>' +
                        '<td contenteditable="true">' + data.data[i].operatorName + '</td>' +
                        '<td contenteditable="true">' + data.data[i].operatorEmail + '</td>' +
                        '<td contenteditable="true">' + data.data[i].operatorPhone + '</td>';
                    tr += '<td>';
                    tr += "<button class=\"btn btn-primary mr-2\" onclick=\"btnAction('update', this)\">Update</button>";
                    tr += "<button class=\"btn btn-warning mr-2\" onclick=\"btnAction('restore', this)\">Restore</button>";
                    tr += "<button class=\"btn btn-danger\" onclick=\"btnAction('delete', this)\">Delete</button>";
                    tr += '</td>';
                    tr += '</tr>';
                    tableData.append(tr);
                }
            }
            else {
                tableData.html('<tr><td class="font-weight-bold text-center" colspan="13">No data...</td></tr>');
            }
        }
        else {
            tableData.html('<tr><td class="font-weight-bold text-center" colspan="13">Error!</td></tr>');
        }
    });
}

function btnAction(action, btn) {
    console.log(action);
}
