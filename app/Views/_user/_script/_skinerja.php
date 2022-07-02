<script type="text/javascript"> 
moment.locale('id');
$(document).ready(function() {
    table_absen = $('#tb_kinerja').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        dom : 'lrtip',
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
                    
                    return moment(new Date(row.act_tgl)).format('dddd, Do MMMM YYYY')
            }},
            {data: 'act_qty', orderable:false},
            {data: 'act_ket', orderable:false, visible:false},
            {data: 'act_output', orderable:false},
            {data: 'action', orderable: false},
        ]
    });

    $(document).on('click','#btnactdetail',function(){ 
        var id = $(this).attr('data-id');
        $.ajax({
            url : "<?php echo site_url('actdetails')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);
    
                $('#detailsdate').html(moment(new Date(data.act_tgl)).format('dddd, Do MMMM YYYY'));
                $('#detailsjumlah').html(data.act_qty);
                $('#detailsket').html(data.act_ket);
                $('#detailsoutput').html(data.act_output);
                
    
                $('#modal-actdetails').modal('show');
                $('.modal-title').text('Detail Kegiatan');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
    });
    });
});
</script> 