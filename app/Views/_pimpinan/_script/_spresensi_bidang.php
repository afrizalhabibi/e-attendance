<script type="text/javascript"> 
$(document).ready(function() {
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
            url: '/presensibidangajax',
            data: function (d) {
                d.status = $('#filterStatus').val();
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
                    badgeclass = ' status-green';
                    $('#absenstatus').removeClass(" status-red");
                    $('#absenstatus').removeClass(" status-yellow");
                    $('#absenstatus').html(data.abs_status).addClass(badgeclass);
                } else if (data.abs_status == 'Hari Libur' || data.abs_status == 'Tanpa Keterangan') {
                    badgeclass = ' status-red';
                    $('#absenstatus').removeClass(" status-green");
                    $('#absenstatus').removeClass(" status-yellow");
                    $('#absenstatus').html(data.abs_status).addClass(badgeclass);
                } else {
                    badgeclass = ' status-yellow';
                    $('#absenstatus').removeClass(" status-green");
                    $('#absenstatus').removeClass(" status-red");
                    $('#absenstatus').html(data.abs_status).addClass(badgeclass);
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
                $('.modal-title').text('Detail Kehadiran');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    });
    // edit
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
        table_absen.ajax.reload();
        if($('#newSearch').val() != "") {
            $('#newSearch').val("");
            table_absen.search($(this).val()).draw();
        }
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
</script>

