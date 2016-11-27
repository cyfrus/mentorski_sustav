<!DOCTYPE html>
<html>
<head>
	<title>Mentorski sustav</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
	<?php 
	$this->load->helper('html');
	echo link_tag('css/main.css'); 
	$this->load->helper('url');?>
	<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo base_url();?>js/main.js" ></script>
		
</head>
<body>
<?php $this->load->helper('url');
		$url = site_url("");
	echo "<div class='row prvirow'><div class='col-md-4'></div><div class='col-md-4'><a href=$url "."class='headline'><h1>Mentorski sustav</h1></a></div><div class='col-md-4'></div></div>";
 ?>
