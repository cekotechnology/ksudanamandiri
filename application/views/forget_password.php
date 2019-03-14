<!DOCTYPE HTML>
<html class="full">

<head>
    <title>Tambang Hijau - Login</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="tambang hijau, gaharu" />
    <meta name="description" content="Tambang Hijau, PPOB and Gaharu">
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

    <!-- FACEBOOK WIDGET -->
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- /FACEBOOK WIDGET -->
    <div class="global-wrap">

        <div class="full-page">
            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-img" style="background-image:url(<?php echo base_url();?>asset/img/1280x852.png);"></div>
                <div class="bg-holder-content full text-white">
                    <a class="logo-holder" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url();?>asset/img/logo-white.png" alt="Logo tambang hijau" title="Logo tambang hijau" />
                    </a>
                    <div class="full-center">
                        <div class="container">
                            <div class="row row-wrap" data-gutter="60">
                                <div class="col-md-4">
                                    
                                </div>
								
                                <div class="col-md-4">
									<?php
									if($this->session->flashdata('result_reset_password')){
									?>
									<div class="alert alert-danger">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										<p class="text-small"><?php echo validation_errors(); ?>
										<?php echo $this->session->flashdata('result_reset_password'); ?></p>
                                        
                                    </div>
									<?php
									}
									?>
									
									<?php
									if($this->session->flashdata('result_reset_success')){
									?>
									<div class="alert alert-success">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										<p class="text-small">
										<?php echo $this->session->flashdata('result_reset_success'); ?></p>
                                        
                                    </div>
									<?php
									}
									?>
                                    <h3 class="mb15">Reset Password</h3>
                                    <?php echo form_open(base_url().'index.php/forget/request'); ?>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                            <label>Please input your valid no hp (registered)</label>
                                            <input class="form-control" name="username" placeholder="e.g. 628xxxxxx" type="number" required />
                                        </div>
                                        
                                        <input class="btn btn-primary" type="submit" value="Reset Password" />
										<div style="float:right"><a href="<?php echo base_url(); ?>" style="color:#e27513;" title="Back to login">Back to login</a></div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="footer-links">
                        <center>Copyright &copy; 2018 - tambanghijau.com. Allright reserved.</center>
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


