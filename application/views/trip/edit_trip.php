
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script>
function getExpenseCategory(id,name){
					//	alert(id+"hii"+name);
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
								$('#'+name)
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								$('#'+name).focus();


								
							}
						});
					}
</script>
<div id="page-wrapper" class="trip_form">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Edit a Trip  :</h3>
						<div class="form-three widget-shadow">
							<form action="<?php echo base_url(); ?>index.php/trip/tripedit" class="form-horizontal" method="post">
							<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>

							<?php foreach($trip_data as $data): ?>
								<div class="panel panel-info">
							
							<div class="panel-heading">
							<h3 class="panel-title"> Basic Details</h3> 
							</div>
							<div class="panel-body"> 
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Custom Trip Number</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="cust_trip_no" name="cust_trip_no" placeholder="Enter Custom Trip Number" value="<?php echo $data['trip_number'] ?>">
										<input type="hidden" class="form-control1" id="trip_details_id" name="trip_details_id" placeholder="Enter Custom Trip Number" value="<?php echo $data['trip_details_id'] ?>">
								    </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Trip Tracking Link </label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="trip_tracking_link" name="trip_tracking_link" placeholder="Enter Trip Tracking Link" value="<?php echo $data['trip_tracking_link'] ?>">
								    </div>
									
								</div>
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-12">
								<div class="col-sm-6">


								<div class="panel panel-info">
							
								<div class="panel-heading">
								<h3 class="panel-title"> Driver Details</h3> 
								</div>
								<div class="panel-body"> 
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Driver</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="driver" name="driver" placeholder="Enter Driver Name" value="<?php echo $data['team_driver_name'] ?>">
										<input type="hidden" class="form-control1" id="driver_id" name="driver_id" placeholder="Enter Driver Name" value="<?php echo $data['driver_id'] ?>">
								    </div>
									<div class="col-sm-2"><a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_driver_form('driver','driver_id')"><i class="fa fa-plus" aria-hidden="true"></i>Driver</a>
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Accessory Driver Pay</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="acc_driver_pay" name="acc_driver_pay" placeholder="Enter Accessory Driver Pay" value="<?php echo $data['acc_driver_pay'] ?>" onblur="formatno(this.value,'acc_driver_pay')">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Driver Advance</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="driver_advance" name="driver_advance" placeholder="Enter Driver Advance" value="<?php echo $data['driver_advance'] ?>" onblur="formatno(this.value,'driver_advance')">
								    </div>
								
								</div>
								</div>
								</div>
								</div>

								<div class="col-sm-6">
								<div class="panel panel-info">
							
								<div class="panel-heading">
								<h3 class="panel-title"> Team Driver Details</h3> 
								</div>
							
								<div class="panel-body"> 
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Team Driver</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="team_driver" name="team_driver" placeholder="Enter Team Driver" value="<?php echo $data['team_driver_name'] ?>">
										<input type="hidden" class="form-control1" id="team_driver_id" name="team_driver_id" placeholder="Enter Team Driver" value="<?php echo $data['team_driver_id'] ?>">
								    </div>
									<div class="col-sm-2"><a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_driver_form('team_driver','team_driver_id')"><i class="fa fa-plus" aria-hidden="true"></i>Team Driver</a>
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Accessory Driver Pay</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="acc_team_driver_pay" name="acc_team_driver_pay" placeholder="Enter Accessory Driver Pay" value="<?php echo $data['team_acc_driver_pay'] ?>" onblur="formatno(this.value,'acc_team_driver_pay')">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Driver Advance</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="team_driver_advance" name="team_driver_advance" placeholder="Enter Team Driver" value="<?php echo $data['team_driver_advance'] ?>" onblur="formatno(this.value,'team_driver_advance')">
								    </div>
								
								</div>
								</div>
								</div>
								</div>
								</div>
								</div>

								<div class="panel panel-info">
							
							<div class="panel-heading">
							<h3 class="panel-title"> Vehicle Details</h3> 
							</div>
							
							<div class="panel-body"> 
								

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Truck</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="truck" name="truck" placeholder="Enter truck" value="<?php echo $data['truck'] ?>">
										<input type="hidden" class="form-control1" id="truck_id" name="truck_id" placeholder="Enter truck" value="<?php echo $data['truck_id'] ?>">
								    </div>
									<div class="col-sm-2"><a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_vehicle_form('truck','truck_id')"><i class="fa fa-plus" aria-hidden="true"></i>Truck</a>
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Trailer</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="trailer" name="trailer" placeholder="Enter trailer" value="<?php echo $data['trailer'] ?>">
										<input type="hidden" class="form-control1" id="trailer_id" name="trailer_id" placeholder="Enter trailer" value="<?php echo $data['trailer_id'] ?>">
								    </div>
									<div class="col-sm-2"><a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_vehicle_form('trailer','trailer_id')"><i class="fa fa-plus" aria-hidden="true"></i>Trailer</a>
									</div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Odometer</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="odometer1" name="odometer1" placeholder="Enter odometer" value="<?php echo $data['odometer'] ?>">
								    </div>
									
									
								</div>
								</div>
								</div>

								<?php endforeach; ?>

								<div class="panel panel-info">
							
							<div class="panel-heading">
							<h3 class="panel-title"> Select Load</h3> 
							</div>
							
							<div class="panel-body"> 

								<div class="form-group">
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
												  
												</tr>
											</thead>
								
										</table>
									
								</div>
								</div>
								</div>

								

								<div class="form-group element1" id="routingstop" >
								<div class="panel panel-info">
								<div class="panel-heading">
							<h3 class="panel-title"> Routing Stop Details</h3> 
							</div>
							
							<div class="panel-body"> 
									<div class="col-sm-12 element1" id='del_0'>
									</div>
									<?php $i=0;?>
									<?php foreach($trip_stop_data as $data): ?>
									<div class="col-sm-12 element1" id="del_<?php echo $i+1;?>">
									<div class="panel-heading"> 
									<h3 class="panel-title">Routing Stop - <?php echo $i+1;?></h3> 
									</div>
									<div class="panel-body">
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Routing Stop</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 consignee_name ui-autocomplete-input" id="routing_stop<?php echo $i+1;?>" name="routing_stop[]" placeholder="Enter Routing Stop" autocomplete="off" value="<?php echo $data['customer_name'] ?>">
									<input type="hidden" class="form-control1 consignee_name" id="routing_stop_id<?php echo $i+1;?>" name="routing_stop_id[]" placeholder="Enter Shipper Name" value="<?php echo $data['routing_stop_id'] ?>">
									</div>
									<div class="col-sm-2">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form('routing_stop<?php echo $i+1;?>','routing_stop_id<?php echo $i+1;?>')"><i class="fa fa-plus" aria-hidden="true"></i>Routing Stop</a>
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Routing Stop Date</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 delivery_date datep" id="delivery_date<?php echo $i+1;?>" name="delivery_date[]" placeholder="Enter Delivery Date" readonly="" value="<?php echo $data['routing_stop_date'] ?>">
									</div>
									
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Instructions</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 instructions" id="instructions<?php echo $i+1;?>" name="instructions[]" placeholder="Enter Instructions" value="<?php echo $data['instruction'] ?>">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Notes</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 instructions" id="notes<?php echo $i+1;?>" name="notes[]" placeholder="Enter Notes" value="<?php echo $data['notes'] ?>">
									</div>
									</div>
									</div>
									</div>
									<?php $i++;?>
									<script>
									$( "#routing_stop"+<?php echo $i; ?>).autocomplete({
									  source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
									  minLength: 2,
									  select: function( event, ui ) {
										$("#routing_stop_id"+toNumeric(this.id)).val(ui.item.id);
									  }
									});
									</script>
									<?php endforeach; ?>
									<input type="hidden" name="routingstopid" id="routingstopid" value="<?php echo $i;?>">
									</div>
									</div>
									
								</div>

								<div class="form-group">
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="addroutingstop()"><i class="fa fa-plus" aria-hidden="true"></i> Another Routing Stop</button>
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="deleteroutingstop()"><i class="fa fa-minus" aria-hidden="true"></i>  Routing Stop</button>
									
								</div>



								
								<div class="form-group element2"  id="fuelexpense" >
								
								<div class="panel panel-info">
								<div class="panel-heading">
								<h3 class="panel-title"> Fuel Expense Details</h3> 
								</div>
							
								<div class="panel-body"> 
									<div class="col-sm-12 element2" id='del1_0'>
									</div>
									<?php $j=0?>
									<?php foreach($trip_fuel_data as $data): ?>
									<div class="col-sm-12 element2" id="del_<?php echo $j+1;?>">
									<div class="panel-heading"> 
									<h3 class="panel-title">Fuel Expense - <?php echo $j+1;?></h3> 
									</div>
									<div class="panel-body">
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 delivery_date datep" id="expense_date<?php echo $j+1;?>" name="expense_date[]" placeholder="Enter Expense Date" readonly="" value="<?php echo $data['expense_date'] ?>">
									</div>
									
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Amount</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 amount" id="amount<?php echo $j+1;?>"  name="amount[]" placeholder="Enter Amount" value="<?php echo $data['amount'] ?>" onblur="formatno(this.value,'amount<?php echo $j+1;?>')">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Gallons</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 gallons" id="gallons<?php echo $j+1;?>"  name="gallons[]" placeholder="Enter Gallons" value="<?php echo $data['gallons'] ?>">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Odometer</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 odometer" id="odometer<?php echo $j+1;?>"  name="odometer[]" placeholder="Enter Odometer" value="<?php echo $data['odometer'] ?>">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Fuel Vendor</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 fuel_vendor ui-autocomplete-input" id="fuel_vendor<?php echo $j+1;?>" name="fuel_vendor[]" placeholder="Enter Fuel Vendor" autocomplete="off" value="<?php echo $data['customer_name'] ?>">
									<input type="hidden" class="form-control1 fuel_vendor_id" id="fuel_vendor_id<?php echo $j+1;?>" name="fuel_vendor_id[]" placeholder="Enter Fuel Vendor" value="<?php echo $data['fuel_vender'] ?>">
									</div>
									<div class="col-sm-2">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form('fuel_vendor<?php echo $j+1;?>','fuel_vendor_id<?php echo $j+1;?>')"><i class="fa fa-plus" aria-hidden="true"></i> Fuel Vendor</a>
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>
									<div class="col-sm-6">
									<select class="form-control1 state" id="state<?php echo $j+1;?>"  name="state[]" placeholder="Enter State/Province">	
									<?php foreach($result as $data1): ?>
										<option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>;
									<?php endforeach; ?>
									
									</select>
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Include on driver settlement?</label>
									<div class="col-sm-6">
									<select class="form-control1 driver_settlement" id="driver_settlement<?php echo $j+1;?>"  name="driver_settlement[]" placeholder="Include on driver settlements?">
									<?php  foreach($result1 as $data1): ?>
										<option value="<?php echo $data1['status_code'] ?>" ><?php echo $data1['status'] ?></option>;
									<?php endforeach; ?>
									</select>
									</div>
									</div>
									</div>
									</div>
									<?php $j++;?>

									<script>
									$( "#fuel_vendor"+<?php echo $j; ?>).autocomplete({
									  source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
									  minLength: 2,
									  select: function( event, ui ) {
										$("#fuel_vendor_id"+toNumeric(this.id)).val(ui.item.id);
									  }
									});
									</script>
									<?php endforeach; ?>
									<input type="hidden" name="fuelexpid" id="fuelexpid" value="<?php echo $j;?>">
									</div>
									</div>
									
								</div>

								<div class="form-group">
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="addfuelexp()"><i class="fa fa-plus" aria-hidden="true"></i> Fuel Expenses</button>
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="deletefuelexp()"><i class="fa fa-minus" aria-hidden="true"></i> Fuel Expenses</button>
									
								</div>




								<div class="form-group element3" id="truckexpense" >
								<div class="panel panel-info">
								<div class="panel-heading">
								<h3 class="panel-title"> Fuel Truck Details</h3> 
								</div>
							
								<div class="panel-body"> 
									<div class="col-sm-12 element3" id='del2_0'>
									</div>

									<?php $k=0?>
									<?php foreach($trip_truck_data as $data): ?>

									<div class="col-sm-12 element3" id="del2_<?php echo ($k+1)?>">
									<div class="panel-heading"> 
									<h3 class="panel-title">Truck Expense - <?php echo ($k+1)?></h3> 
									</div>
									<div class="panel-body">
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Expense Category</label>
									<div class="col-sm-6">
									<select type="text" class="form-control1 exp_category" id="exp_category_id<?php echo ($k+1)?>" name="exp_category_id[]" placeholder="Enter Expense Category">
									
									</select>
									</div>
									<script>
									getExpenseCategory("<?php echo $data['expense_category_id'] ?>","exp_category_id<?php echo ($k+1)?>");
									</script>
									<div class="col-sm-2">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_expense_form('exp_category_id<?php echo ($k+1)?>','exp_category_id<?php echo ($k+1)?>')"><i class="fa fa-plus" aria-hidden="true"></i>Expense category</a>
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 expense_date datep" id="truck_expense_date<?php echo ($k+1)?>" name="truck_expense_date[]" placeholder="Enter Expense Date" readonly="" value="<?php echo $data['expense_date'] ?>">
									</div>
									</div>
									
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Amount</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 amount" id="truck_amount<?php echo ($k+1)?>"  name="truck_amount[]" placeholder="Enter Amount" value="<?php echo $data['expense_amount'] ?>" onblur="formatno(this.value,'truck_amount<?php echo ($k+1)?>')">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Include on driver settlement?</label>
									<div class="col-sm-6">
									<select class="form-control1 driver_settlement" id="truck_driver_settlement<?php echo ($k+1)?>"  name="truck_driver_settlement[]" placeholder="Include on driver settlement?">
									<?php foreach($result1 as $data1): ?>
										<option value="<?php echo $data1['status_code'] ?>" ><?php echo $data1['status'] ?></option>;
									<?php endforeach; ?>
									</select>
									</div>
									</div>
									</div>
									</div>

									<?php $k++;?>
									<?php endforeach; ?>
									<input type="hidden" name="fueltruckid" id="fueltruckid" value="<?php echo $k?>"/>
									</div>
									</div>
								</div>

								<div class="form-group">
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="addtruckexp()"><i class="fa fa-plus" aria-hidden="true"></i> Truck Expenses</button>
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="deletetruckexp()"><i class="fa fa-minus" aria-hidden="true"></i> Truck Expenses</button>
									
								</div>



								<div class="form-group element4" id="reffuelexpense" >
								<div class="panel panel-info">
								<div class="panel-heading">
								<h3 class="panel-title"> Refer Fuel Expenses Details</h3> 
								</div>
							
								<div class="panel-body"> 
									<div class="col-sm-12 element4" id='del3_0'>
									</div>

									<?php $l=0?>
									<?php foreach($trip_refree_data as $data): ?>

									<div class="col-sm-12 element4" id="del3_<?php echo $l+1;?>">
									<div class="panel-heading"> 
									<h3 class="panel-title">Refer Fuel Expense - <?php echo $l+1;?></h3> 
									</div>
									<div class="panel-body">
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 ref_delivery_date datep" id="ref_expense_date<?php echo $l+1;?>" name="ref_expense_date[]" placeholder="Enter Expense Date" readonly="" value="<?php echo $data['expense_date'] ?>">
									</div>
									
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Amount</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 ref_amount" id="ref_amount<?php echo $l+1;?>" name="ref_amount[]" placeholder="Enter Amount" value="<?php echo $data['expense_amount'] ?>" onblur="formatno(this.value,'ref_amount<?php echo $l+1;?>')">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Gallons</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 ref_gallons" id="ref_gallons<?php echo $l+1;?>"  name="ref_gallons[]" placeholder="Enter Gallons" value="<?php echo $data['gallons'] ?>">
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Fuel Vendor</label>
									<div class="col-sm-6">
									<input type="text" class="form-control1 ref_fuel_vendor ui-autocomplete-input" id="ref_fuel_vendor<?php echo $l+1;?>" name="ref_fuel_vendor[]" placeholder="Enter Fuel Vendor" autocomplete="off" value="<?php echo $data['customer_name'] ?>">
									<input type="hidden" class="form-control1 ref_fuel_vendor_id" id="ref_fuel_vendor_id<?php echo $l+1;?>" name="ref_fuel_vendor_id[]" placeholder="Enter Fuel Vendor" value="<?php echo $data['fuel_vendor_id'] ?>">
									</div>
									<div class="col-sm-2">
									<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form('ref_fuel_vendor<?php echo $l+1;?>','ref_fuel_vendor_id<?php echo $l+1;?>')"><i class="fa fa-plus" aria-hidden="true"></i> Fuel Vendor</a>
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>
									<div class="col-sm-6">
									<select class="form-control1 ref_state" id="ref_state"  name="ref_state[]" placeholder="Enter State/Province">	
									<?php foreach($result as $data1): ?>
										<option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>;
									<?php endforeach; ?>
									</select>
									</div>
									</div>
									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Include on driver settlement?</label>
									<div class="col-sm-6">
									<select class="form-control1 ref_driver_settlement" id="ref_driver_settlement<?php echo $l+1;?>"  name="ref_driver_settlement[]" placeholder="Include on driver settlement?">
									<?php foreach($result1 as $data1): ?>
										<option value="<?php echo $data1['status_code'] ?>" ><?php echo $data1['status'] ?></option>;
									<?php endforeach; ?>
									</select>
									</div>
									</div>
									</div>
									</div>

									<?php $l++;?>
									<script>
									$( "#ref_fuel_vendor"+<?php echo $l; ?>).autocomplete({
									  source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
									  minLength: 2,
									  select: function( event, ui ) {
										$("#ref_fuel_vendor_id"+toNumeric(this.id)).val(ui.item.id);
									  }
									});
									</script>
									<?php endforeach; ?>
									<input type="hidden" name="reeferfuelid" id="reeferfuelid" value="<?php echo $l;?>">
								</div>
								</div>
								</div>

								<div class="form-group">
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="addreffuelexp()"><i class="fa fa-plus" aria-hidden="true"></i> Refer Fuel Expenses</button>
									<button type="button" class="btn btn-primary btn-flat btn-pri btn-lg" onclick="deletereffuelexp()"><i class="fa fa-minus" aria-hidden="true"></i> Refer Fuel Expenses</button>
									
								</div>

								<div class="panel panel-info">
								
								<div class="panel-heading">
								<h3 class="panel-title"> Status</h3> 
								</div>
								<div class="panel-body ">
								<div class="form-group col-sm-2">
										<select class="form-control1" name="status" id="status">
										<?php foreach($trip_data as $data): ?>
											<?php foreach($status as $data1): ?>
											<?php $selected="";?>
											  <?php
											  
											  if($data['status']==$data1['status_code']){
												  $selected="selected";
											  }
											   ?>
											<option value="<?php echo $data1['status_code'] ?>" <?php echo $selected; ?>><?php echo $data1['status_name'] ?></option>
											
											<?php endforeach; ?>
											<?php endforeach; ?>
											
										</select>
										
									</div>
								</div>
								</div>

								<div class="form-group">
								<input type="submit" class="btn btn-success" value="Save">
								<a href="<?php echo base_url(); ?>/index.php/trip/view_trip" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>
					var nextindex1=parseInt($("#routingstopid").val())+1;
					

					function addroutingstop(){
$("#routingstop").css('display','block');
   // Adding new div container after last occurance of element class
   $(".element1:last").after("<div class='element1' id='del_"+ nextindex1 +"'></div>");
 

										var div='<div class="panel-heading"> <h3 class="panel-title">Routing Stop - '+(nextindex1)+'</h3> </div><div class="panel-body"><div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Routing Stop</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 consignee_name" id="routing_stop'+nextindex1+'" name="routing_stop[]" placeholder="Enter Routing Stop">';
										div=div+'<input type="hidden" class="form-control1 consignee_name" id="routing_stop_id'+nextindex1+'" name="routing_stop_id[]" placeholder="Enter Shipper Name">';
										div=div+'</div>';
										div=div+'<div class="col-sm-2">';
										div=div+'<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form(\'routing_stop'+nextindex1+'\',\'routing_stop_id'+nextindex1+'\')"><i class="fa fa-plus" aria-hidden="true"></i>Routing Stop</a>';
										
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Routing Stop Date</label>';
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

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Notes</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 instructions" id="notes'+nextindex1+'" name="notes[]" placeholder="Enter Notes" >';
										div=div+'</div>';
										div=div+'</div>';
   $("#del_" + nextindex1).append(div);

$( "#routing_stop"+nextindex1).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#routing_stop_id"+toNumeric(this.id)).val(ui.item.id);
      }
    });

    $('#delivery_date'+nextindex1).datepicker({
      dateFormat: 'mm-dd-yy'
	});
