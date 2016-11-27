

<div class="container-fluid kontenjer"> <!-- pocetak tijela -->

	

<div class="row">  

<div class="col-md-4">
</div>


<?php $this->load->helper('url'); ?>


<div class="col-md-4 main_div">


	<form action="" method="POST" accept-charset="utf-8">
		<h2 class="log_headline">Log in</h2>
		<ul class="ul_login">
			<li>Korisnicko ime</li><li><input type="text" name="username" class="form-control user" required></input></li>
		

		
			<li>Lozinka</li><li><input type="password" name="password" class="form-control pass" required></input></li>
		

		
		<li><button type="submit" name="login" value="true" class="form-control log_button">Log in</button></li>
		
		</ul>
	</form>
		<p class="reg-p"><a name=<?php echo site_url("index.php/register");?> href="register" class="reg">Registracija</a></p>
	</div> <!-- kraj col-md-5 koja sadrzava inpute -->
	

	
	<div class="col-md-4 side_div">

	</div>








</div> 
</div><!-- kraj rowa -->
