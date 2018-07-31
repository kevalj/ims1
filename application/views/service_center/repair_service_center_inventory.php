<div id="page-wrapper">
    <div class="main-page"> 
        <div class="forms">
            <div class="row">
                <h3 class="title1">Repair Service Center Inventory:</h3>
                <div class="form-three widget-shadow">
                    <form action="<?php echo base_url(); ?>index.php/ServiceCenter/update_repair_service_center_inventory" method="post" class="form-horizontal" id="target">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>
                        <?php foreach ($result as $data): ?>

							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory Type</label>
                            <div class="col-sm-8">
							<label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['inventory_name'] ?></label>
                             </div>
							</div>  
							
							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory No</label>
                            <div class="col-sm-8">
                                <label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['inventory_no'] ?></label>
                            </div>
							</div> 

							

							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory Serial No</label>
                            <div class="col-sm-8">
                                <label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['inventory_sr_no'] ?></label>
                            </div>
							</div> 

							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Region Name</label>
                            <div class="col-sm-8">
                                <label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['region'] ?></label>
                            </div>
							</div> 

							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-8">
                                <label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['division'] ?></label>
                            </div>
							</div>

							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Depot Name</label>
                            <div class="col-sm-8">
                                <label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['depot_name'] ?></label>
                            </div>
							</div>
							
							<div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Nature of Defect from Depot</label>
                            <div class="col-sm-8">
                                <label for="focusedinput" class="col-sm-8 control-label"><?php echo $data['stCategoryReasonName'] ?></label>
                            </div>
							</div>

							<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nature of Defect from Service Center</label>
									<div class="col-sm-8">
										<select class="form-control1" name="reason" id="reason" >
											<?php foreach($reason as $data1): ?>
											
											<option value="<?php echo $data1['reason_id'] ?>"><?php echo $data1['stCategoryReasonName'] ?></option>
											
											<?php endforeach; ?>
											
										</select>
								    </div>
                                 </div>
								 
								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Enter Comment</label>
									<div class="col-sm-8">
									<input type="text" class="form-control1" name="other_reason" id="other_reason" value="" placeholder="Enter Other Reason" >
									
									</div>
                                 </div> 

								 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Machine Parts Used</label>
									<div class="col-sm-8">
									<select class="form-control1 machine_parts" name="machine_parts[]" id="machine_parts" multiple>
									
											<?php foreach($machine_parts as $data1): ?>
											<option value="<?php echo $data1['part_id'] ?>"><?php echo $data1['part_name'] ?></option>
											<?php endforeach; ?>
											
										</select>
									
									</div>
                                 </div> 

								 




                                    <input type="hidden" class="form-control1" name="faultyId" id="faultyId" value="<?php echo $data['faultyId'] ?>" placeholder="Default Input">
                                     <input type="hidden" class="form-control1" name="faultymasterid" id="faultymasterid" value="<?php echo $data['faultymasterid'] ?>" placeholder="Default Input">
                            

                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save" >
                                <a href="<?php echo base_url(); ?>index.php/ServiceCenter/view_service_center_inventory" class="btn btn-info">Cancel</a>
                                <button type="button" class="btn btn-info">Reset</button>
                            </div>


                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var arr = new Array();



											<?php foreach($stockcount as $data1): ?>
											arr[<?php echo $data1['part_id'] ?>] = '<?php echo $data1['remcnt'] ?>';

											<?php endforeach; ?>
//console.log(arr);

function getcount(cnt,id){
	//console.log(arr);
	//console.log(arr[2]);
	//alert(arr[cnt]);
	$("#available_count"+id).val(arr[cnt]);
}

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
									div=div+'<select class="form-control1 machine_parts" name="machine_parts[]" id="machine_parts'+i+'" onchange="getcount(this.value,'+i+')">';
									div=div+'<option value="0">Select</option>';
											<?php foreach($machine_parts as $data1): ?>
											 div=div+'<option value="<?php echo $data1['part_id'] ?>"><?php echo $data1['part_name'] ?></option>';
											<?php endforeach; ?>
											
										 div=div+'</select>';

								    div=div+'</div>';

									

									div=div+'<div class="col-sm-2">';
									div=div+'<input type="text" class="form-control1 available_count" id="available_count'+i+'" name="available_count[]" placeholder="Available Count" readonly>';
								    div=div+'</div>';

									div=div+'<div class="col-sm-2">';
									div=div+'<input type="text" class="form-control1 count" id="count'+i+'" name="count[]" placeholder="Enter Count" onblur="validateCount('+i+')">';
								    div=div+'</div>';


									div=div+'<a href="#" onclick="addrow()" class="btn btn-info">ADD</a>';
									div=div+'<a href="#" onclick="deleterow(\'del_'+i+'\')" class="btn btn-info">Remove</a>';

									 

									//alert(div);
    $("#del_" + i).append(div);


$("select").chosen();
  }


  //addrow();

  function validateCount(id){
	  //alert(id);
	  var arradded = new Array();
	  var i=1;
	  //arr[cnt]
	  $(".machine_parts").each(function () {

			//alert($(this).val());
			//console.log(arradded[$(this).val()]);
			if(typeof arradded[$(this).val()]!='undefined'){
				//console.log('1');
			arradded[$(this).val()]=arradded[$(this).val()]+parseInt($("#count"+id).val());
			}else{
				//console.log('2');
				arradded[$(this).val()]=parseInt($("#count"+id).val());
			}
			i++;

		})

			//alert($("#machine_parts"+id).val());

			if(arradded[$("#machine_parts"+id).val()]>arr[$("#machine_parts"+id).val()]){
			$("#count"+id).val("0");
			}
			//alert(isNaN(parseInt($("#available_count"+id).val())));
			if(isNaN(parseInt($("#available_count"+id).val()))){
				console.log("in");
				$("#count"+id).val("0")
			}
			//console.log(arradded);
  }
			
			function deleterow(id){
			//	alert(id);
				$("#"+id).hide();
			}

			function validatedata(){
				var flag=0;
				$(".count").each(function () {

			if(parseInt($(this).val())==0){
				flag=1;
				
			}

			if(flag==1){
				alert("Please enter valid used count value");
			}else{
				$("#target").submit()
			}

		})
			}
						

					

					</script>
