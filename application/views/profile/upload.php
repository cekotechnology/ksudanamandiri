<div class="col-md-7 col-md-offset-0">
 <div class="form-group row">
								<?php echo validation_errors(); ?>
								<?php echo $message; ?></div>
                            <h4>Upload Photo</h4>
                            <?php echo form_open_multipart(base_url().'profile/simpan'); ?>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>Choose Photo</label>
                                    <label for="fileField"></label>
                                  <input type="file" class="form-control" name="foto" id="foto" required />
                                </div>
                                
                                <hr />
                                <input class="btn btn-primary" type="submit" value="Upload" />
                            </form>
                        </div>