<script type="text/javascript">
 $(document).ready(function(){
    setInterval(timestamp, 1000);

    let validator = $('form.validator').jbvalidator({
            errorMessage: true,
            successClass: false,
            language: "<?php base_url()?>/assets/dist/libs/jbvalidator/lang/en.json",
    });
    
    // displayabsen();
    firstabsen();
    chartStatus();
    // validateKinerja();
    // timedate liveticking
    function timestamp() {
        moment.locale('id');
        var today = moment().format('HH:mm:ss');

        timesub = today.substr(11);
        tglsub = today.substr(0,10);
        $('#timestamp').html(today);
        $('#txt_abs_datang').val(today);
        $('#txt_abs_pulang').val(today);
    }
    $(document).on('click','#btn-datang',function(){
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,
            flip_horiz: true
        });
        $('#camImgPresensi').show();
        Webcam.attach('#camImgPresensi');

        $('video').addClass('rounded');
        $('#btn-datang-confirm').hide();
        $('#btn-datang-cancel').hide();

    });

    $(document).on('click','#take_snapshot',function(){
        Webcam.snap(function(data_uri) {
            $("#image-tag").val(data_uri);
            $('#AjaxImgPresensi').append('<img class="rounded" src="'+data_uri+'"/>');
            $('#camImgPresensi').hide();
            $('#btn-datang-confirm').show();
            $('#btn-datang-cancel').show();
        });
    });

    $(document).on('click','#reset_snapshot',function(){
            $("#image-tag").val('');
            $('#AjaxImgPresensi').html('');
            $('#camImgPresensi').show();
            $('#btn-datang-confirm').hide();
            $('#btn-datang-cancel').hide();
    });
    
    $('#confirm-absen-datang').on('hidden.bs.modal', function () {
            $("#image-tag").val('');
            $('#AjaxImgPresensi').html('');
            $('#camImgPresensi').show();
    });

    // Ajax Insert Absen
    $(document).on('click','#btn-datang-confirm',function(){

        var abs_id = $('#txt_abs_id').val();
        var pgw_id = $('#txt_pgw_id').val();
        var abs_datang =  $('#txt_abs_datang').val();
        var abs_long =  '114.7666395';
        var abs_lat = '-3.7533148';
        var abs_status = 0;
        var abs_img = $('#image-tag').val();
        $.ajax({
            url:'<?= site_url('update-absendatang') ?>',
            method:'post',
            data:
                {
                    absen_abs_id:abs_id,
                    absen_pgw_id:pgw_id,
                    absen_abs_datang:abs_datang,
                    absen_abs_status:abs_status,
                    absen_abs_long:abs_long,
                    absen_abs_lat:abs_lat,
                    absen_abs_img:abs_img
                },
            success:function(response){
                Webcam.reset();
                $('#confirm-absen-datang').modal('hide');
                $('#tableAbsen').html('');
                $('#btn-datang').hide();
                // displayabsen();
                firstabsen();
                chartStatus();
                Swal.fire(
                    'Berhasil',
                    'Presensi datang berhasil',
                    'success'
                )
            },
            error:function (request, error) {
                Swal.fire(
                    'Gagal',
                    'Presensi datang gagal',
                    'error'
                )
            }
        }); 
    });
    $(document).on('click','#btn-absen-pulang',function(){
        var abs_id = $('#txt_abs_id').val();
        var abs_pulang =  $('#txt_abs_pulang').val();
        var abs_status = 1; 
        $.ajax({
            url:'<?= site_url('update-absenpulang') ?>',
            method:'post',
            data:
                {
                    absen_abs_id:abs_id,
                    absen_abs_pulang:abs_pulang,
                    absen_abs_status:abs_status
                },
            success:function(response){
                
                $('#confirm-absen-pulang').modal('hide');
                $('#tableAbsen').html('');
                $('#btn-pulang').hide();
                // displayabsen();
                firstabsen();
                chartStatus();
                Swal.fire(
                    'Berhasil',
                    'Presensi pulang berhasil',
                    'success'
                )
            },
            error:function (request, error) {
                Swal.fire(
                    'Gagal',
                    'Presensi pulang gagal',
                    'error'
                )
            }
        });
    });
    //end insert absen

    // start display latest presence
    function firstabsen()
    {
	$.ajax({
		url:'<?= site_url('fetch-firstabsen') ?>',
		method:'get',
		success:function(response){
			$.each(response.dataabsen,function(key, value){
                jamdatang = value['abs_datang'];
                jampulang = value['abs_pulang'];
                status = value['abs_status'];
                
                let badgeclass = "";
                if(value['abs_status'] == 'Bekerja' || value['abs_status'] == 'WFH' || value['abs_status'] == 'Dinas Luar') {
                    // badgeclass = ' status-green';
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg> '+value['abs_status']);
                } else if (value['abs_status'] == 'Hari Libur' || value['abs_status'] == 'Tanpa Keterangan') {
                    // badgeclass = ' status-red';
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="18" y1="6" x2="6" y2="18"></line> <line x1="6" y1="6" x2="18" y2="18"></line></svg> '+value['abs_status']);
                } else {
                    // badgeclass = ' status-yellow';
                    $('#absenstatus').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-off text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M19.823 19.824a2 2 0 0 1 -1.823 1.176h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.175 -1.823m3.825 -.177h9a2 2 0 0 1 2 2v9"></path> <line x1="16" y1="3" x2="16" y2="7"></line> <line x1="8" y1="3" x2="8" y2="4"></line> <path d="M4 11h7m4 0h5"></path> <line x1="11" y1="15" x2="12" y2="15"></line> <line x1="12" y1="15" x2="12" y2="18"></line> <line x1="3" y1="3" x2="21" y2="21"></line> </svg> '+value['abs_status']);
                }

                let badgeterlambat = "";
                let terlambat = value['abs_terlambat'];
                if (terlambat.includes("Terlambat")) {
                    badgeterlambat = 'status-yellow';
                } else if(terlambat.includes("Tepat")) {
                    badgeterlambat = 'status-green';
                } else {
                    badgeterlambat = 'status-red';
                }

                if(value['act_id'] != '0' && value['act_id'] != null) {
                    $('#kegiatan').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 12l5 5l10 -10"></path> </svg> Melaporkan');
                } else {
                    $('#kegiatan').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="18" y1="6" x2="6" y2="18"></line> <line x1="6" y1="6" x2="18" y2="18"></line></svg> Belum Melaporkan');
                }

                $('#terlambat').html(terlambat);

				$('#jamdatang').html(jamdatang);
                $('#jampulang').html(jampulang);
                // $('#absenstatus').html(status).addClass(badgeclass);

                if (value['abs_jamkerja'].indexOf("-") > -1) {
                    jamkerja = '00:00:00';
                } else if (value['abs_datang'] == '00:00:00') {
                    jamkerja = '00:00:00';
                } else {
                    jamkerja = value['abs_jamkerja'];
                }
                jam = jamkerja.substr(0,2);
                menit = jamkerja.substr(3,2);
                //chartperbulan.render();
                $('#tglabsen').html(value['abs_hari']+', '+value['abs_tgl']);
                $('#jamkerja').html(jam+ ' Jam' + ' ' + menit + ' Menit');
                $('#ket').html(value['abs_ket']);
                
                if(value['abs_img'] != null) {
                    $('#img-absen').append('<img class="rounded" src="'+value["abs_img"]+'">');
                } else if (value['abs_img'] == null) {
                    $('#img-absen').append('<img class="rounded" src="/assets/static/illustrations/img_placeholder.svg">');
                }
                

                //mini map location tracker
                // mapboxgl.accessToken = 'pk.eyJ1IjoiaGFiaWJpLXBvbGl0YWxhIiwiYSI6ImNsM3h1NDI3bDAwYWMza2thZThib3NmeWcifQ.cET6J1xPv-NdkdPDPmfjsw';
                // var absenmap = new mapboxgl.Map({
                //     container: 'map-absen',
                //     style: 'mapbox://styles/mapbox/outdoors-v11',
                //     zoom: 16,
                //     center: [114.7666395, -3.7533148],
                // });
              
                // //get long and lat
                // var geolocate = new mapboxgl.GeolocateControl({
                // positionOptions: {
                //     enableHighAccuracy: true
                // },
                // trackUserLocation: true
                // });
                // absenmap.addControl(geolocate);
                // absenmap.on("load", function () {
                //     geolocate.trigger(); // add this if you want to fire it by code instead of the button
                // });
                // geolocate.on("geolocate", locateUser);

                // function locateUser(e) {
                //     var long = "";
                //     var lat ="";
                    
                //     long = e.coords.longitude;
                //     lat = e.coords.latitude;
                //     // console.log("lng:" + long + ", lat:" + lat);
                    
                //     // const marker1 = new mapboxgl.Marker({ color: 'black'})
                //     // .setLngLat([long, lat])
                //     // .addTo(absenmap);
                // }
                
			});
        } 
        });
    }
    // end display latest presence

    function chartStatus()
    {
    
	$.ajax({
		url:'<?= site_url('chartstatus') ?>',
		method:'get',
		success:function(response){
            var nama_status = [];
            let jumlah = [];
            
			$.each(response.chartstatus,function(key, value){
              nama_status.push(value['abs_status']);
              jumlah.push(parseInt(value['total']));
			});
            var chartperbulan = new ApexCharts(document.getElementById('chart-status'), {
                chart: {
                    type: "donut",
                    fontFamily: 'inherit',
                    height: 260,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: true
                    },
                },
                fill: {
                    opacity: 1,
                },

                plotOptions: {
                    pie: {
                    donut: {
                        labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true
                        }
                        }
                    }
                    }
                },
                series: jumlah,
                labels: nama_status,
        
                grid: {
                    strokeDashArray: 4,
                },
                colors: ["#2489FF", "#FFC149", "#d2e1f3", "#e9ecf1"], 
                legend: {
                    show: true,
                    position: 'bottom',
                    offsetY: 12,
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 8,
                        vertical: 8
                    },
                },
                tooltip: {
                    fillSeriesColor: false
                },
            }).render();
        } 
        });
    }


    //* Activity Section
    // moment.locale('id');
    // moment().format(); 
    var startDate = moment().add(1, 'days').format("MM/DD/YYYY");
    var today = moment().add(1825, 'days').format("MM/DD/YYYY");
    var lockDays = [startDate,today];
    

    // $(document).on('change','#frm_act_tgl',function(){
    //     var act_tgl = $('#frm_act_tgl').val();
    //     $.ajax({
    //         url:'/checkavailabledate',
    //         method:'post',
    //         data:
    //             {
    //                 available_act_tgl:act_tgl
    //             },
    //         success:function(response){
    //             if(response.status == 'Available') {
    //                 console.log(response.status);
    //             } else {
    //                 console.log(response.status);
    //             }
                
    //         },
    //         error:function (request, error) {
    //             // console.log('date not available');
    //         }
    //     }); 
    // });
   
    let actpicker = new Litepicker({
        element: document.getElementById('frm_act_tgl'),
        singleMode: true,
        // resetButton: true,
        splitView:false,
        lang: "id",
        lockDays :[lockDays],
        lockDaysFilter: (day) => {
        const d = day.getDay();

        return [6, 0].includes(d);
        },

        setup: (picker) => {
            picker.on('selected', (date1,date2) => {
                validator.checkAll();
                var act_tgl = $('#frm_act_tgl').val();
                
                $.ajax({
                    url:'/checkavailabledate',
                    method:'post',
                    data:
                        {
                            available_act_tgl:act_tgl
                        },
                    success:function(response){
                        if(response.status == 'Available') {
                            $('#frm_act_tgl').addClass('is-valid');
                            
                        } else {
                            validator.errorTrigger($('[name=frm_act_tgl]'), response.status);
                            actpicker.clearSelection();
                        }
                    },
                    error:function (request, error) {
                        Swal.fire(
                            'Gagal',
                            'Gagal verifikasi tanggal',
                            'error'
                        )
                    }
                }); 
                // console.log('selected');
            });
        },

        buttonText: {
            previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
            nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
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
    //* Activity Send
    $(function (){

        tinymce.init({
            selector: 'textarea#frm_act_ket',
            // skin: "oxide-dark",
            // content_css: "dark",
            setup: function (editor) {
                editor.on('keyup', function () {
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


        $(document).on('change','#frm_act_output',function(){
            validator.checkAll();
        });


        
        // validator.checkAll();
        //serverside
        $(document).on('click','#btn-act-send',function(e){
            
            if (validator.checkAll()) {
                e.preventDefault();
            } else {
                $('#btn-act-send').html('<div class="spinner-border spinner-border-sm text-white me-2" role="status"></div> Mengirim');
                var act_tgl = $('#frm_act_tgl').val();
                var act_qty = $('#frm_act_qty').val();
                var act_ket = $('#frm_act_ket').val();
                var act_output = $('#frm_act_output').val();

                $.ajax({
                    url:'<?= site_url('activity/addactivity') ?>',
                    method:'post',
                    data:
                        {
                            ativity_act_tgl:act_tgl,
                            ativity_act_qty:act_qty,
                            ativity_act_ket:act_ket,
                            ativity_act_output:act_output

                        },
                    success:function(response){
                        // if(response.status === 'Terkirim') {
                        //         validatorServerSide.errorTrigger($('[name=frm_act_tgl]'), response.message);
                        // }
                        $('#btn-act-send').html('Kirim');
                        $('#modal-act-report').modal('hide');
                        $('#frm_act_tgl').removeClass('is-valid');
                        $('#frm_act_output').tagsinput('removeAll');
                        actpicker.clearSelection(); 
                        tinymce.get('frm_act_ket').setContent('');
                        $('#modal-act-report').find("input,textarea,select").val('');
                        
                        firstabsen();

                        Swal.fire(
                            'Berhasil',
                            'Laporan berhasil terkirim',
                            'success'
                        )
                    },
                    error:function (request, error) {
                        Swal.fire(
                            'Gagal',
                            'Laporan gagal terkirim',
                            'error'
                        )
                    }
                }); 
            }
        });
    });
});



</script>