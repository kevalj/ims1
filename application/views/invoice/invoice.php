<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">Invoice Details</h2>
					
					
					
					
					<div class="panel-body widget-shadow">
						
						<table class="table" id="vehicle">
							<thead>
								<tr>
								  <th>Load No</th>
								  <th>Trip No</th>
								  <th>Customer</th>
								  <th>Pickup</th>
								  <th>Delivery</th> 
								  <th>From</th>
								  <th>To</th>
								  <th>Invoice Amount</th>
								  <th>Invoice Advance</th>
								  <th></th>
								  <th></th>
								  
								</tr>
							</thead>
							
						</table>
					</div>
					</div>
					</div>
					</div>

					<script>
					var table=$('#vehicle').DataTable({
					"pageLength" : 10,
					"ajax": {
						url : "<?php echo base_url(); ?>index.php/invoice/getInvoiceData",
						type : 'POST'
					},
				});

					function loaddatatable(){
						table.destroy();
						table=$('#vehicle').DataTable({
					"pageLength" : 10,
					"ajax": {
						url : "<?php echo base_url(); ?>index.php/invoice/getInvoiceData",
						type : 'POST'
					},
				});

					}

					function editdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/master/editCustomerData?id="+id;

					}

					function deletedata(){

					}

					function changepaidstatus(id,status){
						var postData = {
								"id" : id,
								"status" : status	
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/invoice/changePaidStatus',
							data: postData,
							success: function(data){
								console.log(data);
								if(parseInt(data)==1){
									alert("Paid status change successfully.");
									loaddatatable();
								}
								
								
								
							}
						});
					}
				</script>
		