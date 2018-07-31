<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">View Loads</h2>
					<a href="<?php echo base_url(); ?>index.php/load/loads" class="btn btn-primary btn-flat btn-pri btn-lg"><i class="fa fa-plus" aria-hidden="true"></i>Add Load</a>
					<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="editdata()"><i class="fa fa-edit" aria-hidden="true"></i>Edit Load</button>
					<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="viewdata()"><i class="fa fa-eye" aria-hidden="true"></i>View Load</button>
					<a href="<?php echo base_url(); ?>index.php/trip/trip" class="btn btn-primary btn-flat btn-pri btn-lg"><i class="fa fa-plus" aria-hidden="true"></i>Add Trip</a>
					
					<div class="panel-body widget-shadow">
						
						<table class="table" id="vehicle">
							<thead>
								<tr>
								  <th>#</th>
								  <th>Sr No</th>
								  <th>Customer Load No</th>
								  <th>Pickup</th>
								  <th>Delivery</th>
								  <th>Customer</th>
								  <th>From</th>
								  <th>To</th>
								  
								  <th>BOL</th>
								  
								  <th>Status</th>
								  <th></th>
								  
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
						url : "<?php echo base_url(); ?>index.php/load/getLoadData",
						type : 'POST'
					},
					});

					function loaddatatable(){
						table.destroy();
						table=$('#vehicle').DataTable({
					"pageLength" : 10,
					"ajax": {
						url : "<?php echo base_url(); ?>index.php/load/getLoadData",
						type : 'POST'
					},
					});

					}

					function editdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/load/editLoadData?id="+id;

					}

					function viewdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/load/viewLoadData?id="+id;

					}


					function deletedata(){

					}

					function changestatus(id){
						//alert(id);
						//alert($( "#"+id ).val());
						var status=$( "#"+id ).val();
						var postData = {
								"id" : id,
								"status" : status,
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/load/changeStatus',
							data: postData,
							success: function(data){
								//alert(data);
								if($.trim(data)==1){
									loaddatatable();
								} else{
									alert('Errror in changing Load status. Please try again after sometime.');
								}
							}
						});
					}
				</script>
		