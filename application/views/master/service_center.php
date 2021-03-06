<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Add Service Center :</h3>
                <div class="form-three widget-shadow">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/servicecenteradd">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select Division</label>
                            <div class="col-sm-8">
                                <select class="form-control1" name="project[]" id="project" multiple>
                                    <?php foreach ($project as $data1): ?>

                                        <option value="<?php echo $data1['project_pos_details_id'] ?>"><?php echo $data1['pos_name'] ?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Service Center Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="service_center_name" name="service_center_name" placeholder="Enter Service Center Name">
                            </div>
                        </div>        


                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="save"></button>
                            <a href="<?php echo base_url(); ?>index.php/master/view_service_center" class="btn btn-info">Cancel</a>
                            <button type="button" class="btn btn-info">Reset</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
