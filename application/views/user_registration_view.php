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
<div class="container col-md-12 ">
<div  class="col-md-6 col-md-offset-3">
	<img src="http://www.blubolt.com/wp-content/themes/blubolt-website/images/logo.png" title="blubolt" alt="blubolt"  class="img-responsive center-block alert"/>
</div>

<div id="errors" class="col-md-6 col-md-offset-3">
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Customer Enquiry Form</h4>
            </div>
            <div class="panel-body">
                <?php $attributes = array("id" => "target","name" => "registrationform");
                echo form_open("user/register", $attributes);?>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="fname" placeholder="Name" type="text" value="<?php echo set_value('fname'); ?>" />
                    <span class="text-danger"><?php echo form_error('fname'); ?></span>
                </div>

               
                
                <div class="form-group">
                    <label for="email">E-mail address</label>
                    <input class="form-control" name="email" placeholder="me@examaple.com" type="text" value="<?php echo set_value('email'); ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
			 <div class="form-group">
				<label for="name"> Enquiry text</label>
				<textarea class="form-control" name="lname" placeholder="text..." rows="4" cols="50" value="<?php echo set_value('lname'); ?>" ></textarea>
				<span class="text-danger"><?php echo form_error('lname'); ?></span>
			</div>

                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-default">Sign up</button>
                    <button name="cancel" type="reset" class="btn btn-default">Cancel</button>
                </div>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
</div>
</div>
 
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Your Details</h4>
      </div>
      <div class="modal-body">
		<div class="panel panel-default">
           <!--  <div class="panel-heading">
                <h4>Your signed up</h4>
            </div> -->
            <div class="panel-body">
					<p><label for="name">Name:</label><span id="name"></span></p>
					<p><label for="name">Email:</label><span id="email"></span></p>
					<p><label for="name">Comments:</label><span id="comment"></span></p>
			</div>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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