$("select").chosen();
nextindex1++;
  }

  function deleteroutingstop(){
	  if(nextindex1>0){
	  $("#del_"+(nextindex1-1)).remove();
		nextindex1--;
	  }
  }


nextindex2=parseInt($("#fuelexpid").val())+1;
  function addfuelexp(){
$("#fuelexpense").css('display','block');
	  $(".element2:last").after("<div class='element2' id='del1_"+ nextindex2 +"'></div>");
		  

										var div="";

										div=div+'<div class="panel-heading"> <h3 class="panel-title">Fuel Expense - '+(nextindex2)+'</h3> </div><div class="panel-body"><div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 delivery_date" id="expense_date'+nextindex2+'" name="expense_date[]" placeholder="Enter Expense Date" readonly>';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Amount</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 amount" id="amount'+nextindex2+'" name="amount[]" placeholder="Enter Amount" onblur="formatno(this.value,\'amount'+nextindex2+'\')">';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Gallons</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 gallons" id="gallons'+nextindex2+'" name="gallons[]" placeholder="Enter Gallons" >';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Odometer</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 odometer" id="odometer'+nextindex2+'" name="odometer[]" placeholder="Enter Odometer" >';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Fuel Vendor</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 fuel_vendor" id="fuel_vendor'+nextindex2+'" name="fuel_vendor[]" placeholder="Enter Fuel Vendor">';
										div=div+'<input type="hidden" class="form-control1 fuel_vendor_id" id="fuel_vendor_id'+nextindex2+'" name="fuel_vendor_id[]" placeholder="Enter Fuel Vendor">';
										div=div+'</div>';
										div=div+'<div class="col-sm-2">';
										div=div+'<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form(\'fuel_vendor'+nextindex2+'\',\'fuel_vendor_id'+nextindex2+'\')"><i class="fa fa-plus" aria-hidden="true"></i> Fuel Vendor</a>';
										
										div=div+'</div>';
										div=div+'</div>';


										


										

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<select class="form-control1 state" id="state'+nextindex2+'" name="state[]" placeholder="Enter State/Province" >';
										<?php foreach($result as $data1): ?>
										div=div+'	<option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										div=div+'</select>';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Include on driver settlement?</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<select class="form-control1 driver_settlement" id="driver_settlement'+nextindex1+'" name="driver_settlement[]" placeholder="Include on driver settlement?" >';
										<?php foreach($result1 as $data1): ?>
										div=div+'	<option value="<?php echo $data1['status_code'] ?>" ><?php echo $data1['status'] ?></option>';
											<?php endforeach; ?>
										div=div+'</select>';
										div=div+'</div>';
										div=div+'</div>';
   $("#del1_" + nextindex2).append(div);

$( "#fuel_vendor"+nextindex2).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#fuel_vendor_id"+toNumeric(this.id)).val(ui.item.id);
      }
    });

    $('#expense_date'+nextindex2).datepicker({
      dateFormat: 'mm-dd-yy'
	});
