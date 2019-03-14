<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$this -> load -> library('Mobile_Detect');
$detect = new Mobile_Detect();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title><?= $page_title; ?></title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    
    

    <meta name="author" content="Tsoy">
	<link href="https://getbootstrap.com/docs/4.0/assets/css/docs.min.css" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- BARU -->
     <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700|Material+Icons">-->
    <!-- /END BARU -->
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/mystyles.css">
    <!-- BARU -->
	 <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
	 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<!-- /END BARU -->
    <script src="<?php echo base_url();?>asset/js/modernizr.js"></script>

	
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bd52e1f476c2f239ff65130/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<body style="overflow: scroll;
-webkit-overflow-scrolling: touch">

    
    <div class="global-wrap">
        <header id="main-header">
            <?= $this->load->view('include/header'); ?>
            <?= $this->load->view('include/top_menu'); ?>
        </header>

        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= base_url(); ?>">Home</a>
                </li>
                <li><a href="#">Dashboard</a>
                </li>
              
                <li class="active">&nbsp;</li>
            </ul>
        </div>




        <div class="container">
            <div class="row">
                <?php
                if($detect->isMobile()){
                ?>
                <?= $this->load->view('include/left_menu'); ?>
                <div class="col-md-12">
                    <?php echo $content;?>
                </div>
                <?php
                } else {
                ?>
                <?= $this->load->view('include/left_menu'); ?>
                
                
                <div class="col-md-9">
                    <?php echo $content;?>
                </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>



        <div class="gap"></div>
        <footer id="main-footer">
            <?= $this->load->view('include/footer'); ?>
        </footer>
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
	
	<script src="<?php echo base_url();?>asset/js/typeahead.js"></script>
	<script src="<?php echo base_url();?>asset/js/card-payment.js"></script>
	<script src="<?php echo base_url();?>asset/js/magnific.js"></script>
	<script src="<?php echo base_url();?>asset/js/owl-carousel.js"></script>
	<script src="<?php echo base_url();?>asset/js/fitvids.js"></script>
	<script src="<?php echo base_url();?>asset/js/tweet.js"></script>
	<script src="<?php echo base_url();?>asset/js/countdown.js"></script>
	<script src="<?php echo base_url();?>asset/js/gridrotator.js"></script>
	<script src="<?php echo base_url();?>asset/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <!-- BARU -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>-->
    <!-- /END BARU -->
    <script type="text/javascript">

    window.setInterval(ut, 1000);
    
    function ut() {
      var d = new Date();
      document.getElementById("time").innerHTML = d.toLocaleTimeString();
      document.getElementById("date").innerHTML = d.toLocaleDateString();
    }
    
    $(function () {
          $("#datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true
          }).datepicker('update', new Date());
        });
    </script>
    </div>
</body>

</html>


