<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Inventory Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<!-- main content start-->
		
		<div id="page-wrapper">
			<div class="main-page">
			<div class="col_12">
        	<div class="col-md-12 ">
        		<div class="alert alert-info" role="alert">
						Welcome To Inventory Management System...<strong>Getting Started!</strong>
				</div>
				
				

		    <div class="panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
			<?php 
			$dataPoints = array();
			foreach($pie_chart_data as $data2): ?>
			<?php 
			$a=array("label"=> $data2['type'], "y"=> $data2['cnt']);
			//$a=array(("label" => "a", "y" => "b");
			array_push($dataPoints,$a);

			?>
											
			<?php endforeach; ?>
<?php
 

	
?>
			<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Total Inventory"
	},
	subtitles: [{
		text: "Active/Faulty/Unused"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
			click: function(e){
			getRegionData(e.dataPoint.label);
 //   alert(  e.dataSeries.type+ ", dataPoint { y:" + e.dataPoint.y + ", label: "+ e.dataPoint.label + " }" );
   }
	}]
});
chart.render();
 
}

function getRegionData(id){
	//alert(id);
	var postData = {
								"divisionid" : 1
								
							};

						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/Home/getBarChartRegionData',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var dataPoints = [];
								var dataPoints1 = [];
								for(var i=0;i<obj.data.length;i++){
									
										dataPoints.push({
												label: obj.data[i][0],
												y: parseInt(obj.data[i][1])
											});
												dataPoints1.push({
												label: obj.data[i][0],
												y: parseInt(obj.data[i][2])
											});

								}
								
										var chart = new CanvasJS.Chart("chartContainer1", {
										animationEnabled: true,
										title:{
											text: "Region  Wise Inventory Details"
										},
										
									axisY: {
										title: "Inventory Count",
										titleFontColor: "#4F81BC",
										lineColor: "#4F81BC",
										labelFontColor: "#4F81BC",
										tickColor: "#4F81BC"
									},
									legend: {
											cursor:"pointer",
											itemclick : toggleDataSeries
										},
										toolTip: {
											shared: true,
											content: toolTipFormatter
										},
										data: [{
											type: "column",
											name: "Active Inventory",
											legendText: "Active Inventory",
											showInLegend: true, 
												click: function(e){ 
												getDivisionData(e.dataPoint.label);
											  },
											dataPoints:dataPoints
										},
										{
											type: "column",	
											name: "Faulty Inventory",
											legendText: "Faulty Inventory",
											axisYType: "secondary",
											showInLegend: true,
												click: function(e){ 
												getDivisionData(e.dataPoint.label);
												  },
											dataPoints:dataPoints1
										}]
												});
									chart.render();
									
									
								
								
								
							}
						});

	
}

function toolTipFormatter(e) {
	var str = "";
	var total = 0 ;
	var str3;
	var str2 ;
	for (var i = 0; i < e.entries.length; i++){
		var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		total = parseInt(e.entries[i].dataPoint.y) + parseInt(total);
		str = str.concat(str1);
	}
	str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
	str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
	return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = true;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}


function getDivisionData(id){
	//alert(id);
	var postData = {
								"divisionid" : id
								
							};

						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/Home/getBarChartDivisionData',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var dataPoints = [];
								var dataPoints1 = [];
								for(var i=0;i<obj.data.length;i++){
									
										dataPoints.push({
												label: obj.data[i][0],
												y: parseInt(obj.data[i][1])
											});
												dataPoints1.push({
												label: obj.data[i][0],
												y: parseInt(obj.data[i][2])
											});

								}
								
										var chart1 = new CanvasJS.Chart("chartContainer2", {
										animationEnabled: true,
										title:{
											text: "Division  Wise Inventory Details"
										},
										
									axisY: {
										title: "Inventory Count",
										titleFontColor: "#4F81BC",
										lineColor: "#4F81BC",
										labelFontColor: "#4F81BC",
										tickColor: "#4F81BC"
									},
									legend: {
											cursor:"pointer",
											itemclick : toggleDataSeries
										},
										toolTip: {
											shared: true,
											content: toolTipFormatter
										},
										data: [{
											type: "column",
											name: "Active Inventory",
											legendText: "Active Inventory",
											showInLegend: true, 
												click: function(e){ 
												getDepotData(e.dataPoint.label);
											  },
											dataPoints:dataPoints
										},
										{
											type: "column",	
											name: "Faulty Inventory",
											legendText: "Faulty Inventory",
											axisYType: "secondary",
											showInLegend: true,
												click: function(e){ 
												getDepotData(e.dataPoint.label);
												  },
											dataPoints:dataPoints1
										}]
												});
									chart1.render();
									
									
								
								
								
							}
						});

	
}


function getDepotData(id){
	//alert(id);
	var postData = {
								"depotid" : id
								
							};

						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/Home/getBarChartDepotData',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var dataPoints = [];
								var dataPoints1 = [];
								for(var i=0;i<obj.data.length;i++){
									
										dataPoints.push({
												label: obj.data[i][0],
												y: parseInt(obj.data[i][1])
											});
												dataPoints1.push({
												label: obj.data[i][0],
												y: parseInt(obj.data[i][2])
											});

								}
								
										var chart1 = new CanvasJS.Chart("chartContainer3", {
										animationEnabled: true,
										title:{
											text: "Depot  Wise Inventory Details"
										},
										
									axisY: {
										title: "Inventory Count",
										titleFontColor: "#4F81BC",
										lineColor: "#4F81BC",
										labelFontColor: "#4F81BC",
										tickColor: "#4F81BC"
									},
									legend: {
											cursor:"pointer",
											itemclick : toggleDataSeries
										},
										toolTip: {
											shared: true,
											content: toolTipFormatter
										},
										data: [{
											type: "column",
											name: "Active Inventory",
											legendText: "Active Inventory",
											showInLegend: true, 
												click: function(e){ 
												//getDepotData(e.dataPoint.label);
											  },
											dataPoints:dataPoints
										},
										{
											type: "column",	
											name: "Faulty Inventory",
											legendText: "Faulty Inventory",
											axisYType: "secondary",
											showInLegend: true,
												click: function(e){ 
												//getDepotData(e.dataPoint.label);
												  },
											dataPoints:dataPoints1
										}]
												});
									chart1.render();
									
									
								
								
								
							}
						});

	
}



</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
<div id="chartContainer3" style="height: 300px; width: 100%;"></div>

				
        	</div>

			
			</div>

			
			<div class="col-md-2 stat">
				
				
			</div>
			<div class="clearfix"> </div>
		</div>
				
				
	

    
	
			
		</div>
				
			</div>
		</div>

	<script>
				
               
            	
	</script>
</body>
</html>