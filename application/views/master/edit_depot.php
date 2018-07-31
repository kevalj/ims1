<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Edit Depot :</h3>
						<div class="form-three widget-shadow">
							<form action="<?php echo base_url(); ?>index.php/master/depotedit" method="post" class="form-horizontal">

							<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							<?php foreach($depot as $data): ?>
							
                                                            
                                                            <div class="form-group">
									<label class="col-sm-2 control-label">Select Region</label>
									<div class="col-sm-8">
										<select class="form-control1" name="project" id="project" onchange="getdivision(this.value)">
											<?php foreach($project as $data2): ?>
											<?php $selected="";?>
											  <?php
											  if($data['region_id']==$data2['project_id']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data2['project_id'] ?>" <?php echo $selected; ?>><?php echo $data2['project_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
									</div>
								</div>

                                                            
                                                            <div class="form-group">
									<label class="col-sm-2 control-label">Select Division</label>
									<div class="col-sm-8">
										<select class="form-control1" name="division" id="division">
											<?php foreach($division as $data3): ?>
											<?php $selected="";?>
											  <?php
											  if($data['division_id']==$data3['project_pos_details_id']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data3['project_pos_details_id'] ?>" <?php echo $selected; ?>><?php echo $data3['pos_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Depot Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="depot_name" name="depot_name" placeholder="Enter Depot Name" value="<?php echo $data['depot_name'] ?>">
								    </div>
                                 </div>								 
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Select Status</label>
									<div class="col-sm-8">
										<select class="form-control1" name="status" id="status">
											<?php foreach($status as $data1): ?>
											<?php $selected="";?>
											  <?php
											  if($data['status']==$data1['status_code']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['status_code'] ?>" <?php echo $selected; ?>><?php echo $data1['status_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
										<input type="hidden" class="form-control1" name="depotId" id="depotId" value="<?php echo $data['depotId'] ?>" placeholder="Default Input">
									</div>
								</div>


								<div class="form-group">
								<input type="submit" class="btn btn-success" value="Save">
								<a href="<?php echo base_url(); ?>index.php/master/view_depot" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

																
 <?php endforeach; ?>
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>
					function getdivision(){
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
					</script>
