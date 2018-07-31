<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Edit Inventory Details :</h3>
                <div class="form-three widget-shadow">
                    <form action="<?php echo base_url(); ?>index.php/master/inventoryedit" method="post" class="form-horizontal">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>
                        <?php foreach ($result as $data): ?>
                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Inventory Type Name</label>
                               <div class="col-sm-8">
                                    <select class="form-control1" name="inventory_type_id" id="inventory_type_id">
                                        <?php foreach ($inventory_type as $data1): ?>
                                        <?php $selected = ""; ?>
                                            <?php
                                            if ($data['inventory_type_id'] == $data1['inventory_type_id']) {
                                                $selected = "selected";
                                            }
                                            ?>
                                            <option value="<?php echo $data1['inventory_type_id'] ?>" <?php echo $selected; ?>><?php echo $data1['inventory_name'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                        
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="inventory_no" name="inventory_no" placeholder="Enter Inventory Number    "  value="<?php echo $data['inventory_no'] ?>">
                            </div>
                        </div>        
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory Serial No</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="inventory_sr_no" name="inventory_sr_no" placeholder="Enter Inventory Serial Number"  value="<?php echo $data['inventory_sr_no'] ?>">
                            </div>
                        </div>    


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Select Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="status" id="status">
                                        <?php foreach ($status as $data2): ?>
                                            <?php $selected = ""; ?>
                                            <?php
                                            if ($data['status'] == $data2['status_code']) {
                                                $selected = "selected";
                                            }
                                            ?>
                                            <option value="<?php echo $data2['status_code'] ?>" <?php echo $selected; ?>><?php echo $data2['status_name'] ?></option>

                                        <?php endforeach; ?>

                                    </select>
                                    <input type="hidden" class="form-control1" name="inventory_master_id" id="inventory_master_id" value="<?php echo $data['inventory_master_id'] ?>" placeholder="Default Input">
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save">
                                <a href="<?php echo base_url(); ?>index.php/master/view_inventory" class="btn btn-info">Cancel</a>
                                <button type="button" class="btn btn-info">Reset</button>
                            </div>


                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