$("select").chosen();
nextindex2++;

  }
function deletefuelexp(){
	  if(nextindex2>0){
	  $("#del1_"+(nextindex2-1)).remove();
		nextindex2--;
	  }
  }


var nextindex3=parseInt($("#fueltruckid").val())+1;
  function addtruckexp(){

	  $("#truckexpense").css('display','block');
	  $(".element3:last").after("<div class='element3' id='del2_"+ nextindex3 +"'></div>");
 

										var div="";


										div=div+'<div class="panel-heading"> <h3 class="panel-title">Truck Expense - '+(nextindex3)+'</h3> </div><div class="panel-body"><div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Expense Category</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<select type="text" class="form-control1 exp_category" id="exp_category_id'+nextindex3+'" name="exp_category_id[]" placeholder="Enter Expense Category">';
										
										div=div+'</select>';
										div=div+'</div>';
										div=div+'<div class="col-sm-2">';
										div=div+'<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_expense_form(\'exp_category_id'+nextindex3+'\',\'exp_category_id'+nextindex3+'\')"><i class="fa fa-plus" aria-hidden="true"></i> Expense Category</a>';
										
										
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 expense_date" id="truck_expense_date'+nextindex3+'" name="truck_expense_date[]" placeholder="Enter Expense Date" readonly>';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Amount</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 amount" id="truck_amount'+nextindex3+'" name="truck_amount[]" placeholder="Enter Amount" onblur="formatno(this.value,\'truck_amount'+nextindex3+'\')">';
										div=div+'</div>';
										div=div+'</div>';

										


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Include on driver settlement?</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<select class="form-control1 driver_settlement" id="truck_driver_settlement'+nextindex3+'" name="truck_driver_settlement[]" placeholder="Include on driver settlement?" >';
										<?php foreach($result1 as $data1): ?>
										div=div+'	<option value="<?php echo $data1['status_code'] ?>" ><?php echo $data1['status'] ?></option>';
											<?php endforeach; ?>
										div=div+'</select>';
										div=div+'</div>';
										div=div+'</div>';
   $("#del2_" + nextindex3).append(div);

$( "#exp_category"+nextindex3).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/customer/get_driver_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#exp_category_id"+toNumeric(this.id)).val(ui.item.id);
      }
    });

    $('#truck_expense_date'+nextindex3).datepicker({
      dateFormat: 'mm-dd-yy'
	});

	getExpenseCategory('exp_category_id'+nextindex3,'exp_category_id'+nextindex3);
	
