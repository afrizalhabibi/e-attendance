<script type="text/javascript">
$(document).ready(function(){
    statusBar();
    jamkerjaLine();

    function statusBar()
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
			console.log(jumlah);
            var statusBar = new ApexCharts(document.getElementById('chart-status'), {
      		chart: {
      			type: "bar",
      			fontFamily: 'inherit',
      			height: 240,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: true,
      			},
      		},
      		plotOptions: {
      			bar: {
      				columnWidth: '30%',
      			}
      		},
      		dataLabels: {
      			enabled: false,
      		},
      		fill: {
      			opacity: 1,
      		},
      		series: [{
      			name: "Total",
      			data: jumlah,
      		}],
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: 0,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			axisBorder: {
      				show: false,
      			},
      			type: 'category',
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		labels: nama_status,
      		colors: ["#206bc4"],
      		legend: {
      			show: false,
      		},
      	}).render();
        } 
        });
    }

    function jamkerjaLine()
    {
    
	$.ajax({
		url:'<?= site_url('chartjamkerja') ?>',
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
            console.log(jamkerja);
            console.log(tanggal);
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
      		colors: ["#206bc4"],
      		legend: {
      			show: false,
      		},
      	}).render();
        } 
        });
    }
});
</script>


