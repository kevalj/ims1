<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">View Service Center Inventory</h2>
					<a href="<?php echo base_url(); ?>index.php/InventoryTransfer/service_center_inventory" class="btn btn-primary">Add Service Center Inventory</a>
					<button type="button" class="btn btn-primary" onclick="returninventory()">Return To Inventory</button>
					
					
					<div class="panel-body widget-shadow">
						
						<table class="table" id="vehicle">
							<thead>
								<tr>
								  <th>#</th>
								  <th>Service Center Name</th>
								  <th>Inventory Type</th>
								  <th>Total Count</th>
								  <th>Used Count</th>
								  <th>Remaining Count</th>
								  
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
						url : "<?php echo base_url(); ?>index.php/InventoryTransfer/getServiceCenterInventoryData",
						type : 'POST'
					},
				});

					

					function servicecenter(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						if(id==undefined){
							alert("Please select to transfer");
							return false;
						}
						location.href = "<?php echo base_url(); ?>index.php/InventoryTransfer/projectToServiCecenter?id="+id;

					}

					

					function returninventory(){
						
						location.href = "<?php echo base_url(); ?>index.php/InventoryTransfer/serviCecenterToInventory";
					}
				</script>
		