nextindex3++;
  }

 function deletetruckexp(){
	  if(nextindex3>0){
	  $("#del2_"+(nextindex3-1)).remove();
		nextindex3--;
	  }
  }


var nextindex4=parseInt($("#reeferfuelid").val())+1;
  function addreffuelexp(){

	   $("#reffuelexpense").css('display','block');
	  $(".element4:last").after("<div class='element4' id='del3_"+ nextindex4 +"'></div>");
 

										var div="";

										div=div+'<div class="panel-heading"> <h3 class="panel-title">Refer Fuel Expense - '+(nextindex4)+'</h3> </div><div class="panel-body"><div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Expense Date</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 ref_delivery_date" id="ref_expense_date'+nextindex4+'" name="ref_expense_date[]" placeholder="Enter Expense Date" readonly>';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Amount</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 ref_amount" id="ref_amount'+nextindex4+'" name="ref_amount[]" placeholder="Enter Amount" onblur="formatno(this.value,\'ref_amount'+nextindex4+'\')">';
										div=div+'</div>';
										div=div+'</div>';

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Gallons</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 ref_gallons" id="ref_gallons'+nextindex4+'" name="ref_gallons[]" placeholder="Enter Gallons" >';
										div=div+'</div>';
										div=div+'</div>';

										


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Fuel Vendor</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<input type="text" class="form-control1 ref_fuel_vendor" id="ref_fuel_vendor'+nextindex4+'" name="ref_fuel_vendor[]" placeholder="Enter Fuel Vendor">';
										div=div+'<input type="hidden" class="form-control1 ref_fuel_vendor_id" id="ref_fuel_vendor_id'+nextindex4+'" name="ref_fuel_vendor_id[]" placeholder="Enter Fuel Vendor">';
										div=div+'</div>';
										div=div+'<div class="col-sm-2">';
										div=div+'<a class="btn btn-primary btn-flat btn-pri btn-lg" onclick="show_cust_form(\'ref_fuel_vendor'+nextindex4+'\',\'ref_fuel_vendor_id'+nextindex4+'\')"><i class="fa fa-plus" aria-hidden="true"></i> Fuel Vendor</a>';
										
										div=div+'</div>';
										div=div+'</div>';


										


										

										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<select class="form-control1 ref_state" id="ref_state'+nextindex4+'" name="ref_state[]" placeholder="Enter State/Province" >';
										<?php foreach($result as $data1): ?>
										div=div+'	<option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										div=div+'</select>';
										div=div+'</div>';
										div=div+'</div>';


										div=div+'<div class="form-group">';
										div=div+'<label for="focusedinput" class="col-sm-2 control-label">Include on driver settlement?</label>';
										div=div+'<div class="col-sm-6">';
										div=div+'<Select class="form-control1 ref_driver_settlement" id="ref_driver_settlement'+nextindex4+'" name="ref_driver_settlement[]" placeholder="Include on driver settlement?" >';
										<?php foreach($result1 as $data1): ?>
										div=div+'	<option value="<?php echo $data1['status_code'] ?>" ><?php echo $data1['status'] ?></option>';
											<?php endforeach; ?>
										div=div+'</div>';
										div=div+'</div>';
   $("#del3_" + nextindex4).append(div);

$( "#ref_fuel_vendor"+nextindex4).autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_customer_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#ref_fuel_vendor_id"+toNumeric(this.id)).val(ui.item.id);
      }
    });

    $('#ref_expense_date'+nextindex4).datepicker({
      dateFormat: 'mm-dd-yy'
	});
