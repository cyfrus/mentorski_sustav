<?php
		 
		function ispisi_studente($studenti)
		{
			echo "<h2 class='lista_studenata_headline'>Lista studenata : </h2>";
			echo "<div class='lista_studenata'>";
			foreach ($studenti as $key => $value) {
				# code...
				echo "<a href='student/?id=$value->id' name='student' value='$value->id'>$value->email</a>";
				echo "<br>";
			}
			echo "</div>";
		}


		function ispisi_predmete($predmeti)
		{
			echo "<h2 class='text-center'>Lista predmeta : </h2>";
			foreach ($predmeti as $key => $value) {
				# code...
				
				echo "<div class='ime_predmeta_div'><span class='span_ime'>".$value->ime." </span><span class='span_botuni'><button type='submit' name='detalji_predmeta' class='btn btn-default' value=".$value->id.">Detalji</button>
				<button type='submit' name='promjeni_predmet' class='btn btn-default' value=".$value->id.">Promjeni</button></span></div>";
				
			}
		
		}

		function ispisi_promjenu($predmet)
		{
			echo "
			<h3>Promjena predmeta</h3>
			<table class='table'>
				<tr>
					<td>Ime predmeta:</td>
					<td><input type='text' name='ime_input' value='".$predmet[0]->ime."' class='form-control'/></td>
				</tr>
				<tr>
					<td>Kod</td>
					<td><input type='text' name='kod_input' value=".$predmet[0]->kod." class='form-control'/></td>
				</tr>
				<tr>
					<td>Program</td>
					<td><input type='text' name='program_input' value=".$predmet[0]->program." class='form-control'/></td>
				</tr>
				<tr>
					<td>Bodovi</td>
					<td><input type='text' name='bodovi_input' value=".$predmet[0]->bodovi." class='form-control'/></td>
				</tr>
				<tr>
					<td>Semestar redovni</td>
					<td><input type='text' name='sem_red_input' value=".$predmet[0]->sem_redovni." class='form-control'/></td>
				</tr>
				<tr>
					<td>Semestar izvanredni</td>
					<td><input type='text' name='sem_izv_input' value=".$predmet[0]->sem_izvanredni." class='form-control'/></td>
				</tr>
				<tr>
					<td>Izborni</td>
					<td><input type='text' name='izborni_input' value='".$predmet[0]->izborni."' class='form-control'/></td>
				</tr>
				<tr>
					<td><button type='submit' name='promjeni_predmet_submit' class='btn btn-danger' value=".$predmet[0]->id.">Spremi</button></td>
					<td></td>
				</tr>
			</table>";
		}
	
		function ispisi_detalje($predmet)
		{
			echo "<h3>Detalji predmeta</h3>
			<table class='table'>
				<tr>
					<td>Ime predmeta:</td>
					<td>".$predmet[0]->ime."</td>
				</tr>
				<tr>
					<td>Kod</td>
					<td>".$predmet[0]->kod."</td>
				</tr>
				<tr>
					<td>Program</td>
					<td>".$predmet[0]->program."</td>
				</tr>
				<tr>
					<td>Bodovi</td>
					<td>".$predmet[0]->bodovi."</td>
				</tr>
				<tr>
					<td>Semestar redovni</td>
					<td>".$predmet[0]->sem_redovni."</td>
				</tr>
				<tr>
					<td>Semestar izvanredni</td>
					<td>".$predmet[0]->sem_izvanredni."</td>
				</tr>
				<tr>
					<td>Izborni</td>
					<td>".$predmet[0]->izborni."</td>
				</tr>
				
			</table>";
		}
			
		 ?>
<div class="container">
<div class = "row">
<form method="POST">
<div class="col-md-12 ">


	<div class="logged_navigacija text-center"><?php  echo "<ul class='logged_navigation'><li class='logged_nav_tipovi'>Korisnik:</li><li> ".$this->session->userdata("email")."</li><li class='logged_nav_tipovi'>Uloga:</li><li>".$this->session->userdata("role")."</li><li class='logged_nav_tipovi'>Status:</li><li>".$this->session->userdata("status")."</li><li><button type='submit' name='log_out' value='true' class='btn btn-danger logout'>Logout</button></li></ul>"; ?>
	</div>
</div>
</div>


<div class="row">

<div class="col-md-3">
	<?php

	if(!isset($studenti))
		{	
			echo "<button type='submit' class='btn btn-default ispisi_studente' name='studenti' value='true'>Studenti</button><br>";
		}
	if(!isset($predmeti))
	{
		echo "<button type='submit' class='btn btn-default ispisi_predmete' name='predmeti' value='true'>Predmeti</button>";
	}
	
	?>

</div>

	<div class="col-md-6 popisi">
	<?php
		if(isset($studenti))
		{
			ispisi_studente($studenti);
		}else if(isset($predmeti))
		{
			ispisi_predmete($predmeti);
		}
		else if(isset($_POST["promjeni_predmet"]))
		{
			ispisi_promjenu($predmet);
		}else if(isset($_POST["detalji_predmeta"]))
		{
			ispisi_detalje($predmet);
		}
	?>

		</div>

	


<div class="col-md-3">

</div>



</div>
</div>
</form>
</div>