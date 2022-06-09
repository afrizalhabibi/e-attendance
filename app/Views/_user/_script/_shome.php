<script type="text/javascript">
 $(document).ready(function(){
    setInterval(timestamp, 1000);
    
    // displayabsen();
    firstabsen();
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
                hari = value['abs_hari'];
				$('#jamdatang').html(jamdatang);
                $('#jampulang').html(jampulang);
                $('#absenstatus').html(status).addClass(badgeclass);

                if (value['abs_jamkerja'].indexOf("-") > -1) {
                    jamkerja = '00:00:00';
                } else {
                    jamkerja = value['abs_jamkerja'];
                }
                jam = jamkerja.substr(0,2);
                menit = jamkerja.substr(3,2);
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
});


</script>