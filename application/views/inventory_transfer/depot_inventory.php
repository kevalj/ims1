<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Add Depot Inventory :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/InventoryTransfer/pos_inventory_add">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Region Name</label>
									<div class="col-sm-8">
										<select class="form-control1" name="project" id="project" onchange="getDivisiondata()">
											<?php foreach($project as $data1): ?>
											
											<option value="<?php echo $data1['project_id'] ?>"><?php echo $data1['project_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
								    </div>
                                 </div>
								 
								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Division Name</label>
									<div class="col-sm-8">
										<select class="form-control1" name="pos" id="pos" onchange="getDepotdata()">
											
											
										</select>
								    </div>

                                 </div>
								 
								 
								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Depot Name</label>
									<div class="col-sm-8">
										<select class="form-control1" name="depot" id="depot" >
											
											
										</select>
								    </div>

                                 </div>

								 
								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Inventory</label>
									<div class="col-sm-8">
										<select class="form-control1" name="inventory[]" id="inventory" multiple>
											
										</select>
								    </div>
                                 </div> 

                              
								<div class="form-group">
								<input type="submit" class="btn btn-success" value="save"></button>
								<a href="<?php echo base_url(); ?>index.php/master/view_project" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>
					function getDivisiondata(){
							var projectid=$("#project option:selected").val();
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
								for(var i=0;i<obj.data.length;i++){
									
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][1]+'</option>';
									
									
								}
								$('#pos')
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								getDepotdata();
								
								
							}
						});

					}

					function getDepotdata(){
							var divisionid=$("#pos option:selected").val();
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

					function getProjectInventory(){
							var projectid=$("#project option:selected").val();
							var postData = {
								"projectid" : projectid
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/InventoryTransfer/getProjectInventory',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var string="";
								for(var i=0;i<obj.data.length;i++){
									
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][2]+'</option>';
									
									
								}
								$('#inventory')
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								
							}
						});

					}

	
						
						

					getDivisiondata();
					getDepotdata();
					getProjectInventory();

					</script>
