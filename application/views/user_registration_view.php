<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter User Registration Form Demo</title>
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("style/home.css"); ?>" rel="stylesheet" type="text/css" />
	</head>
<body>
<div class="container col-md-12 ">
<div id="errors" class="col-md-6 col-md-offset-3">
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>User Registration Form</h4>
            </div>
            <div class="panel-body">
                <?php $attributes = array("id" => "target","name" => "registrationform");
                echo form_open("user/register", $attributes);?>
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input class="form-control" name="fname" placeholder="Name" type="text" value="<?php echo set_value('fname'); ?>" />
                    <span class="text-danger"><?php echo form_error('fname'); ?></span>
                </div>

               
                
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input class="form-control" name="email" placeholder="me@examaple.com" type="text" value="<?php echo set_value('email'); ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
			 <div class="form-group">
				<label for="name"> Comments</label>
				<textarea class="form-control" name="lname" placeholder="text..." rows="4" cols="50" value="<?php echo set_value('lname'); ?>" ></textarea>
				<span class="text-danger"><?php echo form_error('lname'); ?></span>
			</div>

                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-default">Signup</button>
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

    <script  type="text/javascript" src="<?php echo base_url("js/jquery-1.9.1.min.js"); ?>" rel="stylesheet"></script>
	<script   >
			var base = <?php echo base_url()?>
	</script>
	<script  type="text/javascript" src="<?php echo base_url("js/homepage.js"); ?>" ></script>
	<script  type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" ></script>
</body>
</html>