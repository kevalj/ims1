<div id="page-wrapper" class="expenseform">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Edit an Expense  :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/expense/expenseedit">

							<?php foreach($expense as $data): ?>

								   <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>
									<div class="col-sm-4">
										<input type="text" class="form-control1" id="expense_date" name="expense_date" placeholder="Enter Expense Date" readonly value="<?php echo $data['expense_date'] ?>">
								    </div>
									
								</div>    

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Fuel Vendor</label>
									<div class="col-sm-4">
										<input type="text" class="form-control1" id="fuel_vendor" name="fuel_vendor" placeholder="Enter Fuel Vendor" value="<?php echo $data['customer_name'] ?>">
										<input type="hidden" class="form-control1" id="fuel_vendor_id" name="fuel_vendor_id" placeholder="Enter Fuel Vendor" value="<?php echo $data['customer_id'] ?>">
								    </div>
									<div class="col-sm-2">
										<a class="btn btn-primary btn-flat btn-pri btn-lg"  onclick="show_cust_form('fuel_vendor','fuel_vendor_id')"><i class="fa fa-plus" aria-hidden="true"></i>Fuel Vendor</a>
										</div>

								</div>

                                <div class="form-group">
									<label class="col-sm-2 control-label">Expense category</label>
									<div class="col-sm-4">
										<select class="form-control1" name="expense_details_id" id="expense_details_id">
											
										</select>
										<input type="hidden" id="selcatid" name="selcatid" value="<?php echo $data['expense_details_id'] ?>">
									</div>
									<div class="col-sm-3">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_expense_form('expense_details_id','expense_details_id')"><i class="fa fa-plus" aria-hidden="true"></i>Expense category</a>
								    </div>
								</div>

        					   

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Amount</label>
									<div class="col-sm-4">
										<input type="text" class="form-control1" id="amount" name="amount" placeholder="Enter Amount" onblur="formatno(this.value,'amount')" value="<?php echo $data['expense_amount'] ?>">
								    </div>
									
								</div>

	                            <div class="form-group">
									<label class="col-sm-2 control-label"> Truck No</label>
									<div class="col-sm-4">
									<input type="text" class="form-control1" id="truck" name="truck" placeholder="Enter Truck No" value="<?php echo $data['truck'] ?>">
									<input type="hidden" class="form-control1" id="truck_id" name="truck_id" placeholder="Enter Truck No" value="<?php echo $data['truck_id'] ?>">
									</div>
									<div class="col-sm-3">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_vehicle_form('truck','truck_id')"><i class="fa fa-plus" aria-hidden="true"></i>Truck No</a>
								    </div>
									
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label"> Trailer No</label>
									<div class="col-sm-4">
									<input type="text" class="form-control1" id="trailer" name="trailer" placeholder="Enter trailer" value="<?php echo $data['trailer'] ?>">
									<input type="hidden" class="form-control1" id="trailer_id" name="trailer_id" placeholder="Enter trailer" value="<?php echo $data['trailer_id'] ?>">
										
									</div>
									<div class="col-sm-3">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_vehicle_form('trailer','trailer_id')"><i class="fa fa-plus" aria-hidden="true"></i>Trailer No</a>
								    </div>
								</div>

								

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-4">
										<input type="text" class="form-control1" id="description" name="description" placeholder="Enter Description" value="<?php echo $data['expense_description'] ?>">
								    </div>
									
								</div>

								
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Gallons</label>
									<div class="col-sm-4">
										<input type="text" class="form-control1" id="gallons" name="gallons" placeholder="Enter Gallons" value="<?php echo $data['gallons'] ?>">
								    </div>

								</div>

                                

                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>
									<div class="col-sm-4">
										<select class="form-control1 state" id="state" name="state" placeholder="Enter State/Province" >';
										<?php foreach($state as $data1): ?>
										<?php $selected="";?>
											  <?php
											  if($data['state_id']==$data1['state_id']){
												  $selected="selected";
											  }
											   ?>
										    <option value="<?php echo $data1['state_id'] ?>" <?php echo $selected; ?>><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										</select>
								    </div>
									
								</div>

								
								<div class="form-group">
									<label class="col-sm-2 control-label">Select Status</label>
									<div class="col-sm-4">
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
										<input type="hidden" class="form-control1" name="category_expense_details_id" id="category_expense_details_id" value="<?php echo $data['category_expense_details_id'] ?>" placeholder="Default Input">
									</div>
								</div>
								<?php endforeach; ?>

                                
								<div class="form-group">
								<input type="submit" class="btn btn-success" value="save"></button>
								<a href="<?php echo base_url(); ?>/index.php/expense/view_expense" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>
					var first_id="";
					var second_id="";
					 $('#expense_date').datepicker({
						  dateFormat: 'mm-dd-yy'
						});

					$( "#fuel_vendor").autocomplete({
					  source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
					  minLength: 2,
					  select: function( event, ui ) {
						$("#fuel_vendor_id").val(ui.item.id);
					  }
					});

					$( "#truck").autocomplete({
					  source: "<?php echo base_url(); ?>/index.php/load/get_vehicle_data",
					  minLength: 2,
					  select: function( event, ui ) {
						$("#truck_id").val(ui.item.id);
					  }
					});


					$( "#trailer").autocomplete({
					  source: "<?php echo base_url(); ?>/index.php/load/get_vehicle_data",
					  minLength: 2,
					  select: function( event, ui ) {
						$("#trailer_id").val(ui.item.id);
					  }
					});


					function getExpenseCategory(id){
						//alert("hii");
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/expense/getExpenseCategory',
							
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var string="";
								for(var i=0;i<obj.data.length;i++){
									if(id==obj.data[i][0]){
									string=string+'<option  value="'+obj.data[i][0]+'" selected="selected" >'+obj.data[i][1]+'</option>';
									}else{
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][1]+'</option>';
									}
									
								}
								$('#expense_details_id')
										.empty()
										.append(string);
								$('select').trigger("chosen:updated");

								
							}
						});
					}

					getExpenseCategory($("#selcatid").val());
				 </script>


