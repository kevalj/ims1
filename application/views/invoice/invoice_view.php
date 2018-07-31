

<div id="page-wrapper">
			<div class="main-page">
			<form action="<?php echo base_url(); ?>index.php/invoice/invoiceadd" class="form-horizontal" method="post">
            <?php foreach($invoice as $data): ?>


			<div class="col_9">
			<table>
			<tr>
			<td style="width:60%">

        	<div class="col-md-6 widget widget1" style="width:100%">
        		<div class="r3_counter_box">
                    <div class="stats">
                      <h5><?php echo $this->session->userdata['logged_in']['company_name']; ?></h5>
                      <span><?php echo $this->session->userdata['logged_in']['company_address'] ?></span>
                    </div>
                </div>
        	</div>

			
			</td>
			<td style="width:75%">
        	
        	
        	
			<div class="col-md-6 widget widget1" style="width:100%">
        		<div class="r3_counter_box">
                    <div class="stats">
                      <h5><center><strong>Invoice</strong></center></h5>
                      <table class="table table-bordered table-striped no-margin grd_tble">
						<thead>

							<tr>
								<th colspan="4" align="center">
									Date	
								</th>
								<th colspan="4" align="center">
									Invoice #	
								</th>
							</tr>

							<tr>
								<th colspan="4" align="center">
									<?php echo $data['invoice_created_date'] ?>
								</th>
								<th colspan="4" align="center">
									<?php echo $data['invoice_no'] ?>
								</th>
							</tr>
							</thead>
							</table>
                    </div>
                </div>
				</td>
				</tr>
				</table>
        	 </div>
			 
        	<div class="clearfix"> </div>
		</div>

		<div class="col_6">
        	<div class="col-md-6 widget widget1">
        		<div class="r3_counter_box">
                   <div class="stats">
                      <h5><strong>Bill To</strong></h5>
                      <span><?php echo $data['customer_name'] ?></span>
                    </div>
                </div>
        	</div>
        	
        	<div class="clearfix"> </div>
		</div>



			<table class="table table-bordered table-striped no-margin grd_tble">
			<thead>

							
							<tr><td colspan="4"></td></tr>	
							
							<tr>
							<th></th>
							<th>P.O. No</th>
							<th>Terms No</th>
							<th>Project</th>
							</tr>

							<tr>
							<td></td>
							<td><?php echo $data['load_no'] ?></td>
							<td></td>
							<td></td>
							</tr>
							<tr><td colspan="4"></td></tr>	
							

							<tr>
							<th>Quantity</th>
							<th>Description</th>
							<th>Rate</th>
							<th>Amount</th>
							</tr>

							
							<tr>
							<th>1</th>
							<th>Primary Fee</th>
							<td><?php echo $data['primary_fee'] ?></td>
							<td><?php echo $data['primary_fee'] ?></td>
							</tr>

							<?php if($data['fsc_amount']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>FSC Amount</th>
							<td><?php echo $data['fsc_amount'] ?></td>
							<td><?php echo $data['fsc_amount'] ?></td>
							</tr>
							<?php }?>

							<?php if($data['additional']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>Additional</th>
							<td><?php echo $data['additional'] ?></td>
							<td><?php echo $data['additional'] ?></td>
							</tr>
							<?php }?>
							
							<?php if($data['detention']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>Detention</th>
							<td><?php echo $data['detention'] ?></td>
							<td><?php echo $data['detention'] ?></td>
							</tr>
							<?php }?>
							
							<?php if($data['lumper']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>Lumper</th>
							<td><?php echo $data['lumper'] ?></td>
							<td><?php echo $data['lumper'] ?></td>
							</tr>
							<?php }?>
							
							<?php if($data['stop_off']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>Stop Off</th>
							<td><?php echo $data['stop_off'] ?></td>
							<td><?php echo $data['stop_off'] ?></td>
							</tr>
							<?php }?>
							
							<?php if($data['tarp_fee']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>Tarp Fee</th>
							<td><?php echo $data['tarp_fee'] ?></td>
							<td><?php echo $data['tarp_fee'] ?></td>
							</tr>
							<?php }?>

							
							<?php if($data['invoice_addvance']!='0.00'){?>
							<tr>
							<th>1</th>
							<th>Invoice Advance</th>
							<td><?php echo $data['invoice_addvance'] ?></td>
							<td><?php echo $data['invoice_addvance'] ?></td>
							</tr>
							<?php }?>

							<tr rowspan="2">
							<th colspan="2">Bill To -<?php echo $data['invoice_from']." - ".$data['invoice_to'] ?></th>
							<th >Total Fee</th>
							<td><?php echo ($data['amount']-$data['invoice_addvance']) ?></td>
							</tr>


							
							<?php endforeach; ?>

							<tr id="hidebutton">
							<th colspan="2">
							<input type="button" id="btn" class="btn btn-success" value="Print">
							<a href="<?php echo base_url(); ?>index.php/invoice/view_invoice" class="btn btn-info">Cancel</a>
							</th>
							</tr>
			</table>
			
			</form>
			
			</div> 
			</div>
				
					</div>
					</div>
					<div>


					<script>
					$("#btn").click(function () {
    //Hide all other elements other than printarea.
    $("#page-wrapper").show();
	$("#hidebutton").hide();
	$(".sticky-header").hide();
    window.print();
	$(".sticky-header").show();
	$("#hidebutton").show();
});

					$( function() {
    
	
    
  } );
</script>