<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Add Division :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/posadd">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Select Region</label>
									<div class="col-sm-8">
										<select class="form-control1" name="project" id="project">
											<?php foreach($project as $data1): ?>
											
											<option value="<?php echo $data1['project_id'] ?>"><?php echo $data1['project_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Division Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="pos_name" name="pos_name" placeholder="Enter Division Name">
								    </div>
                                 </div>        

                              
								<div class="form-group">
								<input type="submit" class="btn btn-success" value="save"></button>
								<a href="<?php echo base_url(); ?>index.php/master/view_pos" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>
