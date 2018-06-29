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

<h1>Questions listed</h1>
<div id="message" class="col-md-6 col-md-offset-3">
</div>
<?php
$attributes = array('class' => 'survey col-md-12', 'id' => 'ical_form');
$hidden = array('number_questions' => count($Questions));
echo form_open('questions/process', $attributes, $hidden);
$cnt = 1;
foreach($Questions as $Question){
	
	?>
	   <p><?php echo  $Question->Question; ?></p>
	   <ul>
	<?php
		foreach($Question->question_options as $options){
			
			?>
			<li> <?php  echo  $options->Question  ." $cnt ".   form_radio(array("name"=>"question_$cnt","id"=>"male","value"=>"$options->idquestion-$options->parent_question", 'checked'=>set_radio('gender', 'M', FALSE))); ?> </li>
			<?php
		}
		?>
		</ul>
		<?php

	$cnt++	;
	}
	$comment = array(
      'name'        => 'comment',
      'id'          => 'comment',
      'placeholder'       => 'comment...',
      'rows'        => '5',
      'cols'        => '10',
      'style'       => 'width:50%',
	  'class' =>'form-control'
    );
?>
	 <div class="form-group">
                    <label for="name">Comment</label>
					<?php
					echo form_textarea($comment);
					?>
                    
                </div>
				
				
				<?php
 
	$data = array(
		'type' => 'submit',
		'value'=> 'Submit',
		'class'=> 'btn btn-default'
		);
		?>
		 <div class="form-group">
		<?php
			echo form_submit($data);
			echo form_close();


			?>
</div>

    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script  src="<?php echo base_url("js/bootstable.js"); ?>"></script>
    <script  type="text/javascript" src="<?php echo base_url("js/homepage.js"); ?>" ></script>
  
</body>
</html>
