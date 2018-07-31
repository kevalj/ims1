<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Add User :</h3>
                <div class="form-three widget-shadow">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/master/useradd">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>


                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="user_name" name="user_name" placeholder="Enter User Name">
                            </div>
                        </div>        
                        
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Select User Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="user_type" id="user_type">
                                            <option value="1">Admin</option>
                                            <option value="2">Project User</option>
                                            <option value="3">POS User</option>
                                            <option value="4">Service Center User</option>
                                            
                                    </select>
                                </div>
                            </div>       


                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="save"></button>
                            <a href="<?php echo base_url(); ?>index.php/master/view_user" class="btn btn-info">Cancel</a>
                            <button type="button" class="btn btn-info">Reset</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
