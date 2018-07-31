<div id="page-wrapper" class="load_form">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Add Planned Load :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/load/addLoad">

							<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>

							<div class="panel panel-info">
							
							<div class="panel-heading">
							<h3 class="panel-title"> Basic Details</h3> 
							</div>
							
							<div class="panel-body"> 
							
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Customer Load Number</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="load_no" name="load_no" placeholder="Enter Customer Load Number">
								    </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Customer Name</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="customer_name" name="customer_name" placeholder="Enter Customer Name" autocomplete="off">
										<input type="hidden" class="form-control1" id="customer_id" name="customer_id" placeholder="Enter Customer Name">
								    </div>
									<div class="col-sm-3">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form('customer_name','customer_id')"><i class="fa fa-plus" aria-hidden="true"></i>Customer</a>
								    </div>
								</div>

								</div>

								</div>




								<div class="panel panel-info">
								
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


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Shipper</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 shipper_name" id="shipper_name1" name="shipper_name[]" placeholder="Enter Shipper Name">
										<input type="hidden" class="form-control1 shipper_name" id="shipper_id1" name="shipper_id[]" placeholder="Enter Shipper Name">
										</div>
										<div class="col-sm-2">
										<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form('shipper_name1','shipper_id1')"><i class="fa fa-plus" aria-hidden="true"></i>Shipper</a>
										
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Pickup Date</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 pickup_date" id="pickup_date1" name="pickup_date[]" placeholder="Enter Pickup Date" readonly>
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 instructions" id="instructions1" name="instructions[]" placeholder="Enter Instructions" >
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">BOL</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 bol" id="bol1" name="bol[]" placeholder="Enter BOL" >
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Customer Required Info</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 cust_req_info" id="cust_req_info1" name="cust_req_info[]" placeholder="Enter Customer Required Info" >
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Weight</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 weight" id="weight1" name="weight[]" placeholder="Enter Weight" onblur="formatno(this.value,'weight1')">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Quantity</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 quantity" id="quantity1" name="quantity[]" placeholder="Enter Quantity" onblur="formatno(this.value,'quantity1')">
										</div>
										<div class="col-sm-4">
										<select class="form-control1" id="quantity_type1" name="quantity_type[]" id="planned_load_planned_load_waypoints_shippers_attributes__quantity_type">
										<option value="0">Select Quantity Type</option>
										<option value="Barrels">Barrels</option>
										<option value="Boxes">Boxes</option>
										<option value="Bushels">Bushels</option>
										<option value="Cases">Cases</option>
										<option value="Crates">Crates</option>
										<option value="Gallons">Gallons</option>
										<option value="Hours">Hours</option>
										<option value="Pallets">Pallets</option>
										<option value="Pieces">Pieces</option></select>
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Notes</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 notes" id="notes1" name="notes[]" placeholder="Enter Notes" >
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Commodity</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 commodity" id="commodity1" name="commodity[]" placeholder="Enter Commodity" >
										</div>
										</div>

								    </div>
									<div class="form-group">
										
										<div class="col-sm-10">
										<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="addpickup()"><i class="fa fa-plus" aria-hidden="true"></i>Pickup</button>
										<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="removepickup()"><i class="fa fa-minus" aria-hidden="true"></i>Pickup</button>
										</div>
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

									
									<div class="col-sm-12 element1" id='del_1'>

										
										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Consignee</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 consignee_name" id="consignee_name1" name="consignee_name[]" placeholder="Enter Consignee">
										<input type="hidden" class="form-control1 consignee_name" id="consignee_id1" name="consignee_id[]" placeholder="Enter Shipper Name">
										</div>
										<div class="col-sm-2">
										<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form('consignee_name1','consignee_id1')"><i class="fa fa-plus" aria-hidden="true"></i>Consignee</a>
										
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Delivery Date</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 delivery_date" id="delivery_date1" name="delivery_date[]" placeholder="Enter Delivery Date" readonly>
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>
										<div class="col-sm-6">
										<input type="text" class="form-control1 instructions" id="instructions1" name="instructions[]" placeholder="Enter Instructions" >
										</div>
										</div>
										</div>

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
										<input type="text" class="form-control1" id="primary_fee" name="primary_fee" placeholder="Enter Primary Fee" onblur="formatno(this.value,'primary_fee')">
										</div>
										
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Primary Fee Type</label>
										<div class="col-sm-4">
										<select name="primary_fee_type" id="primary_fee_type" class="form-control">
										<option selected="selected" value="flat_fee">Flat Fee</option>
										<option value="per_mile">Per Mile</option>
										<option value="per_weight">Per Hundred Weight (cwt)</option>
										<option value="per_ton">Per Ton</option>
										<option value="per_quantity">Per Quantity</option></select>
										
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
										<input type="text" class="form-control1" id="fsc_amt" name="fsc_amt" placeholder="Enter FSC Amount" onblur="formatno(this.value,'fsc_amt')">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">FSC Amount Type</label>
										<div class="col-sm-4">
										<select name="fsc_amt_type" id="fsc_amt_type" class="form-control">
										<option selected="selected" value="flat_fee">Flat Fee</option>
										<option value="per_mile">Per Mile</option>
										<option value="percent">Percent</option></select>
										
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
										<input type="text" class="form-control1" id="additional" name="additional" placeholder="Enter Additional " onblur="formatno(this.value,'additional')">
										</div>
										
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Detention</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="detention" name="detention" placeholder="Enter Detention" onblur="formatno(this.value,'detention')">
										</div>
										</div>


										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Lumper</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="lumper" name="lumper" placeholder="Enter Lumper" onblur="formatno(this.value,'lumper')">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Stop Off</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="stop_off" name="stop_off" placeholder="Enter Stop Off" onblur="formatno(this.value,'stop_off')">
										</div>
										</div>

										<div class="form-group">
										<label for="focusedinput" class="col-sm-4 control-label">Tarp Fee</label>
										<div class="col-sm-4">
										<input type="text" class="form-control1" id="tarp_fee" name="tarp_fee" placeholder="Enter Tarp Fee" onblur="formatno(this.value,'tarp_fee')">
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
										<input type="text" class="form-control1" id="invoice_adv" name="invoice_adv" placeholder="Enter Invoice Advance" onblur="formatno(this.value,'invoice_adv')">
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
										<input type="text" class="form-control1" id="legal_dic" name="legal_dic" placeholder="Enter Legal Disclaimer">
								    </div>
									
								</div>
								
								</div>
								</div>
								
								

								
								<div class="form-group">
								
								<input type="submit" class="btn btn-success" value="Save">
								<a href="<?php echo base_url(); ?>/index.php/load/view_load" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
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
 var pickupid=1;
  function addpickup(){

  // Finding total number of elements added
  var total_element = $(".element").length;
 
  // last <div> with element class id
  var lastid = $(".element:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;

  
  
   // Adding new div container after last occurance of element class
   $(".element:last").after("<div class='element col-sm-12' id='div_"+ nextindex +"'></div>");
 
   // Adding element to <div>
   //$("#div_" + nextindex).append("aaaaaaaaaaaaaaa");
   //alert(document.getElementById('div_1'));

pickupid++;
										


										var div='<div class="panel-heading"> <h3 class="panel-title">Pickup - '+pickupid+'</h3> </div><div class="panel-body"> <div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Shipper</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 shipper_name" id="shipper_name'+pickupid+'" name="shipper_name[]" placeholder="Enter Shipper Name" >';
										div=div+'<input type="hidden" class="form-control1 shipper_name" id="shipper_id'+pickupid+'" name="shipper_id[]" placeholder="Enter Shipper Name">';
										div=div+'</div>';
										div=div+'<div class="col-sm-2">';
										div=div+'<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form(\'shipper_name'+pickupid+'\',\'shipper_id'+pickupid+'\')"><i class="fa fa-plus" aria-hidden="true"></i>Shipper</a>';
										
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Pickup Date</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 pickup_date" id="pickup_date'+pickupid+'" name="pickup_date[]" placeholder="Enter Pickup Date" readonly onkeyup="getPickupdate(\'pickup_date'+pickupid+'\')">';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 instructions" id="instructions'+pickupid+'" name="instructions[]" placeholder="Enter Instructions" >';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">BOL</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 bol" id="bol'+pickupid+'" name="bol[]" placeholder="Enter BOL" >';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Customer Required Info</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 cust_req_info" id="cust_req_info'+pickupid+'" name="cust_req_info[]" placeholder="Enter Customer Required Info" >';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Weight</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 weight" id="weight'+pickupid+'" name="weight[]" placeholder="Enter Weight" onblur="formatno(this.value,\'weight'+pickupid+'\')">';
										div=div+'</div>';
										div=div+'</div>';

										
										
										
										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Quantity</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 quantity" id="quantity'+pickupid+'" name="quantity[]" placeholder="Enter Quantity" onblur="formatno(this.value,\'quantity'+pickupid+'\')">';
										div=div+'</div>';
										div=div+'<div class="col-sm-4">';
										div=div+'<select class="form-control1" id="quantity_type1" name="quantity_type[]" id="planned_load_planned_load_waypoints_shippers_attributes__quantity_type">';
										div=div+'<option value="0">Select Quantity Type</option>';
										div=div+'<option value="Barrels">Barrels</option>';
										div=div+'<option value="Boxes">Boxes</option>';
										div=div+'<option value="Bushels">Bushels</option>';
										div=div+'<option value="Cases">Cases</option>';
										div=div+'<option value="Crates">Crates</option>';
										div=div+'<option value="Gallons">Gallons</option>';
										div=div+'<option value="Hours">Hours</option>';
										div=div+'<option value="Pallets">Pallets</option>';
										div=div+'<option value="Pieces">Pieces</option></select>';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Notes</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 notes" id="notes'+pickupid+'" name="notes[]" placeholder="Enter Notes" >';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Commodity</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 commodity" id="commodity'+pickupid+'" name="commodity[]" placeholder="Enter Commodity" >';
										div=div+'</div>';
										div=div+'</div>';

								   div=div+' </div></div>';
									//div=div+'<div class="form-group">';
										
									//	div=div+'<div class="col-sm-10">';
									//	div=div+'<button type="button" class="btn btn-info add" onclick="addpickup()">+Add Another Pickup</button>';
									//	div=div+'<button type="button" class="btn btn-info add" onclick="removepickup()">-Remove Pickup</button>';
									//	div=div+'</div>';

   $("#div_" + pickupid).append(div);

   $( "#shipper_name"+pickupid ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
		  
        $("#shipper_id"+toNumeric(this.id)).val(ui.item.id);
      }
    });

    $('#pickup_date'+pickupid).datepicker({
      dateFormat: 'mm-dd-yy'
	});
   
$("select").chosen();
  }

  function removepickup(){

  // Finding total number of elements added
  var total_element = $(".element").length;
 
  // last <div> with element class id
  var lastid = $(".element:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) ;
//alert(pickupid);
  if(pickupid>1){
  $("#div_"+pickupid).remove();
  pickupid--;
  }

  }


var nextindex1=1;
  function adddelivery(){
	// Finding total number of elements added

  var total_element = $(".element1").length;
 
  // last <div> with element class id
  var lastid = $(".element1:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;

  
  
   // Adding new div container after last occurance of element class
   $(".element1:last").after("<div class='element1 col-sm-12' id='del_"+ nextindex +"'></div>");
 
   // Adding element to <div>
   //$("#div_" + nextindex).append("aaaaaaaaaaaaaaa");
   nextindex1++;
   //alert(document.getElementById('del_1'));
   

										var div='<div class="panel-heading"> <h3 class="panel-title">Delivery - '+nextindex1+'</h3> </div><div class="panel-body"><div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Consignee</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 consignee_name" id="consignee_name'+nextindex1+'" name="consignee_name[]" placeholder="Enter Consignee">';
										div=div+'<input type="hidden" class="form-control1 consignee_name" id="consignee_id'+nextindex1+'" name="consignee_id[]" placeholder="Enter Shipper Name">';
										div=div+'</div>';
										div=div+'<div class="col-sm-4">';
										div=div+'<a class="btn btn-primary btn-flat btn-pri btn-lg"onclick="show_cust_form(\'consignee_name'+nextindex1+'\',\'consignee_id'+nextindex1+'\')"><i class="fa fa-plus" aria-hidden="true"></i>Consignee</a>';
										
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Delivery Date</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 delivery_date" id="delivery_date'+nextindex1+'" name="delivery_date[]" placeholder="Enter Delivery Date" readonly>';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 instructions" id="instructions"'+nextindex1+'" name="instructions[]" placeholder="Enter Instructions" >';
										div=div+'</div>';
										div=div+'</div>';
   $("#del_" + nextindex1).append(div);

$( "#consignee_name"+nextindex1 ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#consignee_id"+toNumeric(this.id)).val(ui.item.id);
      }
    });

    $('#delivery_date'+nextindex1).datepicker({
      dateFormat: 'mm-dd-yy'
	});

$("select").chosen();
  }


  function removedelivery(){
	  // Finding total number of elements added
  var total_element = $(".element1").length;
 
  // last <div> with element class id
  var lastid = $(".element1:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) ;
//alert(pickupid);
  if(nextindex1>1){
  $("#del_"+nextindex1).remove();
  nextindex1--;
  }
  }


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
		  //alert(this.id);
        $("#customer_id").val(ui.item.id);
      }
    });

	$( "#shipper_name1" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#shipper_id1").val(ui.item.id);
      }
    });

	$( "#consignee_name1" ).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#consignee_id1").val(ui.item.id);
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
    
	$('.pickup_date').datepicker({
      dateFormat: 'mm-dd-yy'
});

