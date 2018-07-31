<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Transfer To Service Center :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/InventoryTransfer/pos_to_service_center_add">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Service Center Name</label>
									<div class="col-sm-8">
										<select class="form-control1" name="service_center" id="service_center" >
											<?php foreach($service_center as $data1): ?>
											
											<option value="<?php echo $data1['project_service_center_id'] ?>"><?php echo $data1['service_center_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
								    </div>
                                 </div>
								 
								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Reason</label>
									<div class="col-sm-8">
										<select class="form-control1" name="reason" id="reason" onchange="unablereason()">
											<?php foreach($reason as $data1): ?>
											
											<option value="<?php echo $data1['reason_id'] ?>"><?php echo $data1['stCategoryReasonName'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
								    </div>
                                 </div>
								 
								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Enter Other Reason</label>
									<div class="col-sm-8">
									<input type="text" class="form-control1" name="other_reason" id="other_reason" value="" placeholder="Enter Other Reason" Readonly>
									<?php foreach ($inventory_data as $data): ?>
									<input type="hidden" class="form-control1" name="inventory_project_relation_id" id="inventory_project_relation_id" value="<?php echo $data['inventory_project_relation_id'] ?>" placeholder="Enter Other Reason" Readonly>

									<input type="hidden" class="form-control1" name="inventory_master_id" id="inventory_master_id" value="<?php echo $data['inventory_master_id'] ?>" placeholder="Enter Other Reason" Readonly>

									<input type="hidden" class="form-control1" name="inventory_pos_relation_id" id="inventory_pos_relation_id" value="<?php echo $data['inventory_pos_relation_id'] ?>" placeholder="Enter Other Reason" Readonly>

									<?php endforeach; ?>
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
					function unablereason(){
							var reason=$("#reason option:selected").val();
							 if(reason == "55"){
									 $("#other_reason").attr("readonly", false); 
								 }
								 else{ 
									 $("#other_reason").attr("readonly", true); 
									 $("#other_reason").val("");
								 }
								
								
							}
						

					

					</script>