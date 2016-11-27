	<div class="container-fluid">
<div class="row">
	
<div class="col-md-3"></div>


	<div class="col-md-6 reg-container">
		<h2 class="text-center registracija_head">Registracija</h2>
		<div class="reg_div">

		<form method="POST">
					
			<table class="table">
				
				<tbody>
					<tr>
						<td>Email</td><td><input type="email" name="email" class="form-control reg_input" required></td>
					</tr>
					<tr>
						<td>Status</td><td>Redovni <input type="radio" name="status" value="redovni" class="" required> Izvanredni <input type="radio" name="status" value="izvanredni" class="" required></td>
					<tr>
						<td>Šifra</td><td><input type="password" name="password" class="form-control reg_input" required></td>
					</tr>

					

					<tr>
						<td>Ponovljena šifra</td><td><input type="password" name="password_re" class="form-control reg_input" required></td>
					</tr>
		
				
				</tbody>
			</table>

			<button type="submit" name="register" value="true" class="btn reg_input reg_botun btn-default">Predaj</button>
	</div>

		</form>
				<div class="pogreske text-center"><?php echo $error; ?>
				</div>



	</div>


<div class="col-md-3"></div>
</div>
</div>