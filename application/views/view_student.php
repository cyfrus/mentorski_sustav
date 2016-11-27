<div class="container">
<form method="POST">
<div class="row">
	
<div class="col-md-12 header_studenta">
	<div class="logged_navigacija text-center"><?php  echo "<ul class='logged_navigation'>
	<li class='logged_nav_tipovi'>Korisnik:</li><li> ".$this->session->userdata("email")."</li>
	<li class='logged_nav_tipovi'>Uloga:</li><li>".$this->session->userdata("role")."</li>
	<li class='logged_nav_tipovi'>Status:</li><li>".$this->session->userdata("status")."</li>
	<li><button type='submit' name='log_out' value='true' class='btn btn-danger logout'>Logout</button></li></ul>"; ?></div>
	<?php if(isset($student) && $this->session->userdata("role")=="mentor")
	echo "<h2 class='text-center'>Student : ".$student."</h2>";
	echo "<div class='ects'>ECTS upisanih predmeta : ".$upisanih."</div>";
	echo "<div class='ects'>ECTS polozenih predmeta : ".$polozenih."</div>";
	 ?>
</div>

</div>


<div class="row sadrzaj_svega">
<div class="col-md-6 upisni_list">
<?php 

echo "<h3 class='text-center'>Upisni list</h3>";
if(!empty($student))
{

	if($status == "redovni")
{
			$s = 7;
}
else
{
			$s = 9;
}
for ($i=1; $i < $s; $i++) { 
			
		echo "<h4>Semestar ".$i."</h4>";
		if(!empty($upisani))
		{
		foreach ($upisani as $key => $value)
		{
		if($value->sem_redovni == $i && $status== "redovni" && $value->status=="enrolled")
		{
			echo "<div class='predmet'>";
			echo "<button type='submit' class='btn btn-default' name='remove_predmet' value=".$value->id."><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>";
			echo "<button type='submit' class='btn btn-default' name='prosao_predmet' value=".$value->id."><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>".$value->ime;
			echo "</div>";
		}
		else if($value->sem_redovni == $i && $status == "redovni" && $value->status="passed")
		{
			echo "<div class='predmet'>";
			echo "<button type='submit' class='btn btn-default' name='remove_predmet' value=".$value->id."><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>";
			echo "<button type='submit' class='btn btn-default' name='vrati_enrolled' value=".$value->id."><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>".$value->ime;
			echo "</div>";
		}
		else if ($value->sem_izvanredni == $i && $status == "izvanredni" && $value->status=="enrolled")
		{
			echo "<div class='predmet'>";
			echo "<button type='submit' class='btn btn-default' name='enrolled' value=".$value->id."><span class='glyphicon glyphicon-ok aria-hidden='true'></span></button>".$value->ime;
			echo "</div>";
		}
		
}

}
}

}
else
{
	if(isset($warning))
	{
	echo "<h1 class='text-center'>".$warning."</h1>";
	}
}

?>

</div>



<div class="col-md-5">
<div class="scrollable_predmeti">
<?php
echo "<h3 class='text-center'>Predmeti</h3>";
if(!empty($svi) && !empty($student))
{
	foreach ($svi as $key => $value) {
		# code...
			echo "<div class='predmet'>";
			echo "<button type='submit' class='btn btn-default button_dodaj' name='add_predmet' value=".$value->id."><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>".$value->ime;
			echo "</div>";
	}
}


?>
</div>
<div class="zbroj_ects">
<?php 

	

	?>
</div>
</div>



</div>
</form>
</div>