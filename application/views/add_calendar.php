<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter User Registration Form Demo</title>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="<?php echo base_url("style/home.css"); ?>" rel="stylesheet" type="text/css" />
  
	</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="<?php echo base_url() ?>">Calendar Display</a></li>
   
      <li class="active"><a href="<?php echo base_url("/index.php/hello_future/import") ?>">import</a></li>
      <li><a href="<?php echo base_url("/index.php/hello_furture_tests/") ?>">Tests</a></li>
    </ul>
  </div>
</nav>
<div class="container col-md-12 ">
     <h1>Hello future App   </h1>
	 <div  id="message"></div>
	 <?php $attributes = array("id" => "ical_form","name" => "ical_post");
                echo form_open("hello_future/add_calendar", $attributes);?>
				

				  <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-default">add calendar (ics)</button>
                  
                </div>
      
    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script  type="text/javascript" src="<?php echo base_url("js/homepage.js"); ?>" ></script>
  
</body>
</html>