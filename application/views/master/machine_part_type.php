<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Add Machine Part Type :</h3>
                <div class="form-three widget-shadow">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/machineparttypeadd">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>


                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Machine Part Type Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="machine_part_type_name" name="machine_part_type_name" placeholder="Enter Machine Part Type Name">
                            </div>
                        </div>        


                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="save"></button>
                            <a href="<?php echo base_url(); ?>index.php/master/view_machine_part_type" class="btn btn-info">Cancel</a>
                            <button type="button" class="btn btn-info">Reset</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
