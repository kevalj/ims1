

<div id="page-wrapper">
			<div class="main-page">
			<form action="<?php echo base_url(); ?>index.php/invoice/invoiceadd" class="form-horizontal" method="post">
			<table class="table table-bordered table-striped no-margin grd_tble">
			<thead>
							<tr>
								<th colspan="2" align="center">
									<center>Invoice Details</center>	
									
								</th>
							</tr>
							<?php foreach($invoice as $data): ?>

							<tr>
							<th>Invoice No.</th>
							<td><?php echo $data['invoice_no'] ?></td>
							</tr>


							<tr>
							<th>Customer Name</th>
							<td><?php echo $data['customer_name'] ?></td>
							</tr>

							<tr>
							<th>Load No.</th>
							<td><?php echo $data['load_no'] ?></td>
							</tr>

							

							<tr>
							<th>Pickup</th>
							<td><?php echo $data['pickup_date'] ?></td>
							</tr>

							<tr>
							<th>Delivery</th>
							<td><?php echo $data['delivery_date'] ?></td>
							</tr>

							<tr>
							<th>From</th>
							<td><?php echo $data['froms'] ?></td>
							</tr>

							<tr>
							<th>To</th>
							<td><?php echo $data['tos'] ?></td>
							</tr>

							<tr>
							<th>Primary Fee</th>
							<td><?php echo $data['primary_fee'] ?></td>
							</tr>

							<tr>
							<th>FSC Amount</th>
							<td><?php echo $data['fsc_amount'] ?></td>
							</tr>

							<tr>
							<th>Additional</th>
							<td><?php echo $data['additional'] ?></td>
							</tr>

							<tr>
							<th>Detention</th>
							<td><?php echo $data['detention'] ?></td>
							</tr>

							<tr>
							<th>Lumper</th>
							<td><?php echo $data['lumper'] ?></td>
							</tr>

							<tr>
							<th>Stop Off</th>
							<td><?php echo $data['stop_off'] ?></td>
							</tr>

							<tr>
							<th>Tarp Fee</th>
							<td><?php echo $data['tarp_fee'] ?></td>
							</tr>

							<tr>
							<th>Total Fee</th>
							<td><?php echo $data['amount'] ?></td>
							</tr>

							<tr>
							<th>Invoice Advance</th>
							<td><?php echo $data['invoice_addvance'] ?></td>
							</tr>

							<tr>
							<th>Bill From</th>
							<td><input type="text" class="form-control1" id="bill_from" name="bill_from" placeholder="Enter Data"></td>
							</tr>

							<tr>
							<th>Bill To</th>
							<td><input type="text" class="form-control1" id="bill_to" name="bill_to" placeholder="Enter Data">
							<input type="hidden" class="form-control1" id="loading_id" name="loading_id" value="<?php echo $data['loading_id'] ?>" placeholder="Enter Data">
							</td>
							</tr>
							<?php endforeach; ?>

							<tr>
							<th colspan="2">
							<input type="submit" class="btn btn-success" value="Save">
								<button type="button"  class="btn btn-info">Reset</button>
								<a href="<?php echo base_url(); ?>index.php/invoice/view_invoice" class="btn btn-info">Cancel</a>
							</th>
							</tr>
			</table>
			
			</form>
			
			</div> 
			</div>
				
					</div>
					</div>

					<script>

					
					$( function() {

						$( "#bill_from" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/invoice/getInvoiceFromData",
      minLength: 0,
      select: function( event, ui ) {
        $("#bill_from").val(ui.item.id);
      }
    });

	$( "#bill_to" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/invoice/getInvoiceToData",
      minLength: 0,
      select: function( event, ui ) {
        $("#bill_to").val(ui.item.id);
      }
    });
    
	
    
  } );
</script>