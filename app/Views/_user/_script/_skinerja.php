<script type="text/javascript"> 
$(document).ready(function() {
    table_absen = $('#tb_kinerja').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        dom : 'Blrtip',
    //     buttons: [
    //     {
    //         extend: 'excelHtml5',
    //         exportOptions: {
    //             columns : [0,1,2,3,4,5,6]
    //         }
    //     }
    // ],
        order: [[1, 'desc']], //init datatable not ordering
        ajax: {
            url: '<?php echo site_url('recordkinerja')?>',
            // data: function (d) {
            //     d.status = $('#filterStatus').val();
            //     d.datemin = $('#date-val').val().substr(0,10);
            //     d.datemax = $('#date-val').val().substr(13,10);
            // }
        },
        columns: [
            {data: 'no', orderable:false},
            {data: 'act_tgl',
                render: function(data, type, row, meta) {
                    // return row.abs_hari + ', ' + row.abs_tgl
                    return row.act_tgl
            }},
            {data: 'act_qty', orderable:false},
            {data: 'act_ket', orderable:false},
            {data: 'act_output', orderable:false},
            {data: 'action', orderable: false},
        ]
    });
});
</script> 