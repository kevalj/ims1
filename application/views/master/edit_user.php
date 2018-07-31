<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="row">
                <h3 class="title1">Edit User Details :</h3>
                <div class="form-three widget-shadow">
                    <form action="<?php echo base_url(); ?>index.php/master/useredit" method="post" class="form-horizontal">

                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo validation_errors(); ?></strong> 
                        </div>
                        <?php foreach ($result as $data): ?>
                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">User Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="user_name" name="user_name" placeholder="Enter User Name" value="<?php echo $data['user_name'] ?>">
                                </div>
                            </div>
                           <!-- <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Login Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="login_name" name="login_name" placeholder="Enter Login Name" value="<?php echo $data['user_name'] ?>">
                                </div>
                            </div>-->
                            <!--<div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="password" name="password" placeholder="Enter Password" value="<?php echo $data['password'] ?>">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Select Gender</label>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="gender" id="gender">
                                            <?php $selected = "";
                                                  $selected1 = "";
                                            ?>
                                            <?php
                                            if ($data['gender'] == 'M') {
                                                $selected = "selected";
                                            }
                                            ?>
                                            <option value="M" <?php echo $selected; ?>>Male</option>
                                                                                        <?php
                                            if ($data['gender'] == 'F') {
                                                $selected1 = "selected";
                                            }
                                            ?>
                                            <option value="F" <?php echo $selected1; ?>>Female</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">eMail Id</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="email" name="email" placeholder="Enter email Id" value="<?php echo $data['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Select Role for User</label>
                                <div class="col-sm-8">
                                    <select class="form-control1" name="user_role" id="user_role">
                                        <?php foreach ($user_role as $data1): ?>
                                            <?php $selected = ""; ?>
                                            <?php
                                            if ($data['role_id'] == $data1['role_id']) {
                                                $selected = "selected";
                                            }
                                            ?>
                                            <option value="<?php echo $data1['role_id'] ?>" <?php echo $selected; ?>><?php echo $data1['role_name'] ?></option>

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
                                    <input type="hidden" class="form-control1" name="user_master_id" id="user_master_id" value="<?php echo $data['id'] ?>" placeholder="Default Input">
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save">
                                <a href="<?php echo base_url(); ?>index.php/master/view_user" class="btn btn-info">Cancel</a>
                                <button type="button" class="btn btn-info">Reset</button>
                            </div>


                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
