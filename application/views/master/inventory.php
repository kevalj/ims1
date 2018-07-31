<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Add Inventory Details :</h3>
                <div class="form-three widget-shadow">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/inventoryadd">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Select Inventory Type</label>
                                <?php //print_r($inventory_type); ?>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="inventory_type" id="inventory_type">
                                        <?php foreach ($inventory_type as $data1): ?>
                                            <option value="<?php echo $data1['inventory_type_id'] ?>"><?php echo $data1['inventory_name'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="inventory_no" name="inventory_no" placeholder="Enter Inventory Number    ">
                            </div>
                        </div>        
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Inventory Serial No</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="inventory_sr_no" name="inventory_sr_no" placeholder="Enter Inventory Serail Number">
                            </div>
                        </div>    

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="save"></button>
                            <a href="<?php echo base_url(); ?>index.php/master/view_inventory" class="btn btn-info">Cancel</a>
                            <button type="button" class="btn btn-info">Reset</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
