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
      <li class="active"><a href="<?php echo base_url() ?>">Calendar Display</a></li>
   
      <li ><a href="<?php echo base_url("/index.php/hello_future/import") ?>">import</a></li>
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
                <?php echo form_close(); ?>
	 <div class="table-responsive col-md-6">
					 <table id="products_edit" class="table table-striped table-bordered table-hover">
					  <thead>
							  <tr>
								<th>Summary</th>
								<th>Number of hours</th>
								<th>Type of work</th>
							  </tr>
							  </thead>
							  <tbody>
									<?php  foreach($ical_records as $record){
										?>
										 <tr>
												<td> <?php echo  $record->summary ?></td>
												<td> <?php echo  $record->numberHours  ?></td>
												<td> <?php echo  $record->typeWork  ?></td>
												
										 </tr>
										<?php
									}
									?>
							  </tbody>
					</table>
</div>
 
	 <div class="table-responsive col-md-6">
					 <table id="products" class="table table-striped table-bordered table-hover">
					  <thead>
							  <tr>
								<th>Month info</th>
								<th>Totals</th>
								
							  </tr>
							  </thead>
							  <tbody>
									<?php foreach($monthly_stats as $month_item) {  ?>
										 <tr>
												<td><?php  echo $month_item["description"] ?> </td>
												<td> <?php  echo $month_item["total"] ?></td>
										 </tr>
										 
									<?php  }?>
									
							  </tbody>
					</table>
</div>

<div  class="col-md-12">
		<h1> list of unbooked slots through out the weeks of  <?php echo $time_period ?></h1>
		
		<ul class="nav nav-tabs">
		<?php $week_number = count($show_unbooked_slots);
		  foreach($show_unbooked_slots as $tab_menu){

				 ?>
				 <li class="<?php  echo  $tab_menu["tab_menu_class"]?>"><a data-toggle="tab" href="#<?php echo $tab_menu["tab_ref"] ?>"> <?php echo $tab_menu["tab_label"] ?></a></li>
			<?php
			  
		  }
		?>
		</ul>
				<div class="tab-content">
		<?php 		
		   foreach($show_unbooked_slots as $tab_divs){
			  ?>
					 <div id="<?php  echo $tab_divs["tab_ref"] ?>" class="tab-pane fade <?php echo $tab_divs["tab_div_class"] ?>">
						<h2> <?php echo $tab_divs["tab_label"] ?> text</h2>
							<table  class="table table-striped table-bordered table-hover">
								  <thead>
										  <tr>
											<th> Day of the week number </th>
											<th>Summary</th>
											<th>Number of hours free</th>
										  </tr>
								 </thead>
								  <tbody>
												<?php
												foreach($tab_divs["weekly_results"] as $record){
													?>
													 <tr>
															<td> <?php echo  date('M D d Y',strtotime($record->start_date)) ?></td>
															<td> <?php echo  $record->summary  ?></td>
															<td> <?php echo  $record->unbooked  ?></td>
													 </tr>
													<?php
												}
												?>
								</tbody>
						</table>	
					</div>
				 
			<?php 
		  }
		?>
		</div>
		
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