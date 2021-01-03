$(document).ready( function () {
    $('#table_reports').DataTable({
        dom: 'Blfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: 'Экспорт в Excel',
            exportOptions: {
                columns: [ 'th:not(.not-export-table)' ],
            },
            customize: function (xlsx) {
                let sheet = xlsx.xl.worksheets['sheet1.xml'],
                    col = $('col', sheet);

                col.each(function () {
                    $(this).attr('width', 70);
                })
            }
        }],
        columnDefs: [
            { targets: -1, width: '70px', className: 'action_table not-export-table' },
        ],
    });

    $('#table_users').DataTable({
        columnDefs: [
            {targets: -1, width: '150px', className: 'action_table'},
            {targets: '_all', width: '200px'},
        ],
    });

    $('#table_groups').DataTable({
        columns: [
            {title: 'Название группы'},
            {
                title: '',
                className: 'action_table not-export-table'
            }
        ],
        columnDefs: [
            {width: '15%', targets: 1},
            {width: '200px', targets: '_all'},
        ],
    });

    $('.actions-control').click(function (e) { 
        e.preventDefault();
        
        $(this).siblings('.action-menu').toggleClass('active');
    });
});

function actionMenu() {
    return '<div class="action-menu">'+
        '<button class="action-btn"><span class="material-icons">reply</span></button>'+
        '<button class="action-btn"><span class="material-icons">edit</span></button>'+
        '<button class="action-btn"><span class="material-icons">remove</span></button>'+
    '</div>';
}