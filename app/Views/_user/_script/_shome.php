<script type="text/javascript">
 $(document).ready(function(){
    setInterval(timestamp, 1000);
    
    // displayabsen();
    firstabsen();
    chartStatus();
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
    // Ajax Insert Absen
    $(document).on('click','#btn-absen-datang',function(){
        var abs_id = $('#txt_abs_id').val();
        var pgw_id = $('#txt_pgw_id').val();
        var abs_datang =  $('#txt_abs_datang').val();
        var abs_long =  '114.7666395';
        var abs_lat = '-3.7533148';
        var abs_status = 0;
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
                    absen_abs_lat:abs_lat
                },
            success:function(response){
                $('#confirm-absen-datang').modal('hide');
                $('#tableAbsen').html('');
                $('#btn-datang').hide();
                // displayabsen();
                firstabsen();
                chartStatus();
                Swal.fire(
                    'Berhasil',
                    'Absen datang berhasil',
                    'success'
                )
            },
            error:function (request, error) {
                Swal.fire(
                    'Gagal',
                    'Absen datang gagal',
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
                    'Absen pulang berhasil',
                    'success'
                )
            },
            error:function (request, error) {
                Swal.fire(
                    'Gagal',
                    'Absen pulang gagal',
                    'error'
                )
            }
        });
    });
    //end insert absen

    // start display absen
    // function displayabsen()
    // {
    // var i = 0;
    
	// $.ajax({
	// 	url:'<?= site_url('fetch-absen') ?>',
	// 	method:'get',
	// 	success:function(response){
	// 		$.each(response.allabsen,function(key, value){
    //             i++;
    //             starttime = value['abs_datang'];
    //             stoptime = value['abs_pulang'];
                
    //             if(value['abs_status'] == 'Bekerja' || value['abs_status'] == 'WFH') {
    //                 badgeclass = ' bg-green';
    //             } else if (value['abs_status'] == 'Hari Libur' || value['abs_status'] == 'Tanpa Keterangan') {
    //                 badgeclass = ' bg-red';
    //             } else {
    //                 badgeclass = ' bg-yellow';
    //             }
                
    //             if (value['abs_jamkerja'].indexOf("-") > -1) {
    //                 jamkerja = '00:00:00';
    //             } else {
    //                 jamkerja = value['abs_jamkerja'];
    //             }
	// 			$('#tableAbsen').append('<tr>\
	// 				<td> '+i+' </td>\
	// 				<td> '+value['abs_hari']+", "+value['abs_tgl']+' </td>\
	// 				<td> '+value['abs_datang']+' </td>\
	// 				<td> '+value['abs_pulang']+' </td>\
	// 				<td> '+jamkerja+' </td>\
	// 				<td><span class="badge'+badgeclass+' me-1"></span>'+"  "+value['abs_status']+'</td>\
	// 			</tr>');
	// 		});
	// 	}
		
	// });
    // }
    // end display absen

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
                    badgeclass = ' status-green';
                } else if (value['abs_status'] == 'Hari Libur' || value['abs_status'] == 'Tanpa Keterangan') {
                    badgeclass = ' status-red';
                } else {
                    badgeclass = ' status-yellow';
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

                $('#terlambat').html(terlambat).addClass(badgeterlambat);

				$('#jamdatang').html(jamdatang);
                $('#jampulang').html(jampulang);
                $('#absenstatus').html(status).addClass(badgeclass);

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

                //mini map location tracker
                mapboxgl.accessToken = 'pk.eyJ1IjoiaGFiaWJpLXBvbGl0YWxhIiwiYSI6ImNsM3h1NDI3bDAwYWMza2thZThib3NmeWcifQ.cET6J1xPv-NdkdPDPmfjsw';
                var absenmap = new mapboxgl.Map({
                    container: 'map-absen',
                    style: 'mapbox://styles/mapbox/outdoors-v11',
                    zoom: 16,
                    center: [114.7666395, -3.7533148],
                });
              
                //get long and lat
                var geolocate = new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
                });
                absenmap.addControl(geolocate);
                absenmap.on("load", function () {
                    geolocate.trigger(); // add this if you want to fire it by code instead of the button
                });
                geolocate.on("geolocate", locateUser);

                function locateUser(e) {
                    var long = "";
                    var lat ="";
                    
                    long = e.coords.longitude;
                    lat = e.coords.latitude;
                    console.log("lng:" + long + ", lat:" + lat);
                    
                    // const marker1 = new mapboxgl.Marker({ color: 'black'})
                    // .setLngLat([long, lat])
                    // .addTo(absenmap);
                }
                
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
                colors: ["#206bc4", "#79a6dc", "#d2e1f3", "#e9ecf1"], 
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
    var today = moment().add(365, 'days').format("MM/DD/YYYY");
    var lockDays = [startDate,today];
    console.log(lockDays);
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
    // Ajax Insert Absen
    $(document).on('click','#btn-act-send',function(){
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
                $('#modal-act-report').modal('hide');
                $('#modal-act-report').find("input,textarea,select").val('');
                
                // displayabsen();

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
    });

});



</script>