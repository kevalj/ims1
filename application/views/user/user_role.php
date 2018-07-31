<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Add User Role Access :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/InventoryTransfer/pos_to_service_center_add">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select User</label>
									<div class="col-sm-8">
										<select class="form-control1" name="user" id="user" onchange="getUserRoleDetail()">
										<option value="0">Select</option>
											<?php foreach($user as $data1): ?>
											
											<option value="<?php echo $data1['id'] ?>"><?php echo $data1['user_name'].'('.$data1['user_id'].')' ?></option>
											
											<?php endforeach; ?>
											
										</select>
								    </div>
                                 </div>

								 <div class="form-group" id="depotdiv">
									<label for="focusedinput" class="col-sm-2 control-label">Select Depot</label>
									<div class="col-sm-8">
										<select class="form-control1" name="depot" id="depot"  multiple>
											
										</select>
								    </div>
                                 </div>
								 

								 <div class="form-group" id="servicediv">
									<label for="focusedinput" class="col-sm-2 control-label">Select Service Center</label>
									<div class="col-sm-8">
										<select class="form-control1" name="service_center" id="service_center" multiple>
											
										</select>
								    </div>
                                 </div>

                              
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
					function getUserRoleDetail(){
						
							var user=$("#user option:selected").val();
							 
							var postData = {
								"id" : user
								
							};
							$.ajax({
								type: "POST",
								url: '<?php echo base_url(); ?>index.php/user/getuserRoleData',
								data: postData,
								success: function(data){
									var data =JSON.parse(data);
									console.log(data.data[0][0]);
									userrole=data.data[0][0];
									var string="";
									if(userrole==3 || userrole==4){

									for(var i=0;i<data.data1.length;i++){
									
										string=string+'<option  value="'+data.data1[i][0]+'">'+data.data1[i][1]+'</option>';
									
									
								   }
									}
								

								if(userrole==1){
									$("#servicediv").hide();
								    $("#depotdiv").hide();
								
								}

								if(userrole==3){
									$("#servicediv").hide();
									$("#depotdiv").show();
									$('#depot')
										.empty()
										.append(string);
								$("#depot").chosen();
								$('#depot').trigger("chosen:updated");
									
								
								}

								if(userrole==4){
								$("#servicediv").show();
									$("#depotdiv").hide();
									$('#service_center')
										.empty()
										.append(string);
								$("#service_center").chosen();
								$('#service_center').trigger("chosen:updated");
								
								}
								
									
								}
							});	
								
							}

							
					</script>