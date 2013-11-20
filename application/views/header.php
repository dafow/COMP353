<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Welcome to XXX ConfSys</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/main.css">

        <script src="<?php echo base_url();?>/assets/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">SEMS ConfSys</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
          </ul>
		  <?php if ($this->session->userdata('logged_in') == false) { ?>
			  <form class="navbar-form navbar-right" action="<?php echo site_url('User/login'); ?>">
				<div class="form-group">
				  <input type="text" name="username" placeholder="Username" class="form-control">
				</div>
				<div class="form-group">
				  <input type="password" name="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Log In</button>
			  </form>
			  <form class="navbar-form navbar-right" action="<?php echo site_url('User/register_email'); ?>">
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Register</button>
				</div>
			  </form>
		  <?php } else { ?>
			  <form class="navbar-form navbar-right" action="<?php echo site_url('User/logout'); ?>">
				<div class="form-group">
					<p>Welcome, <?php echo $this->session->userdata('first_name') ?>
					<button type="submit" class="btn btn-failure">Log Out</button>
				</div>
			  </form>
		  <?php } ?>
        </div><!--/.navbar-collapse -->
      </div>
    </div>