$(document).ready(function () {
    let table = $('#table_id').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Экспорт в Excel',
                exportOptions: {
                    columns: [ 'th:not(.not-export-table)' ],
                }
            }
        ],
        scrollX: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1,
            header: true
        },
        columnDefs: [
            { width: '10px', targets: 0 },
            { targets: -1, className: 'action_table' },
            { targets: [0, -1], className: 'not-export-table' },
            { width: '170px', targets: '_all' },
        ]
    });

    $('.details-control').click(function () {
        let tr = $(this).closest('tr'),
            row = table.row( tr ),
            id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: location.href + '/' + id,
            dataType: "json",
            success: function (response) {
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(response)).show();
                    tr.addClass('shown');
                }
            }
        });
    } );
});

function format(d) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Создано:</td>'+
            '<td>'+ d.created_at +'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Обновлено:</td>'+
            '<td>'+ d.updated_at +'</td>'+
        '</tr>'+
    '</table>';
}