<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					
					<div class="panel-body widget-shadow">
					<form action="<?php echo base_url(); ?>index.php/home/chngsetting" class="form-horizontal" method="post">	
						<div class="table-responsive bs-example widget-shadow">
						<h4>My Profile</h4>
						
						<table class="table table-bordered" id="user"> 
						<?php foreach($get_detail_user_data as $data): ?>
						<thead> 
						<tr> 
						<th>Company Name</th> 
						<td><?php echo $data['company_name'] ;?></td>
						</tr> 

						<tr> 
						<th>Company Address</th> 
						<td><?php echo $data['company_address'] ;?></td>
						</tr>
						
						<tr> 
						<th>MC Number</th> 
						<td><?php echo $data['mc'] ;?></td>
						</tr>

						<tr> 
						<th>BOT Number</th> 
						<td><?php echo $data['bot'] ;?></td>
						</tr>

						<tr> 
						<th>User Id</th> 
						<td><?php echo $data['user_id'] ;?></td>
						</tr> 

						<tr> 
						<th>User Name</th> 
						<td><?php echo $data['user_name'] ;?></td>
						</tr> 

						<tr> 
						<th>EmailId</th> 
						<td><?php echo $data['email'] ;?></td>
						</tr> 
						</thead> 

						<tr> 
						<th>Gender</th> 
						<td><?php if($data['gender']=='M') { echo 'Male';} else { echo 'Female';} ;?></td>
						</tr> 
						</thead> 

						<tr> 
						<th>Role</th> 
						<td><?php if($data['is_admin']=='Y') { echo 'Admin';} else { echo 'User';} ;?></td>
						</tr> 
						</thead> 
						
						<?php endforeach; ?>
						</table>
						
						
					</div>
					</form>
					</div>
					</div>
					</div>
					</div>

					