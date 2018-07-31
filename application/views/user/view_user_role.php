<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">View User Role Access</h2>
					<a href="<?php echo base_url(); ?>index.php/user/user_role" class="btn btn-primary">Add User Role</a>
					<button type="button" class="btn btn-primary" onclick="editdata()">Edit User Role</button>
					
					<div class="panel-body widget-shadow">
						
						<table class="table" id="vehicle">
							<thead>
								<tr>
								  <th>#</th>
								  <th>User Id</th>
								  <th>User Name</th>
								  <th>User Role</th>
								  <th>Depot Name</th>
								  <th>Service Center Name</th>
								  
							    </tr>
							</thead>
							
						</table>
					</div>
					</div>
					</div>
					</div>

					<script>
					var table =$('#vehicle').DataTable({
					"pageLength" : 10,
					"ajax": {
						url : "<?php echo base_url(); ?>index.php/User/getuserRoleViewData",
						type : 'POST'
					},
				});

					function editdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/User/edit_user_role?id="+id;

					}

		</script>
		