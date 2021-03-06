<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">View Service Center Inventory</h2>
					<button type="button" class="btn btn-primary" onclick="editdata()">Repair</button>
					
					<div class="panel-body widget-shadow">
						
						<table class="table" id="vehicle">
							<thead>
								<tr>
								  <th>#</th>
								  <th>Inventory Type</th>
								  <th>Inventory No</th>
								  <th>Inventory Serial No</th>
								  <th>Region</th>
								  <th>Division</th>
								  <th>Depot</th>
								  <th>Faulty Reason</th>
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
						url : "<?php echo base_url(); ?>index.php/ServiceCenter/getServiceCenterInventoryData",
						type : 'POST'
					},
				});

					function editdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/ServiceCenter/repair_service_center_inventory?id="+id;

					}

		</script>
		