<div class="col-md-7 col-md-offset-0">
 <div style="color:#F00">
								<?php echo validation_errors(); ?>
								<?php echo $message; ?></div>
                            <h4>Change Password</h4>
                            <?php echo $result; ?>
                            <form method="post" action="<?php echo base_url();?>index.php/profile/changepassword">
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>Current Password</label>
                                    <input name="pass" class="form-control" type="password" autocomplete="off" required />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>New Password</label>
                                    <input name="newpass" maxlength="6" class="form-control" type="password" autocomplete="off" required />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>New Password Again</label>
                                    <input name="newpass2" maxlength="6" class="form-control" type="password"autocomplete="off" required />
                                </div>
                                <hr />
                                <input class="btn btn-primary" type="submit" value="Change Password" />
                            </form>
                        </div>