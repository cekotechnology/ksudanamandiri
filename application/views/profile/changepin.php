<div class="col-md-4 col-md-offset-1">
 <div style="color:#F00">
								<?php echo validation_errors(); ?>
								<?php echo $message; ?></div>
                            <h4>Change Pin</h4>
                            <form method="post" action="<?php echo base_url();?>index.php/profile/changepassword">
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>Current Pin</label>
                                    <input name="pass" class="form-control" type="password" autocomplete="off" required />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>New Pin</label>
                                    <input name="newpass" class="form-control" type="password" autocomplete="off" required />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>New Pin Again</label>
                                    <input name="newpass2" class="form-control" type="password"autocomplete="off" required />
                                </div>
                                <hr />
                                <input class="btn btn-primary" type="submit" value="Change Password" />
                            </form>
                        </div>