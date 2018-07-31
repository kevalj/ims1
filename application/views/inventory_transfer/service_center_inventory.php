<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Add Service Center Inventory :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/InventoryTransfer/service_center_inventory_add">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>
							

								<div class="form-group">
									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Service Center Name</b></label>
								    </div>

									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Machine Part Name</b></label>
								    </div>

									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Available Count</b></label>
								    </div>

									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Count</b></label>
								    </div>


									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>ADD/Remove</b></label>
								    </div>
                                 </div>

								 <div class="col-sm-12 element1" id='del_0'>
								 </div>

                              
								<div class="form-group">
								<input type="submit" class="btn btn-success" value="save"></button>
								<a href="<?php echo base_url(); ?>index.php/InventoryTransfer/view_project_inventory" class="btn btn-info">Cancel</a>
								<button type="button" class="btn btn-info">Reset</button>
								</div>

								
							</form>
						</div>
					</div>
					</div>
					</div>
					</div>

					<script>
					var i=0;

					function addrow(){

									// Finding total number of elements added
									i++;
								  var total_element = $(".element1").length;
 
								  // last <div> with element class id
								  var lastid = $(".element1:last").attr("id");
								  var split_id = lastid.split("_");
								  var nextindex = Number(split_id[1]) + 1;

								 
								   // Adding new div container after last occurance of element class
								   $(".element1:last").after("<div class='element1 form-group' id='del_"+ i +"'></div>");

								   var div="";

								   div=div+'<div class="col-sm-2">';
									div=div+'<select class="form-control1 service_center" name="service_center[]" id="service_center'+i+'" >';
											<?php foreach($service_center as $data1): ?>
											 div=div+'<option value="<?php echo $data1['project_service_center_id'] ?>"><?php echo $data1['service_center_name'] ?></option>';
											<?php endforeach; ?>
											
										 div=div+'</select>';

								    div=div+'</div>';

									
 
									div=div+'<div class="col-sm-2">';
									div=div+'<select class="form-control1 machine_parts" name="machine_parts[]" id="machine_parts'+i+'" >';
											<?php foreach($machine_parts as $data1): ?>
											 div=div+'<option value="<?php echo $data1['part_id'] ?>"><?php echo $data1['part_name'] ?></option>';
											<?php endforeach; ?>
											
										 div=div+'</select>';

								    div=div+'</div>';

									

									div=div+'<div class="col-sm-2">';
									div=div+'<input type="text" class="form-control1" id="available_count" name="available_count[]" placeholder="Available Count" readonly>';
								    div=div+'</div>';

									div=div+'<div class="col-sm-2">';
									div=div+'<input type="text" class="form-control1" id="count" name="count[]" placeholder="Enter Count" >';
								    div=div+'</div>';


									div=div+'<a href="#" onclick="addrow()" class="btn btn-info">ADD</a>';
									div=div+'<a href="#" onclick="deleterow(\'del_'+i+'\')" class="btn btn-info">Remove</a>';

									 

									//alert(div);
    $("#del_" + i).append(div);


$("select").chosen();
  }


  addrow();
			
			function deleterow(id){
			//	alert(id);
				$("#"+id).hide();
			}
					</script>