<div id="page-wrapper" class="expensecatform">
<div class="main-page">
<div class="forms">
<div class="row">
						<h3 class="title1">Add an Expense Category  :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/expense/expensecategoryadd">

							
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Expense Category</label>
									<div class="col-sm-4">
										<input type="text" class="form-control1" id="exp_expense_category" name="exp_expense_category" placeholder="Enter Expense Category">
								    </div>
									
								</div>

	                        
                                
								<div class="form-group">
								<button type="button" class="btn btn-success" onclick="save_expense_form()">Save</button>
								<button type="button" class="btn btn-info" onclick="hide_expense_form()">Cancel</button>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>

					function show_expense_form(name,id){
						first_id=name;
					$(".expenseform").hide();
					$(".expensecatform").show();
					}

					function hide_expense_form(){
					$(".expenseform").show();
					$(".expensecatform").hide();
					}


					function save_expense_form(){
						var exp_expense_category=$( "#exp_expense_category").val();
						//alert(customer_name);

						//var status=$( "#"+id ).val();
						var postData = {
								"exp_expense_category" : exp_expense_category
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/expense/save_expense_category_data',
							data: postData,
							success: function(data){
								//alert(data);
								if($.trim(data)>=1){

									$( "#exp_expense_category").val("");
									$(".expenseform").show();
									$(".expensecatform").hide();
									getExpenseCategory($.trim(data));

									
									
								} else{
									alert('Errror in saving Expense Category data. Please try again after sometime.');
								}
							}
						});
					}


					</script>


					<!-------------------------------------vehicle form------------------------------------------->

					<div id="page-wrapper" class="vehicle_form">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Vehicle Registration Form :</h3>
						<div class="form-three widget-shadow">
							<form action="<?php echo base_url(); ?>index.php/master/vehiclekadd" method="post" class="form-horizontal">

							<div class="form-group">
									<label class="col-sm-2 control-label">Select Vehicle Type</label>
									<div class="col-sm-8">
										<select class="form-control1" name="vehicle_type" id="vehicle_type">
										<?php foreach($vehicle_type as $data): ?>
											<option value="<?php echo $data['vehicle_type_id'] ?>"><?php echo $data['vehicle_name'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Vehicle No.</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="vehicleno" id="vehicleno" placeholder="Default Input">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">VIN No.</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="vinno" id="vinno" placeholder="Default Input">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Plate</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="Plate" name="Plate" placeholder="Default Input">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Make</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="make" name="make" placeholder="Default Input">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Model</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="model" name="model" placeholder="Default Input">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Registration Expiry Date</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="regexpdate" name="regexpdate" placeholder="Default Input" readonly>
								    </div>
									
								</div>

								<div class="form-group">
								<button type="button" class="btn btn-success" onclick="save_vehicle_data()">Save</button>
								<button type="button" class="btn btn-info" onclick="cancelvehicleform()">Cancel</button>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>
<script>
					$( function() {
    
	$('#regexpdate').datepicker({
      dateFormat: 'mm-dd-yy'
});
    
  } );
</script>

<script>
					function show_vehicle_form(id1,id2){
						first_id=id1;
						second_id=id2;
						$(".expenseform").hide();
						$(".vehicle_form").show();
						$( "#vehicle_type").focus();
					}

					function cancelvehicleform(){
						$(".expenseform").show();
						$(".vehicle_form").hide();
					}

					function save_vehicle_data(){
						var vehicle_type=$( "#vehicle_type").val();
						var vehicleno=$( "#vehicleno").val();
						var vinno=$( "#vinno").val();
						var Plate=$( "#Plate").val();
						var make=$( "#make").val();
						var model=$( "#model").val();
						var regexpdate=$( "#regexpdate").val();
						
						//alert(customer_name);

						//var status=$( "#"+id ).val();
						var postData = {
								"vehicle_type" : vehicle_type,
								"vehicleno" : vehicleno,
									"vinno" : vinno,
								"Plate" : Plate,
									"make" : make,
								"model" : model,
									"regexpdate" : regexpdate
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/master/save_vehicle_data',
							data: postData,
							success: function(data){
								//alert(data);
								if($.trim(data)>=1){
									$( "#vehicle_type").val("");
						$( "#vehicleno").val("");
						$( "#vinno").val("");
						$( "#Plate").val("");
						$( "#make").val("");
						$( "#model").val("");
						$( "#registration_expiry_date").val("");
						
						$(".expenseform").show();
						$(".vehicle_form").hide();
						$( "#"+first_id).focus();
									$( "#"+first_id).val(vehicleno);
									$( "#"+second_id).val($.trim(data));

						


								} else{
									alert('Errror in saving vehicle data. Please try again after sometime.');
								}
							}
						});
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
											<?php foreach($cust_type as $data1): ?>
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
										<?php foreach($state as $data1): ?>
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
					

					var first_id="";
					var second_id="";

					function show_cust_form(id1,id2){
						first_id=id1;
						second_id=id2;
						$(".expenseform").hide();
						$(".customer_form").show();
						$( "#cust_customer_name").focus();
					}

					function cancelform(){
						$(".expenseform").show();
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
						$( "#customer_type").val("");
						$( "#street").val("");
						$( "#apt").val("");
						$( "#state").val("");
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
									$(".expenseform").show();
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

					</script>







					<script>

					$( function() {

                    $("select").chosen();
					$('select').trigger("chosen:updated");

					$(".expenseform").show();
					$(".expensecatform").hide();
					$(".vehicle_form").hide();
					$(".customer_form").hide();
					})

					</script>