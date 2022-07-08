<script type="text/javascript"> 
moment.locale('id');
$(document).ready(function() {
    table_kinerja = $('#tb_kinerja').DataTable({
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
            // {className: 'text-end', targets: [] },
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

    $(document).on('click','#btnactedit',function(){ 
        var id = $(this).attr('data-id');
        $.ajax({
            url : "<?php echo site_url('actdetails')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                console.log(data);
    
                $('#frm_act_id').val(data.act_id);
                $('#frm_act_tgl').val(data.act_tgl);
                $('#frm_act_qty').val(data.act_qty);
                $('#frm_act_ket').val(data.act_ket);
                $('#frm_act_output').val(data.act_output);
                
    
                $('#modal-actedit').modal('show');
                $('.modal-title').text('Edit Laporan Kegiatan');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    });

    // edit
    $(function (){

        let validator = $('form.validator-edit').jbvalidator({
            errorMessage: true,
            successClass: false,
            language: "<?php base_url()?>/assets/dist/libs/jbvalidator/lang/en.json",
        });

        // validator.checkAll();
        //serverside
        $(document).on('click','#btn-actedit-send',function(e){
            if (validator.checkAll()) {
                e.preventDefault();
            } else {
                var act_id = $('#frm_act_id').val();
                var act_qty = $('#frm_act_qty').val();
                var act_ket = $('#frm_act_ket').val();
                var act_output = $('#frm_act_output').val();

                console.log(act_id);

                $.ajax({
                    url:'<?= site_url('editkinerja') ?>',
                    method:'post',
                    data:
                        {
                            activity_act_id:act_id,
                            activity_act_qty:act_qty,
                            activity_act_ket:act_ket,
                            activity_act_output:act_output

                        },
                    success:function(response){
                        // if(response.status === 'Terkirim') {
                        //         validatorServerSide.errorTrigger($('[name=frm_act_tgl]'), response.message);
                        // }
                        $('#modal-actedit').modal('hide');
                        $('#modal-actedit').find("input,textarea,select").val('');
                        
                        table_kinerja.ajax.reload();     

                        Swal.fire(
                            'Berhasil',
                            'Laporan berhasil diedit',
                            'success'
                        )
                    },
                    error:function (request, error) {
                        Swal.fire(
                            'Gagal',
                            'Laporan gagal diedit',
                            'error'
                        )
                    }
                }); 
            }
        });
    });
});
</script> 