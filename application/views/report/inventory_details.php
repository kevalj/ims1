
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">Inventory Details</h2>
					<div class="form-group">
									<div class="col-sm-2">
										<select class="form-control1" name="region" id="region" onchange="getdivision(this.value)">
										<option value="0">Select Region</option>
											<?php foreach($region as $data1): ?>
											
											<option value="<?php echo $data1['project_id'] ?>"><?php echo $data1['project_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
									</div>

									<div class="col-sm-2">
										<select class="form-control1" name="division" id="division" onchange="getdepot(this.value)">
											
											<option value="0">Select Division</option>
											
											
										</select>
									</div>

									<div class="col-sm-2">
										<select class="form-control1" name="depot" id="depot">
											
											<option value="0">Select Depot</option>
											
											
										</select>
									</div>

									<div class="col-sm-2">

									<button type="button" class="btn btn-info" onclick="showdata()">Show Data</button>
									</div>
								</div>
					
					<div class="panel-body widget-shadow">
						
						

						<table class="table" id="pos">
							<thead>
								<tr>
								  <th>Inventory Serial No</th>
								  <th>Inventory Type</th>
								  <th>Region Name</th>
								  <th>Division Name</th>
								  <th>Depot Name</th>
								 
								</tr>
							</thead>
							
						</table>
					</div>
					</div>
					</div>
					</div>

					<script>

					function getdivision(){
							var projectid=$("#region option:selected").val();
							var postData = {
								"projectid" : projectid
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/InventoryTransfer/getPOSdata',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var string="";
								string=string+'<option  value="0">Select Division</option>';
								for(var i=0;i<obj.data.length;i++){
									
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][1]+'</option>';
									
									
								}
								$('#division')
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								getDepotdata();
								
								
							}
						});

					}

					function getdepot(){
							var divisionid=$("#division option:selected").val();
							var postData = {
								"divisionid" : divisionid
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/InventoryTransfer/getDepotData',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var string="";
								string=string+'<option  value="0">Select Depot</option>';
								for(var i=0;i<obj.data.length;i++){
									
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][1]+'</option>';
									
									
								}
								$('#depot')
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								
							}
						});

					}


					var table;

					function showdata(id){

						var region=$("#region option:selected").val();
						var division=$("#division option:selected").val();
						var depot=$("#depot option:selected").val();
							var postData = {
								"region" : region,
								"division" : division,
								"depot" : depot
								
							};
							if(table!=null){
						table.destroy();
							}
						table=$('#pos').DataTable({

							"pageLength" : 10,
						    dom: 'Bfrtip',
							buttons: [
								'copy', 'csv', 'excel', 'pdf', 'print'
							],
							"ajax": {
								url : "<?php echo base_url(); ?>index.php/report/getInventoryData?region="+region+"&division="+division+"&depot="+depot,
								type : 'POST'
							},
						});
					}

					function deletedata(){

					}
				</script>
		