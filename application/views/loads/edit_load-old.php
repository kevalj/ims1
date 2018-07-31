<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Edit Loading Details :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/load/loadedit">
							<?php foreach($result as $data): ?>
							

								<div class="panel panel-info">
							
							<div class="panel-heading">
							<h3 class="panel-title"> Basic Details</h3> 
							</div>
									<div class="panel-body"> 
							
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Customer Load Number</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="load_no" name="load_no" placeholder="Enter Customer Load Number" value="<?php echo $data['load_no'] ?>">
								   </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Customer Name</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="<?php echo $data['customer_name'] ?>">
										<input type="hidden" class="form-control1" id="customer_id" name="customer_id" placeholder="Enter Customer Name" value="<?php echo $data['customer_id'] ?>">
								    </div>
									<div class="col-sm-3">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" href="javascript:window.open('<?php echo base_url(); ?>/index.php/master/customer','mypopuptitle','width=600,height=400')"><i class="fa fa-plus" aria-hidden="true"></i>Customer</a>
								    </div>
								</div>

								</div>

								</div>



								<?php endforeach; ?>
								
								<div class="panel-heading">
								<h3 class="panel-title"> Stops</h3> 
								</div>
								<div class="panel-body">
								<div class="form-group">

									<div class="col-sm-6 element" >
									
									<div class="panel panel-success"> 
									<div class="panel-heading"> 
									<h3 class="panel-title">Pickup</h3> 
									</div> 
									<div class="panel-body"> 
									<div class="col-sm-12 element" id='div_1'>
										
										<div class="form-group">
										
										</div>

									<?php foreach($result1 as $data): ?>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Shipper</label>
										<div class="col-sm-6">

										<input type="text" class="form-control1 shipper_name" id="shipper_name1" name="shipper_name[]" placeholder="Enter Shipper Name" value="<?php echo $data['customer_name'] ?>">
										<input type="hidden" class="form-control1 shipper_name" id="shipper_id1" name="shipper_id[]" placeholder="Enter Shipper Name" value="<?php echo $data['shipper_id'] ?>">
										</div>
										
										<div class="col-sm-2">
										<a class="btn btn-primary btn-flat btn-pri btn-lg" href="javascript:window.open('<?php echo base_url(); ?>/index.php/master/customer?id=shipper_id1&id1=shipper_name1','mypopuptitle','width=600,height=400')"><i class="fa fa-plus" aria-hidden="true"></i>Shipper</a>
										
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Pickup Date</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 pickup_date" id="pickup_date1" name="pickup_date[]" placeholder="Enter Pickup Date" readonly value="<?php echo $data['pickup_date'] ?>">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 instructions" id="instructions1" name="instructions[]" placeholder="Enter Instructions" value="<?php echo $data['instructions'] ?>">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">BOL</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 bol" id="bol1" name="bol[]" placeholder="Enter BOL" value="<?php echo $data['bol'] ?>">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Customer Required Info</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 cust_req_info" id="cust_req_info1" name="cust_req_info[]" placeholder="Enter Customer Required Info" value="<?php echo $data['customer_req_info'] ?>">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Weight</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 weight" id="weight1" name="weight[]" placeholder="Enter Weight" value="<?php echo $data['weight'] ?>">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Quantity</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 quantity" id="quantity1" name="quantity[]" placeholder="Enter Quantity" value="<?php echo $data['quantity'] ?>">
										</div>
										<div class="col-sm-4">
										<select class="form-control1" id="quantity_type1" name="quantity_type[]" id="planned_load_planned_load_waypoints_shippers_attributes__quantity_type">
										<?php foreach($quantity_type as $data1): ?>
											<?php $selected="";?>
											  <?php
											  if($data['quantity_type']==$data1['quantity_type_id']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['quantity_type_id'] ?>" <?php echo $selected; ?>><?php echo $data1['quantity_type'] ?></option>
											
											<?php endforeach; ?>
										</select>
</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Notes</label>
										<div class="col-sm-6">
										
																				<input type="text" class="form-control1 notes" id="notes1" name="notes[]" placeholder="Enter Notes" value="<?php echo $data['notes'] ?>">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Commodity</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 commodity" id="commodity1" name="commodity[]" placeholder="Enter Commodity" value="<?php echo $data['commodity'] ?>">
										</div>
										</div>

								    </div>
									
									<?php endforeach; ?>
									<div class="form-group">
										
										<div class="col-sm-10">
										<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="addpickup()"><i class="fa fa-plus" aria-hidden="true"></i>Pickup</button>
										<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="removepickup()"><i class="fa fa-minus" aria-hidden="true"></i>Pickup</button>
										</div>
										</div>
									</div>
									</div> 
									

									<div class="col-sm-6 element1">
									<div class="panel panel-success"> 
									<div class="panel-heading"> 
									<h3 class="panel-title">Delivery</h3> 
									</div> 
									<div class="panel-body"> 

									
									<?php foreach($result2 as $data): ?>
									<div class="col-sm-12 element1" id='del_1'>

										
										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Consignee</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 consignee_name" id="consignee_name1" name="consignee_name[]" placeholder="Enter Consignee" value="<?php echo $data['customer_name'] ?>">
										<input type="hidden" class="form-control1 consignee_name" id="consignee_id1" name="consignee_id[]" placeholder="Enter Shipper Name" value="<?php echo $data['cosignee_id'] ?>">
										</div>
										<div class="col-sm-2">
										<a class="btn btn-primary btn-flat btn-pri btn-lg" href="javascript:window.open('<?php echo base_url(); ?>/index.php/master/customer?id=consignee_name1&id1=consignee_id1','mypopuptitle','width=600,height=400')"><i class="fa fa-plus" aria-hidden="true"></i>Consignee</a>
										
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Delivery Date</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 delivery_date" id="delivery_date1" name="delivery_date[]" placeholder="Enter Delivery Date" readonly value="<?php echo $data['delivery_date'] ?>">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 instructions" id="instructions1" name="instructions[]" placeholder="Enter Instructions" value="<?php echo $data['instruction'] ?>">
										</div>
										</div>
										</div>

										<?php endforeach; ?>

										<div class="form-group">
										
										<div class="col-sm-10">
										<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="adddelivery()"><i class="fa fa-plus" aria-hidden="true"></i>Delivery</button>
										<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="removedelivery()"><i class="fa fa-minus" aria-hidden="true"></i>Delivery</button>
										</div>
										</div>


								   
									
								</div>
								</div>
								</div> 
									</div>

								</div>
								</div>
								</div>


								<?php foreach($result as $data): ?>

								<div class="panel panel-info">
								
								<div class="panel-heading">
								<h3 class="panel-title"> Fees / Charges</h3> 
								</div>
								<div class="panel-body"> 
								
								<div class="form-group">

										<div class="col-sm-12">
										<div class="form-group">
										
										</div>
										</div>
									
									<div class="col-sm-6">
									<div class="panel panel-success"> 
									<div class="panel-heading"> 
									<h3 class="panel-title">Primary Fee</h3> 
									</div> 
									<div class="panel-body"> 
										


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Primary Fee</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="primary_fee" name="primary_fee" placeholder="Enter Primary Fee" value="<?php echo $data['primary_fee'] ?>">
								</div>
										
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Primary Fee Type</label>
										<div class="col-sm-4">
												<select name="primary_fee_type" id="primary_fee_type" class="form-control">
										<?php foreach($fee_type as $data1): ?>
											<?php $selected="";?>
											  <?php
											  if($data['primary_fee_type']==$data1['fee_type_id']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['fee_type_id'] ?>" <?php echo $selected; ?>><?php echo $data1['fee_type_name'] ?></option>
											
											<?php endforeach; ?>
										</select>
										
										</div>
										</div>
										</div>
										</div>

									<div class="panel panel-success"> 
									<div class="panel-heading"> 
									<h3 class="panel-title">Fuel Surcharge Fee</h3> 
									</div> 
									<div class="panel-body"> 
										


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">FSC Amount</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="fsc_amt" name="fsc_amt" placeholder="Enter FSC Amount" value="<?php echo $data['fsc_amount'] ?>">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">FSC Amount Type</label>
										<div class="col-sm-4">
										<select name="fsc_amt_type" id="fsc_amt_type" class="form-control">
										<?php foreach($fsc_amount_type as $data1): ?>
											<?php $selected="";?>
											  <?php
											  if($data['fsc_amount_type']==$data1['fsc_amount_type_id']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['fsc_amount_type_id'] ?>" <?php echo $selected; ?>><?php echo $data1['fsc_amount_type'] ?></option>
											
											<?php endforeach; ?>
										</div>
										</div>
										</div>
										</div>


										


										
									
								
								    </div>
									</div>
									</div>

									<div class="col-sm-6">

									<div class="panel panel-success"> 
									<div class="panel-heading"> 
									<h3 class="panel-title">Accessory Fees</h3> 
									</div> 
									<div class="panel-body"> 
										


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Additional</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="additional" name="additional" placeholder="Enter Additional " value="<?php echo $data['additional'] ?>">
										</div>
										
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Detention</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="detention" name="detention" placeholder="Enter Detention" value="<?php echo $data['detention'] ?>">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Lumper</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="lumper" name="lumper" placeholder="Enter Lumper" value="<?php echo $data['lumper'] ?>">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Stop Off</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="stop_off" name="stop_off" placeholder="Enter Stop Off" value="<?php echo $data['stop_off'] ?>">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Tarp Fee</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="tarp_fee" name="tarp_fee" placeholder="Enter Tarp Fee" value="<?php echo $data['tarp_fee'] ?>">
										</div>
										</div>
										</div>
										</div>



									<div class="panel panel-success"> 
									<div class="panel-heading"> 
									<h3 class="panel-title">Invoice Advance</h3> 
									</div> 
									<div class="panel-body"> 

										

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Invoice Advance</label>
										<div class="col-sm-8">
										<input type="text" class="form-control1" id="invoice_adv" name="invoice_adv" placeholder="Enter Invoice Advance" value="<?php echo $data['invoice_addvance'] ?>">
										</div>
										</div>
										</div>
										</div>


								    </div>
									
								</div>
								</div>
								</div>
								
								<div class="panel panel-info">
								
								<div class="panel-heading">
								<h3 class="panel-title"> Legal Disclaimer</h3> 
								</div>

								<div class="panel-body">
								<div class="form-group">
									
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="legal_dic" name="legal_dic" placeholder="Enter Legal Disclaimer" value="<?php echo $data['legal_desc'] ?>">
								    </div>
									
								</div>
								
								

								
								

								<div class="form-three widget-shadow">

								<div class="form-group">
									<label class="col-sm-2 control-label">Select Status</label>
									<div class="col-sm-8">
										<select class="form-control1" name="status" id="status">
											<?php foreach($status as $data1): ?>
											<?php $selected="";?>
											  <?php
											  if($data['status']==$data1['status_code']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['status_code'] ?>" <?php echo $selected; ?>><?php echo $data1['status_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
										<input type="hidden" class="form-control1" name="customerid" id="customerid" value="<?php echo $data['customer_id'] ?>" placeholder="Default Input">
									</div>
								</div>
								</div>

								
								<div class="form-group">
								<input type="submit" class="btn btn-success" value="Save">
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								<?php endforeach; ?>
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>



					<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  .ui-autocomplete-loading {
    background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    

	$( "#vehicle_no" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_vehicle_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#vehicle_id").val(ui.item.id);
      }
    });

	$( "#customer_name" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#customer_id").val(ui.item.id);
      }
    });

	$( "#driver_name" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_driver_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#driver_id").val(ui.item.id);
      }
    });

	$( "#co_driver_name" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_codriver_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#codriver_id").val(ui.item.id);
      }
    });
 
    
  } );
  </script>

   <script>
					$( function() {
    
	$('#pickup_date').datepicker({
      dateFormat: 'yy-mm-dd'
});

$('#delivery_date').datepicker({
      dateFormat: 'yy-mm-dd'
});
    
  } );

  function getRate(){
	var driver_count = $("#driver_count").val();
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url(); ?>/index.php/load/get_driverrate_data",
		  data: {driver_count : driver_count},
		  cache: false,
		  success: function(data){
			 $("#driver_rate").val(data);
		  }
		});
  }
</script>