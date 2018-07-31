<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Edit User Role Access :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/InventoryTransfer/pos_to_service_center_add">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select User</label>
									<div class="col-sm-8">
									<?php $roleid=0; ?>
										<select class="form-control1" name="user" id="user" onchange="getUserRoleDetail()">
											<?php foreach($user as $data1): 
											$roleid=$data1['role_id'];
											?>
											
											<option value="<?php echo $data1['id'] ?>"><?php echo $data1['user_name'].'('.$data1['user_id'].')' ?></option>
											
											<?php endforeach; ?>
											
										</select>

										<?php foreach($user as $data1): 
											?>
											<input type="hidden" name="user" id="user" value="<?php echo $data1['id'] ?>">
											<input type="hidden" name="roleid" id="roleid" value="<?php echo $data1['role_id'] ?>">
											
											<?php endforeach; ?>
								    </div>
                                 </div>
								
								
								
								
								 <?php if($roleid==3) {?>
								<div class="form-group" id="posdiv">
									<label for="focusedinput" class="col-sm-2 control-label">Select Depot</label>
									<div class="col-sm-8">
										<select class="form-control1" name="depot" id="depot" multiple>
											<?php foreach($depot as $data1): ?>
											
											<option value="<?php echo $data1['depotId'] ?>" <?php if($data1['user_depot_relation_id']>0){ echo 'selected';}?> ><?php echo $data1['depot_name'] ?></option>
											
											<?php endforeach; ?>
										</select>
								    </div>
                                </div>
								<?php }?>

								 <?php if($roleid==4) {?>

								 <div class="form-group" id="servicediv">
									<label for="focusedinput" class="col-sm-2 control-label">Select Service Center</label>
									<div class="col-sm-8">
										<select class="form-control1" name="service_center" id="service_center" multiple>
										<?php foreach($service_center as $data1): ?>
											
											<option value="<?php echo $data1['project_service_center_id'] ?>" <?php if($data1['user_service_center_relation_id']>0){ echo 'selected';}?> ><?php echo $data1['service_center_name'] ?></option>
											
											<?php endforeach; ?>

											
										</select>
								    </div>
                                 </div>
								 <?php }?>

                              
								<div class="form-group">
								<input type="button" class="btn btn-success" value="save" onclick="savedata()"></button>
								<a href="<?php echo base_url(); ?>index.php/user/view_user_role" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>

					function savedata(){
						var user=$("#user").val();
						userrole=$("#roleid").val();
							var depot=[];
							var service_center=[];
									

									if(userrole==3){
										$("#depot option:selected").each(function() {
										depot.push($(this).val());
										});
									}

									if(userrole==4){
										$("#service_center option:selected").each(function() {
										service_center.push($(this).val());
										});
									}

								var postData = {
								"depot" : depot,
								"service_center" : service_center,
								"userrole" : userrole,
								"user" :user
								};

								$.ajax({
								type: "POST",
								url: '<?php echo base_url(); ?>index.php/user/saveuserRightsData',
								data: postData,
								success: function(data){
									alert(data);
									

									
								}
							});


					}

					//getUserRoleDetail();
					var userrole=0;
					userrole=$("#roleid").val();
					

							$(document).ready(function() {
								$('#project').change(function(){
									var project=[];
									$("#project option:selected").each(function() {
										project.push($(this).val());
									});
									var postData = {
								    "id" : project,
									"userrole" : userrole
								
							};
							$.ajax({
								type: "POST",
								url: '<?php echo base_url(); ?>index.php/user/getProjectPOSServiceCenterData',
								data: postData,
								success: function(data){
									var data =JSON.parse(data);
									//console.log(data.data[0][0]);
									var string="";

									for(var i=0;i<data.data.length;i++){
									
										string=string+'<option  value="'+data.data[i][0]+'">'+data.data[i][1]+'</option>';
									
									
								}
								if(userrole==3){
								$("#posdiv").show();
								$('#pos')
										.empty()
										.append(string);
								$("#pos").chosen();
								$('#pos').trigger("chosen:updated");
								}

								if(userrole==4){
								$("#servicediv").show();
								$('#service_center')
										.empty()
										.append(string);
								$("#service_center").chosen();
								$('#service_center').trigger("chosen:updated");
								}
									
								}
							});	
								});
								
							});


							
					
						

					

					</script>