$("select").chosen();
nextindex4++;
  }

  function deletereffuelexp(){
	  if(nextindex4>0){
	  $("#del3_"+(nextindex4-1)).remove();
		nextindex4--;
	  }
  }




					$( function() {
						
						$('#dob').datepicker({
						  dateFormat: 'mm-dd-yy'
					});
						
					  } );
</script>

<script>
var postData = {
								"id" : <?php echo $_GET['id'] ?>
								
								
							};
					$('#vehicle').DataTable({
					"pageLength" : 10,
					"ajax": {
						url : "<?php echo base_url(); ?>index.php/load/getSelTripLoadData",
						type : 'POST',
							data: postData,

					},
				});

					function editdata(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/load/editLoadData?id="+id;

					}

					function deletedata(){

					}



		$( "#driver").autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_driver_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#driver_id").val(ui.item.id);
      }
    });


	$( "#team_driver").autocomplete({
      source: "<?php echo base_url(); ?>/index.php/load/get_driver_data",
      minLength: 2,
      select: function( event, ui ) {
        $("#team_driver_id").val(ui.item.id);
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
					

					var first_id="";
					var second_id="";

					function show_cust_form(id1,id2){
						first_id=id1;
						second_id=id2;
						$(".trip_form").hide();
						$(".customer_form").show();
						$( "#cust_customer_name").focus();
					}

					function cancelform(){
						$(".trip_form").show();
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
									$(".trip_form").show();
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
						$(".trip_form").hide();
						$(".vehicle_form").show();
						$( "#vehicle_type").focus();
					}

					function cancelvehicleform(){
						$(".trip_form").show();
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
						
						$(".trip_form").show();
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

		<!--------------------------------------------------------driver form------------------------------------------------------------->



		<div id="page-wrapper" class="driver_form">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Driver Registration Form :</h3>
						<div class="form-three widget-shadow">
							<form action="<?php echo base_url(); ?>index.php/master/driverkadd" class="form-horizontal" method="post">

							

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Driver Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="driver_name" id="driver_name" placeholder="Enter Driver Name">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Street</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="dri_street" name="street" placeholder="Enter Street">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">City</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="dri_city" name="city" placeholder="Enter City">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">State/Province</label>
									<div class="col-sm-8">
										<select class="form-control1 state" id="state" name="state" placeholder="Enter State/Province" >';
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
									<label for="focusedinput" class="col-sm-2 control-label">Phone</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="phone" name="phone" placeholder="Enter Phone">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Alternate Phone</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="alt_phone" name="alt_phone" placeholder="Enter Alternate Phone">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Fax</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="fax" name="fax" placeholder="Enter Fax">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Social Security No</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="social_security_no" name="social_security_no" placeholder="Enter Social Security No">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Email Id</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="dri_email" name="email" placeholder="Enter Email">
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Default Payment Type</label>
									<div class="col-sm-8">
										<select class="form-control1 state" id="payment_type" name="payment_type" placeholder="Enter Default Payment Type" >';
										<?php foreach($payment_type as $data1): ?>
										    <option value="<?php echo $data1['payment_type_id'] ?>" <?php echo $data1['default'] ?>><?php echo $data1['payment_mode'] ?></option>';
											<?php endforeach; ?>
										</select>
								    </div>
									
								</div>

								<div class="form-group load_pay" style="display:none">
									<label for="focusedinput" class="col-sm-2 control-label">Load Pay %</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="load_pay_per" name="load_pay_per" placeholder="Enter Load Pay %">
								    </div>
									 </div>


									<div class="form-group pay_per_mile" style="display:none">
									<label for="focusedinput" class="col-sm-2 control-label">Loaded Mile Pay</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="loaded_mile_pay" name="loaded_mile_pay" placeholder="Enter Loaded Mile Pay">
								    </div>
									 </div>

									<div class="form-group pay_per_mile" style="display:none">
									<label for="focusedinput" class="col-sm-2 control-label">Empty Mile Pay</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="empty_mile_pay" name="empty_mile_pay" placeholder="Enter Empty Mile Pay">
								    </div>
									 </div>

									<div class="form-group pay_per_mile" style="display:none">
									<label for="focusedinput" class="col-sm-2 control-label">Free Miles Range</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="free_mile_range" name="free_mile_range" placeholder="Enter Free Miles Range">
								    </div>
									 </div>


									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">License number</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="license_number" name="license_number" placeholder="Enter License number">
								    </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">License Expiration</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="lic_exp" name="lic_exp" placeholder="Enter License Expiration" readonly>
								    </div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">License issuing state/jurisdiction</label>
									<div class="col-sm-8">
										<select class="form-control1 state" id="lic_iss_state" name="lic_iss_state" placeholder="Enter License issuing state/jurisdiction" >';
										<?php foreach($result as $data1): ?>
										    <option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										</select>
								    </div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Medical Card Renewal</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="medical_card_renewal" name="medical_card_renewal" placeholder="Enter Medical Card Renewal" >
								    </div>
									 </div>

									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hire Date</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="hire_date" name="hire_date" placeholder="Enter Hire Date" readonly>
								    </div>
									 </div>

									<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Termination Date</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="termination_date" name="termination_date" placeholder="Enter Termination Date" readonly>
								    </div>
									 </div>

									  <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Bank Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="bank_name" name="bank_name" placeholder="Enter Bank Name">
								    </div>
									<div class="col-sm-2">
										<p class="help-block">Your Bank Account Details</p>
									</div>
									
								</div>


								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Routing No</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="routing_no" name="routing_no" placeholder="Default Input">
								    </div>
									<div class="col-sm-2">
										<p class="help-block">Your Bank Account Details</p>
									</div>
									
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Account No</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="account_no" name="account_no" placeholder="Default Input">
								    </div>
									<div class="col-sm-2">
										<p class="help-block">Your Bank Account Details</p>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Emergency Contact 1</label>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_name1" name="contact_name[]" placeholder="Enter Contact Name" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Phone</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_phone1" name="contact_phone[]" placeholder="Enter Contact Phone" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact1" name="contact[]" placeholder="Enter Contact" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Street</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_street1" name="contact_street[]" placeholder="Enter Contact Street" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact City</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_city1" name="contact_city[]" placeholder="Enter Contact City" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact State</label>
									<div class="col-sm-8">
										<select class="form-control1 state" id="contact_state1" name="contact_state[]" placeholder="Enter Contact State" >';
										<?php foreach($result as $data1): ?>
										    <option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										</select>
								    </div>
									
								</div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Zip Code</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_zip_code1" name="contact_zip_code[]" placeholder="Enter Contact Zip Code" >
								 </div>
								  </div>


								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Emergency Contact 2</label>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_name2" name="contact_name[]" placeholder="Enter Contact Name" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Phone</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_phone2" name="contact_phone[]" placeholder="Enter Contact Phone" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact2" name="contact[]" placeholder="Enter Contact" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Street</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_street2" name="contact_street[]" placeholder="Enter Contact Street" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact City</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_city2" name="contact_city[]" placeholder="Enter Contact City" >
								 </div>
								  </div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact State</label>
									<div class="col-sm-8">
										<select class="form-control1 state" id="contact_state2" name="dri_contact_state[]" placeholder="Enter Contact State" >';
										<?php foreach($result as $data1): ?>
										    <option value="<?php echo $data1['state_id'] ?>" ><?php echo $data1['state_name'] ?></option>';
											<?php endforeach; ?>
										</select>
								    </div>
									
								</div>

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Zip Code</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="contact_zip_code2" name="contact_zip_code[]" placeholder="Enter Contact Zip Code" >
								 </div>
								  </div>



								<div class="form-group">
								<button type="button" class="btn btn-success" onclick="save_driver_data()">Save</button>
								<button type="button" class="btn btn-info" onclick="canceldriverform()">Cancel</button>
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
    
	$('#lic_exp').datepicker({
      dateFormat: 'mm-dd-yy'
});

$('#medical_card_renewal').datepicker({
      dateFormat: 'mm-dd-yy'
});

$('#hire_date').datepicker({
      dateFormat: 'mm-dd-yy'
});

$('#termination_date').datepicker({
      dateFormat: 'mm-dd-yy'
});
    
  } );
</script>


<script>
					function show_driver_form(id1,id2){
						first_id=id1;
						second_id=id2;
						$(".trip_form").hide();
						$(".vehicle_form").hide();

						$(".driver_form").show();
						$( "#driver_name").focus();
					}

					function canceldriverform(){
						$(".trip_form").show();
						$(".driver_form").hide();
					}

					function save_driver_data(){
						var driver_name=$( "#driver_name").val();
						var street=$( "#dri_street").val();
						var city=$( "#dri_city").val();
						var state=$( "#state").val();
						var zip_code=$( "#zip_code").val();
						var phone=$( "#phone").val();
						var alt_phone=$( "#alt_phone").val();
						var fax=$( "#fax").val();
						var social_security_no=$( "#social_security_no").val();
						var email=$( "#dri_email").val();
						var payment_type=$( "#payment_type").val();
						var license_number=$( "#license_number").val();
						var lic_exp=$( "#lic_exp").val();
						var lic_iss_state=$( "#lic_iss_state").val();
						var medical_card_renewal=$( "#medical_card_renewal").val();
						var hire_date=$( "#hire_date").val();
						var termination_date=$( "#termination_date").val();
						var bank_name=$( "#bank_name").val();
						var routing_no=$( "#routing_no").val();
						var account_no=$( "#account_no").val();
						var contact_name = $('input[name="contact_name[]"]').map(function(){
										   return this.value
									   }).get();

						var contact_phone = $('input[name="contact_phone[]"]').map(function(){
										   return this.value
									   }).get();


						var contact = $('input[name="contact[]"]').map(function(){
										   return this.value
									   }).get();


						var contact_street = $('input[name="contact_street[]"]').map(function(){
										   return this.value
									   }).get();

						var contact_city = $('input[name="contact_city[]"]').map(function(){
										   return this.value
									   }).get();


						/**var contact_state = $('input[name="dri_contact_state[]"]').map(function(){
										   return this.value
									   }).get();**/
									   var contact_state = [$( "#contact_state1").val(), $( "#contact_state2").val()];


										  // alert(contact_state);

						var contact_zip_code = $('input[name="contact_zip_code[]"]').map(function(){
										   return this.value
									   }).get();

										 //  alert(contact_name);
						
						//alert(customer_name);

						//var status=$( "#"+id ).val();
						var postData = {
								"driver_name" : driver_name,
								"street" : street,
									"city" : city,
								"state" : state,
									"zip_code" : zip_code,
								"phone" : phone,
									"alt_phone" : alt_phone,
									"fax" : fax,
									"social_security_no" : social_security_no,
									"email" : email,
									"payment_type" : payment_type,
									"license_number" : license_number,
									"lic_exp" : lic_exp,
									"lic_iss_state" : lic_iss_state,
									"medical_card_renewal" : medical_card_renewal,
									"hire_date" : hire_date,
									"termination_date" : termination_date,
									"bank_name":bank_name,
									"routing_no" : routing_no,
									"account_no" : account_no,
									"contact_name" : contact_name,
									"contact_phone" : contact_phone,
									"contact" : contact,
									"contact_street" : contact_street,
									"contact_city" : contact_city,
									"contact_state" : contact_state,
									"contact_zip_code" : contact_zip_code
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/master/save_driver_data',
							data: postData,
							success: function(data){
								//alert(data);
								if($.trim(data)>=1){
									$( "#driver_name").val("");
						$( "#street").val("");
						$( "#city").val("");
						$( "#state").val("");
						$( "#zip_code").val("");
						$( "#phone").val("");
						$( "#alt_phone").val("");
						
						$(".trip_form").show();
						$(".driver_form").hide();
						$( "#"+first_id).focus();
									$( "#"+first_id).val(driver_name);
									$( "#"+second_id).val($.trim(data));

						


								} else{
									alert('Errror in saving driver data. Please try again after sometime.');
								}
							}
						});
					}

					$( function() {
					$("select").chosen();
					
					$(".customer_form").hide();
					$(".vehicle_form").hide();
					$(".driver_form").hide();
					$(".expensecatform").hide();
					})

					</script>

					<script>
					function show_expense_form(name,id){
						first_id=name;
					$(".trip_form").hide();
					$(".expensecatform").show();
					}

					function hide_expense_form(){
					$(".trip_form").show();
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
									$(".trip_form").show();
									$(".expensecatform").hide();
									//alert(first_id);
									$("#"+first_id).focus();
									getExpenseCategory($.trim(data),first_id);

									
									
								} else{
									alert('Errror in saving Expense Category data. Please try again after sometime.');
								}
							}
						});
					}



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
		$(document).ready(function(){ 
			//alert("hiii");
			$('.datep').datepicker({
      dateFormat: 'mm-dd-yy'
	});
			 }) 

		
		
		</script>