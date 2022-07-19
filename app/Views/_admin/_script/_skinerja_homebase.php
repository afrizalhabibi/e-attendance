<script type="text/javascript"> 
moment.locale('id');
$(document).ready(function() {
    
    let validator = $('form.validator-edit').jbvalidator({
            errorMessage: true,
            successClass: false,
            language: "<?php base_url()?>/assets/dist/libs/jbvalidator/lang/en.json",
    });

    table_kinerja = $('#tb_kinerja').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        dom : 'Blrtip',
        buttons: [
        {
            extend: 'excelHtml5',
            exportOptions: {
                columns : [0,1,2,3,4]
            }
        }
        ],
        order: [[1, 'desc']], //init datatable not ordering
        ajax: {
            url: '/recordkinerjahomebase',
            data: function (d) {
                d.datemin = $('#date-val').val().substr(0,10);
                d.datemax = $('#date-val').val().substr(13,10);
            }
        },
        columns: [
            // {className: 'text-end', targets: [] },
            {data: 'no', orderable:false},
            {data: 'act_tgl',
                render: function(data, type, row, meta) {
                    // return row.abs_hari + ', ' + row.abs_tgl
                    
                    return moment(new Date(row.act_tgl)).format('dddd, Do MMMM YYYY')
            }},
            {data: 'nama'},
            {data: 'act_qty'},
            {data: 'act_ket', orderable:false, visible:false},
            {data: 'act_output',
                render: function(data, type, row, meta) {
                    let dtlotp = '';
                    var otp = row.act_output.split(',');
                    otp.forEach(myFunction);
                    
                    
                    function myFunction(value, index, array) {
                        dtlotp += "<span  class='me-2 status bg-blue-lt'>"+ value + "</span>";
                    }

                    return dtlotp;

            }},
            {data: 'action', orderable: false},
        ]
    });
    tinymce.init({
            selector: 'textarea#frm_act_ket',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                    validator.checkAll();
                });
            },
            height: 300,
            branding :false,
            menubar: false,
            statusbar: false,
            hidden_input: false,
            plugins: [
                'autosave','advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor |bullist numlist|  alignleft aligncenter ' +
            'alignright alignjustify | ' +
            'removeformat | help',
            content_style: 'body { font-family:Inter,-apple-system,Helvetica,Arial,sans-serif; font-size:14px }'
    });
    $('.dt-buttons').hide();
    $("#_exportXLS").click(function(event) {
        $(".buttons-excel").trigger("click");
    })
    $('#newSearch').keyup(function() {
    table_kinerja.search($(this).val()).draw(); 
    });
    $('#btnfilter').click(function(event) {
        table_kinerja.ajax.reload();
    });
    $('#btnreset').click(function(event) {
        picker.clearSelection(); 
        table_kinerja.ajax.reload();
        if($('#newSearch').val() != "") {
            $('#newSearch').val("");
            table_kinerja.search($(this).val()).draw();
        }
    });

    $(document).on('click','#btnactdetail',function(){ 
        var id = $(this).attr('data-id');
        $.ajax({
            url : "/actdetails/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
    
                $('#detailsdate').html(moment(new Date(data.act_tgl)).format('dddd, Do MMMM YYYY'));
                $('#detailsjumlah').html(data.act_qty);
                $('#detailsket').html(data.act_ket);
                let dtlotp = '';
                var otp = data.act_output.split(',');
                otp.forEach(myFunction);
                
                
                function myFunction(value, index, array) {
                    dtlotp += "<span  class='me-2 mb-2 status bg-blue-lt'>"+ value + "</span>";
                }
                
                $('#detailsoutput').html(dtlotp);
                
    
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

    let picker = new Litepicker({
        element: document.getElementById('date-val'),
        singleMode: false,
        // resetButton: true,
        splitView:false,
        lang: "id",
        tooltipText: {
            one: 'Hari',
            other: 'Hari'
        },
        tooltipNumber: (totalDays) => {
            return totalDays;
        },
        buttonText: {
            previousMonth: `<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `
            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
        },
        resetButton: () => {
        let btn = document.createElement('button');
        btn.innerText = 'Reset';
        btn.addEventListener('click', (evt) => {
            evt.preventDefault();
        });
        return btn;
        },
    });
</script> 