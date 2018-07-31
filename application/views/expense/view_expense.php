<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">View Expense</h2>
					<a href="<?php echo base_url(); ?>index.php/expense/expense" class="btn btn-primary">Add Expense</a>
					<button type="button" class="btn btn-primary" onclick="editdata()">Edit Expense</button>
					
					<div class="panel-body widget-shadow">
						
						<table class="table" id="vehicle">
							<thead>
								<tr>
								  <th>#</th>
								  <th>Expense category</th>
								  <th>Expense Date</th>
								  <th>Amount</th>
								  <th>Truck/trailer</th>
								  <th>Description</th>
								  
								  <th>Gallons</th>
								  <th>Fuel Vendor</th>
								  <th>State</th>
								  
								</tr>
							</thead>
							
						</table>
					</div>
					</div>
					</div>
					</div>

					<script>
					$('#vehicle').DataTable({
					"pageLength" : 10,
					"ajax": {
						url : "<?php echo base_url(); ?>index.php/expense/getexpenseData?>",
						type : 'POST'
					},
				});

					function editdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/expense/editExpenseData?id="+id;

					}

					function deletedata(){

					}
				</script>
		