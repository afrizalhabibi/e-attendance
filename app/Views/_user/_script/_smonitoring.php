<script type="text/javascript">
$(document).ready(function(){
	moment.locale('id');
    jamkerjaLineBulan();

	$.ajax({
		url:'/chartstatuspertahun',
		method:'get',
		success:function(response){
            var nama_status = [];
            let jumlah = [];
            
			$.each(response.chartstatus,function(key, value){
              nama_status.push(value['abs_status']);
              jumlah.push(parseInt(value['total']));
			});
			var options = {
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
				colors: ["#2489FF", "#FFC149", "#FF555F", "#d2e1f3", "#e9ecf1"], 
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
				}
			};  
			var chartpertahun = new ApexCharts(document.getElementById('chart-status'), options);
			chartpertahun.render();

			function updateChartOptionsBulan() {
				$.ajax({
					url:'/chartstatusperbulan',
					method:'get',
					success:function(response){
						var nama_status = [];
						let jumlah = [];
						
						$.each(response.chartstatus,function(key, value){
						nama_status.push(value['abs_status']);
						jumlah.push(parseInt(value['total']));
						});
						chartpertahun.updateOptions({
							series: jumlah,
							labels: nama_status,
						});
					} 
				});
			}
			function updateChartOptionsTahun() {
				$.ajax({
					url:'/chartstatuspertahun',
					method:'get',
					success:function(response){
						var nama_status = [];
						let jumlah = [];
						
						$.each(response.chartstatus,function(key, value){
						nama_status.push(value['abs_status']);
						jumlah.push(parseInt(value['total']));
						});
						chartpertahun.updateOptions({
							series: jumlah,
							labels: nama_status,
						});
					} 
				});
			}
			$(document).on('click','#btnfilterBulan',function(){
				updateChartOptionsBulan();
			});
			$(document).on('click','#btnfilterTahun',function(){
				updateChartOptionsTahun();
			});
        } 
	});

	$.ajax({
		url:'/chartkinerjaperbulan',
		method:'get',
		success:function(response){
            var tanggal = [];
            let jumlah = [];
            
			$.each(response.chartkinerja,function(key, value){
              tanggal.push(value['act_tgl']);
              jumlah.push(value['act_qty']);
			});
			// console.log(tanggal);
			// console.log(jumlah);
	
			var options = {
		
				chart: {
				locales: [{
				"name": "id",
				"options": {
					"months": ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
					"shortMonths": ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
					"days": ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"],
					"shortDays": ["Ming", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
					"toolbar": {
						"exportToSVG": "Download SVG",
						"exportToPNG": "Download PNG",
						"menu": "Menu",
						"selection": "Selection",
						"selectionZoom": "Selection Zoom",
						"zoomIn": "Zoom In",
						"zoomOut": "Zoom Out",
						"pan": "Panning",
						"reset": "Reset Zoom"
					}
				}
				}],
				defaultLocale: "id",
				type: "line",
				fontFamily: 'inherit',
				height: 240,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: true
				},
				zoom: {
					enabled: false,  
				},
				},
				fill: {
					opacity: 1,
				},
				stroke: {
					width: 2,
					lineCap: "round",
					curve: "smooth",
				},
				series: [{
					name: "Jumlah Kegiatan",
					data: jumlah,
				}],
				grid: {
					padding: {
						top: -20,
						right: 0,
						left: -4,
						bottom: -4
					},
					strokeDashArray: 4,
				},
				dataLabels: {
				enabled: true,
				},
				xaxis: {
					labels: {
						// formatter: value => {
						// return moment(new Date(value)).format('DD MMMM')
						// },
						
						padding: 0,
					},
					tooltip: {
						enabled: false
					},
					type: 'datetime',
				},
				yaxis: {
					labels: {
						rotate: 0,
							rotateAlways: false,
							formatter: function (val) {
								return val.toFixed(0);
							},
						padding: 3,
						
					},
					decimalsInFloat: 0,
				},
				labels: tanggal,
				colors: ["#2489FF"],
				legend: {
					show: true,
					position: 'bottom',
					offsetY: 12,
					markers: {
						width: 10,
						height: 10,
						radius: 80,
					},
					itemMargin: {
						horizontal: 8,
						vertical: 8
					},
				},
				tooltip: {
					fillSeriesColor: false
				}
			};  
			var chartkinerja = new ApexCharts(document.getElementById('chart-kinerja'), options);
			chartkinerja.render();

			function updateChartOptionsBulan() {
				$.ajax({
					url:'/chartkinerjaperbulan',
					method:'get',
					success:function(response){
						var tanggal = [];
						let jumlah = [];
						
						$.each(response.chartkinerja,function(key, value){
						tanggal.push(value['act_tgl']);
						jumlah.push(value['act_qty']);
						});
						chartkinerja.updateOptions({
							data: jumlah,
							labels: tanggal,
						});
					} 
				});
			}
			function updateChartOptionsTiga() {
				$.ajax({
					url:'/chartkinerjapertigabulan',
					method:'get',
					success:function(response){
						var tanggal = [];
						let jumlah = [];
						
						$.each(response.chartkinerja,function(key, value){
						tanggal.push(value['act_tgl']);
						jumlah.push(value['act_qty']);
						});
						console.log(tanggal);
						console.log(jumlah);
						chartkinerja.updateOptions({
							data: jumlah,
							labels: tanggal,
							width: '400%',
							legend: {
								show: true,
								position: 'bottom',
								offsetY: 12,
								markers: {
									size: 2
								},
								itemMargin: {
									horizontal: 2,
									vertical: 8
								},
							},
						});
					} 
				});
			}
			$(document).on('click','#btnfilterkinerjaBulan',function(){
				updateChartOptionsBulan();
			});
			$(document).on('click','#btnfilterkinerjaTiga',function(){
				updateChartOptionsTiga();
			});
        } 
	});


    function jamkerjaLineBulan()
    {
    
	$.ajax({
		url:'/chartjamkerjaperbulan',
		method:'get',
		success:function(response){
            let tanggal = [];
            let jamkerja = [];
            
			$.each(response.chartjamkerja,function(key, value){
                if (value['abs_jamkerja'].indexOf("-") > -1) {
                    value['abs_jamkerja'] = '00:00:00'
                } 
				if (value['abs_datang'] === '00:00:00') {
                    value['abs_jamkerja'] = '00:00:00';
				}
              tanggal.push(value['abs_tgl']);
              jamkerja.push(value['abs_jamkerja']);
              
			});
            // console.log(jamkerja);
            // console.log(tanggal);
            var jamkerjaLine = new ApexCharts(document.getElementById('chart-jamkerja'), {
      		chart: {
				locales: [{
				"name": "id",
				"options": {
					"months": ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
					"shortMonths": ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
					"days": ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"],
					"shortDays": ["Ming", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
					"toolbar": {
						"exportToSVG": "Download SVG",
						"exportToPNG": "Download PNG",
						"menu": "Menu",
						"selection": "Selection",
						"selectionZoom": "Selection Zoom",
						"zoomIn": "Zoom In",
						"zoomOut": "Zoom Out",
						"pan": "Panning",
						"reset": "Reset Zoom"
					}
				}
				}],
				defaultLocale: "id",
      			type: "line",
      			fontFamily: 'inherit',
      			height: 240,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: true
      			},
                zoom: {
                    enabled: false,  
                },
      		},
      		fill: {
      			opacity: 1,
      		},
      		stroke: {
      			width: 2,
      			lineCap: "round",
      			curve: "smooth",
      		},
      		series: [{
                
      			name: "Jam Kerja",
      			data: jamkerja,
      		}],
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
			dataLabels: {
			enabled: true,
      		},
      		xaxis: {
      			labels: {
					
                    // formatter: value => {
                    // return moment(new Date(value)).format('DD MMMM')
                    // },
      				padding: 2,
      			},
      			tooltip: {
      				enabled: false
      			},
      			type: 'datetime',
      		},
      		yaxis: {

      			labels: {

      				padding: 3
      			},
      		},
      		labels: tanggal,
      		colors: ["#FF555F"],
      		legend: {
      			show: false,
      		},
      	}).render();
        } 
        });
    }

	$.ajax({
		url:'/chartlapkinerja',
		method:'get',
		success:function(response){
            let mengisi = 0;
            let belum = 0;
			$.each(response.chartlaporan,function(key, value){
				if(value['act_id'] != null) {
					mengisi+=1;
				} else if (value['act_id'] === null) {
					belum+=1;
				}
			console.log(mengisi);
			console.log(value['act_id']);
			});
			var options = {
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
				series: [mengisi,belum],
				labels: ["Melaporkan","Belum Melaporkan"],

				grid: {
					strokeDashArray: 4,
				},
				colors: ["#2489FF", "rgba(36, 137, 255, 0.1)"], 
				// colors: ["#2489FF", "#0DCB86", "#FFC149", "#d2e1f3", "#FF555F", "#"], 

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
				}
			};  
			var chartlaporan = new ApexCharts(document.getElementById('chart-laporan'), options);
			chartlaporan.render();


			$(document).on('click','#btnfilterBulan',function(){
				updateChartOptionsBulan();
			});
			$(document).on('click','#btnfilterTahun',function(){
				updateChartOptionsTahun();
			});
        } 
	});
});
</script>


