<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Edit Region :</h3>
						<div class="form-three widget-shadow">
							<form action="<?php echo base_url(); ?>index.php/master/projectedit" method="post" class="form-horizontal">

							<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							<?php foreach($result as $data): ?>
							<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Region Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="project_name" name="project_name" placeholder="Enter Project Name" value="<?php echo $data['project_name'] ?>">
								    </div>
                                 </div>
								 
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Select Status</label>
									<div class="col-sm-8">
										<select class="form-control1" name="status" id="status">
											<?php foreach($status as $data1): ?>
											<?php $selected="";?>
											  <?php
											  if($data['customer_status']==$data1['status_code']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['status_code'] ?>" <?php echo $selected; ?>><?php echo $data1['status_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
										<input type="hidden" class="form-control1" name="project_id" id="project_id" value="<?php echo $data['project_id'] ?>" placeholder="Default Input">
									</div>
								</div>


								<div class="form-group">
								<input type="submit" class="btn btn-success" value="Save">
								<a href="<?php echo base_url(); ?>index.php/master/view_project" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

																
 <?php endforeach; ?>
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>
