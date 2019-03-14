<!DOCTYPE HTML>
<html>

<head>
    <title>Login - TambangHijau.com</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/mystyles.css">
    <script src="<?php echo base_url();?>asset/js/modernizr.js"></script>

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
</head>

<body>

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
        <header id="main-header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="logo" href="../">
                                <img src="<?php echo base_url();?>asset/img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </div>
                        <div class="col-md-3 col-md-offset-2">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="top-user-area clearfix">
                                <ul class="top-user-area-list list list-horizontal list-border">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li><a href="#">Welcome to Member Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

  



        <div class="container" align="center">
            <div class="row">
                <div class="col-md-3 col-md-offset-1"><div style="color:#F00"><?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_login'); ?></div>
                            <h4>&nbsp;</h4>
                            <?php echo form_open(base_url().'login/admin'); ?>
                            
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="userloginx" id="userlogin" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label> Password</label>
                                    <input class="form-control" type="password" name="passloginx" id="passlogin" />
                                </div>
                               
                                <hr />
                                <input class="btn btn-primary" type="submit" value="LOGIN" />
                           
                        </div>
            </div>
        </div>



        <div class="gap"></div>
        <footer id="main-footer">
            <div class="container">
                <div class="row row-wrap">
                    <div class="col-md-3">
                        <a class="logo" href="../">
                            <img src="<?php echo base_url();?>asset/img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                        </a>
                        <p class="mb20">TambangHijau adalah perusahaan  yang akan memberikan kemudahan dan keuntungan Rutin untuk Anda.</p>
                        <ul class="list list-horizontal list-space">
                            <li>
                                <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-pinterest box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-2">
                        <ul class="list list-footer">
                            <li><a href="#">Home</a>
                            </li>
                            <li><a href="#">About</a>
                            </li>
                            <li><a href="#">Faq</a>
                            </li>
                            <li><a href="#">Contact us</a>
                            </li>
                           
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p>OnPartner Official</p>
                        <p class="text-color">+6221 000-0000</p>
                        <p><a href="#" class="text-color">support@tambanghijau.com</a></p>
                        <p>24/7 Layanan Support Online</p>
                    </div>

                </div>
            </div>
        </footer>

        
    </div>
</body>

</html>


