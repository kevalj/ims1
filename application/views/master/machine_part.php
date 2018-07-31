<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Add Machine Part Count :</h3>
                <div class="form-three widget-shadow">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/machinepartadd">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Select Machine Part Type</label>
                                <?php //print_r($inventory_type); ?>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="machine_part_type_id" id="machine_part_type_id">
                                        <?php foreach ($machine_part_type as $data1): ?>
                                            <option value="<?php echo $data1['part_id'] ?>"><?php echo $data1['part_name'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Machine Part Count</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="machine_part_count" name="machine_part_count" placeholder="Enter Machine Part Count    ">
                            </div>
                        </div>    

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="save"></button>
                            <a href="<?php echo base_url(); ?>index.php/master/view_machine_part" class="btn btn-info">Cancel</a>
                            <button type="button" class="btn btn-info">Reset</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
