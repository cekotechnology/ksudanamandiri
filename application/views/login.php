<?php
$this -> load -> library('Mobile_Detect');
$detect = new Mobile_Detect();
?>
<!DOCTYPE HTML>
<html class="full">

<head>
    <title>KSU Danamandiri - Login</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="e-naco, gaharu" />
    <meta name="description" content="ksu-danamandiri">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/mystyles.css">
    <script src="<?php echo base_url();?>asset/js/modernizr.js"></script>


</head>

<body class="full" style="overflow: scroll;
-webkit-overflow-scrolling: touch">

   
    <div class="global-wrap">

        <div class="full-page">
            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-img" style="background-image:url(<?php echo base_url();?>asset/img/1280x852.png);"></div>
                <div class="bg-holder-content full text-white">
                    <a class="logo-holder" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url();?>asset/img/logo-white.png" alt="Logo KSU Danamandiri" title="Logo KSU Danamandiri" />
                    </a>
                    <div class="full-center">
                        
                        <?php
                            if($detect->isMobile()){
                        ?>
                        
                        <div class="container">
                            <div class="row row-wrap" data-gutter="60">
                                
                                
                                <div class="col-md-12">
									<?php
									if($this->session->flashdata('result_login')){
									?>
									<div class="alert alert-danger">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										<p class="text-small"><?php echo validation_errors(); ?>
										<?php echo $this->session->flashdata('result_login'); ?></p>
                                        
                                    </div>
									<?php
									}
									?>
                                    <h3 class="mb15">Member Login</h3>
                                    <?php echo form_open(base_url().'login'); ?>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                            <label>No KTP (16 digit)</label>
                                            <input class="form-control" name="userloginx" placeholder="e.g. 628123912345" type="number" required />
                                        </div>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                            <label>Password</label>
                                            <input class="form-control" name="passloginx" type="password" placeholder="my secret password" required />
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Sign in" /> 
                                        <div style="float:right"><a href="<?php echo base_url(); ?>forget" style="color:#e27513;" title="Forget your password?">Forget Password?</a></div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                            } else {
                        ?>
                        
                        <div class="container">
                            <div class="row row-wrap" data-gutter="60">
                                
                                
                                
                                <div class="col-md-4">
                                    
                                </div>
								
                                <div class="col-md-4">
									<?php
									if($this->session->flashdata('result_login')){
									?>
									<div class="alert alert-danger">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										<p class="text-small"><?php echo validation_errors(); ?>
										<?php echo $this->session->flashdata('result_login'); ?></p>
                                        
                                    </div>
									<?php
									}
									?>
                                    <h3 class="mb15">Member Login</h3>
                                    <?php echo form_open(base_url().'login'); ?>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                            <label>No KTP (16 digit)</label>
                                            <input class="form-control" name="userloginx" placeholder="e.g. 628123912345" type="number" required />
                                        </div>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                            <label>Password</label>
                                            <input class="form-control" name="passloginx" type="password" placeholder="my secret password" required />
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Sign in" /> 
                                        <div style="float:right"><a href="<?php echo base_url(); ?>forget" style="color:#e27513;" title="Forget your password?">Forget Password?</a></div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            if($detect->isMobile()){
                        ?>
                        
                        <div class="container">
                            
                            <!--<div class="col-md-12">
                                <div class="alert alert-info">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										
							    </div>
							 </div>-->
							
                            
                        </div>
                        
                        <?php
                            } else {
                        ?>
                        <div class="container">
                            <div class="col-md-4">
                                    
                            </div>
                            <!--<div class="col-md-4">
                                <div class="alert alert-info">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										
							    </div>
							 </div>-->
							<div class="col-md-4">
                                    
                            </div>
                            
                        </div>
                        <?php
                            }
                        ?>
                        
                    </div>
                    <ul class="footer-links">
                        <center>Copyright &copy; 2018 - ksudanamandiri.com. Allright reserved.</center>
                    </ul>
                </div>
            </div>
        </div>



        <script src="<?php echo base_url();?>asset/js/jquery.js"></script>
        <script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>asset/js/slimmenu.js"></script>
        <script src="<?php echo base_url();?>asset/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url();?>asset/js/bootstrap-timepicker.js"></script>
        <script src="<?php echo base_url();?>asset/js/nicescroll.js"></script>
        <script src="<?php echo base_url();?>asset/js/dropit.js"></script>
        <script src="<?php echo base_url();?>asset/js/ionrangeslider.js"></script>
        <script src="<?php echo base_url();?>asset/js/icheck.js"></script>
        <script src="<?php echo base_url();?>asset/js/fotorama.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="<?php echo base_url();?>asset/js/typeahead.js"></script>
        <script src="<?php echo base_url();?>asset/js/card-payment.js"></script>
        <script src="<?php echo base_url();?>asset/js/magnific.js"></script>
        <script src="<?php echo base_url();?>asset/js/owl-carousel.js"></script>
        <script src="<?php echo base_url();?>asset/js/fitvids.js"></script>
        <script src="<?php echo base_url();?>asset/js/tweet.js"></script>
        <script src="<?php echo base_url();?>asset/js/countdown.js"></script>
        <script src="<?php echo base_url();?>asset/js/gridrotator.js"></script>
        <script src="<?php echo base_url();?>asset/js/custom.js"></script>
    </div>
</body>

</html>


