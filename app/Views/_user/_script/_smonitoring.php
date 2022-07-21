<script type="text/javascript">
$(document).ready(function(){
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
              jumlah.push(parseInt(value['act_qty']));
			});
			console.log(tanggal);
			console.log(jumlah);
			var options = {
				chart: {
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
						// return moment(new Date(value)).format('D MMM')
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
						// formatter: value => {
						// return moment(new Date(value)).format('hh:mm:ss')
						// },
						padding: 3
					},
				},
				labels: tanggal,
				colors: ["#FFC149", "#d2e1f3", "#e9ecf1"],
				legend: {
					show: false,
				},
			};  
			var chartpertahun = new ApexCharts(document.getElementById('chart-kinerja'), options);
			chartpertahun.render();
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
              tanggal.push(value['abs_tgl']);
              jamkerja.push(value['abs_jamkerja']);
              
			});
            // console.log(jamkerja);
            // console.log(tanggal);
            var jamkerjaLine = new ApexCharts(document.getElementById('chart-jamkerja'), {
      		chart: {
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
                    // return moment(new Date(value)).format('D MMM')
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
                    // formatter: value => {
                    // return moment(new Date(value)).format('hh:mm:ss')
                    // },
      				padding: 3
      			},
      		},
      		labels: tanggal,
      		colors: ["#FFC149", "#d2e1f3", "#e9ecf1"],
      		legend: {
      			show: false,
      		},
      	}).render();
        } 
        });
    }

	// $(document).on('click','#btnfilterBulan',function(){
	// 	$('apexcharts-canvas').remove();
	// 	$('chart-status').replaceWith('');
	// 	statusperBulan();
	// });
	// $(document).on('click','#btnfilterTahun',function(){
	// 	$('apexcharts-canvas').remove();
	// 	$('chart-status').replaceWith('');
	// 	statusperTahun();
	// });
});
</script>