$('#delivery_date1').datepicker({
      dateFormat: 'mm-dd-yy'
});

getRate();
    
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

  function formatno(no,id){
	 //alert(no);
	  var formatno="";
	  var no =no.replace(/,\s?/g, "");

	  var p = parseFloat(no).toFixed(2).split(".");
    formatno=   p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
	$("#"+id).val(formatno);
	//alert(formatno);
  }
</script>



<!-----------------customer form--------------->

<div id="page-wrapper" class="customer_form">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Customer Registration Form :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/customeradd">

							

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Customer Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="cust_customer_name" name="customer_name" placeholder="Enter Customer Name">
								    </div>
                                 </div>        

                                <div class="form-group">
									<label class="col-sm-2 control-label">Select Customer Type</label>
									<div class="col-sm-8">
										<select class="form-control1" name="customer_type" id="customer_type">
											<?php foreach($result1 as $data1): ?>
										    <option value="<?php echo $data1['customer_type_id'] ?>" ><?php echo $data1['customer_type_name'] ?></option>';
											<?php endforeach; ?>
										</select>
									</div>
								</div>

        					   <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Street</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="street" name="street" placeholder="Enter Street">
								    </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Apt/Suite/Other</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="apt" name="apt" placeholder="Enter Apt/Suite/Other">
								    </div>
									
								</div>

	                            <div class="form-group">
									<label class="col-sm-2 control-label"> City</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="city" name="city" placeholder="Enter City">
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>
									<div class="col-sm-8">
										<select class="form-control1 state" id="state" name="state" placeholder="Enter State" >';
										<?php foreach($result as $data1): ?>
										    <option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										</select>
								    </div>
									
								</div>
        
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Zip Code</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="zip_code" name="zip_code" placeholder="Enter Zip Code">
								    </div>

								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Mobile No.</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="mobileno" name="mobileno" placeholder="Enter Mobile No.">
								    </div>

								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Alternate Mobile No.</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="alt_mobileno" name="alt_mobileno" placeholder="Enter Alternate Mobile No.">
								    </div>

								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Fax No.</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="faxno" name="faxno" placeholder="Enter Fax No.">
								    </div>

								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Email Id</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="email" name="email" placeholder="Enter Email Id">
								    </div>
									
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Website</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="website" name="website" placeholder="Enter Website">
								    </div>
									
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contactName" name="contactName" placeholder="Enter Contact">
								    </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Notes</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="notes" name="notes" placeholder="Enter Notes">
								    </div>
									
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Motor Carrier No.</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="motorCarrierNo" name="motorCarrierNo" placeholder="Enter Motor Carrier No.">
								    </div>
									
								</div>

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Tax Id (EIN)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="taxId" name="taxId" placeholder="Enter Tax Id (EIN)">
								    </div>
									
								</div>

								<div class="form-group">
								<input type="button" class="btn btn-success" value="save" onclick="save_cust_data()"></button>
								<button type="button" class="btn btn-info" onclick="cancelform()">Cancel</button>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>
					$("select").chosen();
					$('select').trigger("chosen:updated");

					//$("select").chosen();
					$(".customer_form").hide();
					var first_id="";
					var second_id="";

					function show_cust_form(id1,id2){
						first_id=id1;
						second_id=id2;
						$(".load_form").hide();
						$(".customer_form").show();
						$( "#cust_customer_name").focus();
					}

					function cancelform(){
						$(".load_form").show();
						$(".customer_form").hide();
					}

					function save_cust_data(){
						var customer_name=$( "#cust_customer_name").val();
						var customer_type=$( "#customer_type").val();
						var street=$( "#street").val();
						var apt=$( "#apt").val();
						var state=$( "#state").val();
						var city=$( "#city").val();
						var zip_code=$( "#zip_code").val();
						var mobileno=$( "#mobileno").val();
						var alt_mobileno=$( "#alt_mobileno").val();
						var faxno=$( "#faxno").val();
						var email=$( "#email").val();
						var website=$( "#website").val();
						var contactName=$( "#contactName").val();
						var notes=$( "#notes").val();
						var motorCarrierNo=$( "#motorCarrierNo").val();
						var taxId=$( "#taxId").val();
						//alert(customer_name);

						//var status=$( "#"+id ).val();
						var postData = {
								"customer_name" : customer_name,
								"customer_type" : customer_type,
									"street" : street,
								"apt" : apt,
									"state" : state,
								"city" : city,
									"zip_code" : zip_code,
								"mobileno" : mobileno,
									"alt_mobileno" : alt_mobileno,
								"faxno" : faxno,
									"email" : email,
								"website" : website,
									"contactName" : contactName,
								"notes" : notes,
									"motorCarrierNo" : motorCarrierNo,
									"taxId" : taxId
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/master/save_customer_data',
							data: postData,
							success: function(data){
								//alert(data);
								if($.trim(data)>=1){
									$( "#cust_customer_name").val("");
						$( "#street").val("");
						$( "#apt").val("");
						$( "#city").val("");
						$( "#zip_code").val("");
						$( "#mobileno").val("");
						$( "#alt_mobileno").val("");
						$( "#faxno").val("");
						$( "#email").val("");
						$( "#website").val("");
						$( "#contactName").val("");
						$( "#notes").val("");
						$( "#motorCarrierNo").val("");
						$( "#taxId").val("");
									$(".load_form").show();
						$(".customer_form").hide();
						$( "#"+first_id).focus();
									$( "#"+first_id).val(customer_name);
									$( "#"+second_id).val($.trim(data));

						


								} else{
									alert('Errror in saving customer data. Please try again after sometime.');
								}
							}
						});
					}

					$( function() {

                    $("select").chosen();
					$('select').trigger("chosen:updated");

					})

					</script>