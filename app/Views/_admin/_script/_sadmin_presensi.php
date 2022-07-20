<script type="text/javascript"> 
$(document).ready(function() {
    // let validator = $('form.validator-edit').jbvalidator({
    //         errorMessage: true,
    //         successClass: false,
    //         language: "/assets/dist/libs/jbvalidator/lang/en.json",
    // });

    table_absen = $('#tb_kehadiran').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        dom : 'Blrtip',
        buttons: [
        {
            extend: 'excelHtml5',
            exportOptions: {
                columns : [0,1,2,3,4,5,6,7]
            }
        }
    ],
        order: [[1, 'desc']], //init datatable not ordering
        ajax: {
            url: '/presensipegawaiallajax',
            data: function (d) {
                d.status = $('#filterStatus').val();
                d.homebase = $('#filterHomebase').val();
                d.datemin = $('#date-val').val().substr(0,10);
                d.datemax = $('#date-val').val().substr(13,10);
            }
        },
        columns: [
            {data: 'no', orderable:false},
            {data: 'abs_tgl',
                render: function(data, type, row, meta) {
                    return row.abs_hari + ', ' + row.abs_tgl
            }},
            {data: 'nama',
                render: function(data, type, row, meta) {
                    return '<div class="d-flex align-items-center"><span class="avatar avatar-sm me-2 avatar-rounded" style="background-image: url(/assets/static/avatars/avatar-14.png)"></span> ' + row.nama + '</div>'
                }
            },
            {data: 'hmb_name'},
            {data: 'jabatan'},
            {data: 'status_peg'},
            {data: 'abs_datang', orderable:false},
            {data: 'abs_pulang', orderable:false},
            {data: 'abs_jamkerja', orderable:false,
                render: function(data, type, row, meta) {
                    if(row.abs_jamkerja.indexOf("-") > -1) {
                        return '00:00:00'
                    } else if(row.abs_datang == '00:00:00') {
                        return '00:00:00'
                    } else {
                        return row.abs_jamkerja
                    }
            }},
            {data: 'abs_status',
                render: function(data, type, row) {
                    if(row.abs_status == 'Bekerja' || row.abs_status == 'WFH' || row.abs_status == 'Dinas Luar') {
                        badgeclass = ' bg-green';
                    } else if (row.abs_status == 'Hari Libur' || row.abs_status == 'Tanpa Keterangan') {
                        badgeclass = ' bg-red';
                    } else {
                        badgeclass = ' bg-yellow';
                    }
                    return '<span class="me-2 badge'+badgeclass+'"></span>'+row.abs_status
            }},
            {data: 'act_id',
                render: function(data, type, row) {
                    if(row.act_id != '' && row.act_id != null) {
                    return '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 12l5 5l10 -10"></path> </svg> Melaporkan';
                    } else {
                       return '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="18" y1="6" x2="6" y2="18"></line> <line x1="6" y1="6" x2="18" y2="18"></line></svg> Belum Melaporkan';
                    }
            }},
            {data: 'abs_ket', orderable:false, visible:false},
            {data: 'action', orderable: false, class: 'text-end'},
        ]
    });

    $(document).on('click','#btnabsdetail',function(){ 
        var id = $(this).attr('data-id');
        $.ajax({
            url : "<?php echo site_url('abs-details')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);
                $('#img-presensi').find('img').remove();
                $('#absdetailsdate').html(data.abs_hari + ", " +data.abs_tgl);
                $('#absdetailsname').html(data.nama);
                $('#idpeg').html(data.pgw_id);
                $('#jamdatang').html(data.abs_datang);
                $('#jampulang').html(data.abs_pulang);

                if (data.abs_jamkerja.indexOf("-") > -1) {
                    jamkerja = '00:00:00';
                } else if(data.abs_datang == '00:00:00') {
                    jamkerja = '00:00:00';
                } else {
                    jamkerja = data.abs_jamkerja;
                }
                
                jam = jamkerja.substr(0,2);
                menit = jamkerja.substr(3,2);
                $('#jamkerja').html(jam+ ' Jam' + ' ' + menit + ' Menit');
                
                if(data.abs_status == 'Bekerja' || data.abs_status == 'WFH' || data.abs_status == 'Dinas Luar') {
                    // badgeclass = ' status-green';
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg> '+data.abs_status);
                } else if (data.abs_status == 'Tanpa Keterangan') {
                    // badgeclass = ' status-red';
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path> <line x1="12" y1="19" x2="12" y2="19.01"></line> </svg> '+data.abs_status);
                } else if (data.abs_status == 'Hari Libur'){
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-off text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M19.823 19.824a2 2 0 0 1 -1.823 1.176h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.175 -1.823m3.825 -.177h9a2 2 0 0 1 2 2v9"></path> <line x1="16" y1="3" x2="16" y2="7"></line> <line x1="8" y1="3" x2="8" y2="4"></line> <path d="M4 11h7m4 0h5"></path> <line x1="11" y1="15" x2="12" y2="15"></line> <line x1="12" y1="15" x2="12" y2="18"></line> <line x1="3" y1="3" x2="21" y2="21"></line> </svg> '+data.abs_status);
                } else {
                    // badgeclass = ' status-yellow';
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-off text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M19.823 19.824a2 2 0 0 1 -1.823 1.176h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.175 -1.823m3.825 -.177h9a2 2 0 0 1 2 2v9"></path> <line x1="16" y1="3" x2="16" y2="7"></line> <line x1="8" y1="3" x2="8" y2="4"></line> <path d="M4 11h7m4 0h5"></path> <line x1="11" y1="15" x2="12" y2="15"></line> <line x1="12" y1="15" x2="12" y2="18"></line> <line x1="3" y1="3" x2="21" y2="21"></line> </svg> '+data.abs_status);
                }

                if(data.act_id != '' && data.act_id != null) {
                    $('#kegiatan').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 12l5 5l10 -10"></path> </svg> Melaporkan');
                } else {
                    $('#kegiatan').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="18" y1="6" x2="6" y2="18"></line> <line x1="6" y1="6" x2="18" y2="18"></line></svg> Belum Melaporkan');
                }
                
                if(data.abs_img != '' && data.abs_img != null) {
                    $('#img-presensi').append('<img class="rounded" src="'+data.abs_img+'">');
                } else {
                    $('#img-presensi').append('<img class="rounded" src="/assets/static/illustrations/img_placeholder.svg">');
                }
                $('#ket').html(data.abs_ket);
    
                $('#modal-absdetails').modal('show');
                $('.modal-title').text('Detail Presensi');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    });
    
    // edit
    $(document).on('click','#btnabsedit',function(){ 
       
        let id = $(this).attr('data-id');
        
        $.ajax({
            url : "/abs-details/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                
                $('#frm_abs_id').val(data.abs_id);
                $('#frm_abs_tgl').val(data.abs_tgl);
                $('#frm_abs_nama').val(data.nama);
                $('#frm_abs_pgwid').val(data.pgw_id);
                $('#frm_abs_jamdatang').val(data.abs_datang);
                $('#frm_abs_jampulang').val(data.abs_pulang);
                $('#frm_abs_status').val(data.abs_status);
                $('#frm_abs_ket').val(data.abs_ket);
                
                
                $('#modal-absedit').modal('show');
                
                $('.modal-title').text('Edit Presensi Pegawai');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    });

    $(document).on('click','#btn-absedit-send',function(e){

        var abs_id = $('#frm_abs_id').val();
        var abs_datang = $('#frm_abs_jamdatang').val();
        var abs_pulang = $('#frm_abs_jampulang').val();
        var abs_status = $('#frm_abs_status').val();
        var abs_ket = $('#frm_abs_ket').val();


        $.ajax({
            url:'/admin/doupdatepresensi',
            method:'post',
            data:
                {
                    presensi_abs_id:abs_id,
                    presensi_abs_datang:abs_datang,
                    presensi_abs_pulang:abs_pulang,
                    presensi_abs_status:abs_status,
                    presensi_abs_ket:abs_ket,


                },
            success:function(response){
                $('#modal-absedit').modal('hide');
                $('#modal-absedit').find("input,textarea,select").val('');
                
                table_absen.ajax.reload();     

                Swal.fire(
                    'Berhasil',
                    'Presensi berhasil diedit',
                    'success'
                )
            },
            error:function (request, error) {
                Swal.fire(
                    'Gagal',
                    'Presensi gagal diedit',
                    'error'
                )
            }
        }); 
    });


    $('.dt-buttons').hide();
    $("#_exportXLS").click(function(event) {
        $(".buttons-excel").trigger("click");
    })
    $('#newSearch').keyup(function() {
    table_absen.search($(this).val()).draw(); 
    })
    $('#btnfilter').click(function(event) {
        table_absen.ajax.reload();
    });
    $('#btnreset').click(function(event) {
        $('#filterStatus').val("");
        picker.clearSelection(); 
        el.clear();
        if($('#newSearch').val() != "") {
            $('#newSearch').val("");
            table_absen.search($(this).val()).draw();
        }
        table_absen.ajax.reload();
    });
});
</script>

<script>
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
            previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
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


    let el = new TomSelect("#filterHomebase", {
    		copyClassesToDropdown: false,
    		dropdownClass: 'dropdown-menu',
    		optionClass:'dropdown-item',
    		controlInput: '<input>',
    		render:{
    			item: function(data,escape) {
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    			option: function(data,escape){
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    		},
    	});
</script>

