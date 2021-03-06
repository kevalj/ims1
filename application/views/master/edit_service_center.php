<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Edit Service Center :</h3>
                <div class="form-three widget-shadow">
                    <form action="<?php echo base_url(); ?>index.php/master/servicecenteredit" method="post" class="form-horizontal">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>
                        <?php foreach ($result as $data): ?>
                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Service Center Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="service_center_name" name="service_center_name" placeholder="Enter Service Center Name" value="<?php echo $data['service_center_name'] ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Select Division</label>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="project" id="project" multiple>
                                        <?php foreach ($project as $data2): ?>
										 <?php $selected = ""; ?>
										 <?php foreach ($result1 as $data3): ?>
                                           
                                            <?php
                                            if ($data3['division_id'] == $data2['project_pos_details_id']) {
                                                $selected = "selected";
                                            }
                                            ?>
											 <?php endforeach; ?>
                                            <option value="<?php echo $data2['project_pos_details_id'] ?>" <?php echo $selected; ?>><?php echo $data2['pos_name'] ?></option>

                                       
										<?php endforeach; ?>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Select Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="status" id="status">
                                        <?php foreach ($status as $data1): ?>
                                            <?php $selected = ""; ?>
                                            <?php
                                            if ($data['status'] == $data1['status_code']) {
                                                $selected = "selected";
                                            }
                                            ?>
                                            <option value="<?php echo $data1['status_code'] ?>" <?php echo $selected; ?>><?php echo $data1['status_name'] ?></option>

                                        <?php endforeach; ?>

                                    </select>
                                    <input type="hidden" class="form-control1" name="project_service_center_id" id="project_service_center_id" value="<?php echo $data['project_service_center_id'] ?>" placeholder="Default Input">
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save">
                                <a href="<?php echo base_url(); ?>index.php/master/view_service_center" class="btn btn-info">Cancel</a>
                                <button type="button" class="btn btn-info">Reset</button>
                            </div>


                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
