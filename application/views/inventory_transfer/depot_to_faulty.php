<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
<div class="row">
						<h3 class="title1">Faulty Inventory :</h3>
						<div class="form-three widget-shadow">
							<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/InventoryTransfer/depot_to_faulty_add">
								
								<div class="alert alert-danger" role="alert">
									<strong><?php echo validation_errors(); ?></strong> 
								</div>

								<div class="form-group">
									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Division Name</b></label>
								    </div>

									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Machine No.</b></label>
								    </div>

									

									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Nature Of Complaint</b></label>
								    </div>

									<!--<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>Comment</b></label>
								    </div>-->

									<div class="col-sm-2">
									<label for="focusedinput" class=" control-label"><b>ADD/Remove</b></label>
								    </div>
                                 </div>

								 <div class="col-sm-12 element1" id='del_0'>
								 </div>


								
							


                              
								<div class="form-group">
								<input type="submit" class="btn btn-success" value="save"></button>
								<a href="<?php echo base_url(); ?>index.php/InventoryTransfer/view_depot_inventory" class="btn btn-info">Cancel</a>
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
					function unablereason(){
							var reason=$("#reason option:selected").val();
							 if(reason == "55"){
									 $("#other_reason").attr("readonly", false); 
								 }
								 else{ 
									 $("#other_reason").attr("readonly", true); 
									 $("#other_reason").val("");
								 }
								
								
							}



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
									div=div+'<select class="form-control1 depot" name="depot[]" id="depot'+i+'" onchange="getDepotData('+i+'),getServiceCenterData('+i+')">';
									div=div+'<option value="0">Select</option>';
											<?php foreach($division as $data1): ?>
											 div=div+'<option value="<?php echo $data1['project_pos_details_id'] ?>"><?php echo $data1['pos_name'] ?></option>';
											<?php endforeach; ?>
											
										 div=div+'</select>';

								    div=div+'</div>';

									div=div+'<div class="col-sm-2">';
									div=div+'<select class="form-control1 inventory" name="inventory[]" id="inventory'+i+'">';
									div=div+'</select>';

								    div=div+'</div>';
 
									

									div=div+'<div class="col-sm-2">';
									div=div+'<select class="form-control1 reason" name="reason[]" id="reason" >';
											<?php foreach($reason as $data1): ?>
											 div=div+'<option value="<?php echo $data1['reason_id'] ?>"><?php echo $data1['stCategoryReasonName'] ?></option>';
											<?php endforeach; ?>
											
										 div=div+'</select>';

								    div=div+'</div>';

								//	div=div+'<div class="col-sm-2">';
								//	div=div+'<input type="text" class="form-control1" id="other_reason" name="other_reason[]" placeholder="Enter Other Reason" readonly>';
								  //  div=div+'</div>';


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


			function getDepotData(id){
				//alert(id)
							var depot=$("#depot"+i+" option:selected").val();
							var postData = {
								"depot" : depot
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/InventoryTransfer/getDivisionInventory',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var string="";
								for(var i=0;i<obj.data.length;i++){
									
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][2]+'</option>';
									
									
								}
								//alert('#inventory'+id);
								$('#inventory'+id)
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								
							}
						});

					}


					function getServiceCenterData(id){
				//alert(id)
							var depot=$("#depot"+i+" option:selected").val();
							var postData = {
								"depot" : depot
								
							};
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>index.php/InventoryTransfer/getDepotServiceCenter',
							data: postData,
							success: function(data){
								console.log(data);
								var obj = JSON.parse(data);
								var string="";
								for(var i=0;i<obj.data.length;i++){
									
										string=string+'<option  value="'+obj.data[i][0]+'">'+obj.data[i][1]+'</option>';
									
									
								}
								//alert('#inventory'+id);
								$('#service_center'+id)
										.empty()
										.append(string);
								$("select").chosen();
								$('select').trigger("chosen:updated");
								
							}
						});

					}

					</script>