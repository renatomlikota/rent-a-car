<?php
    require ('baza.php');
	require('nav.php');
	$sql = "select * from tip_korisnika";
	$results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<div class="container mt-5 form-container">
	<h2 class="mb-5">Registracija</h2>
	<form action="" method="post">
		<div class="form-group">
			<label for="username">Korisničko ime:</label>
			<input type="text" class="form-control" id="username" name="username" required/>
		</div>
		<div class="form-group">
			<label for="password">Lozinka:</label>
			<input type="password" class="form-control" id="password" name="password" required/>
		</div>
		<div class="form-group">
			<label for="firstname">Ime:</label>
			<input type="text" class="form-control" id="firstname" name="firstname" required/>
		</div>
		<div class="form-group">
			<label for="lastname">Prezime:</label>
			<input type="text" class="form-control" id="lastname" name="lastname" required/>
		</div>
		<div class="form-group">
			<label for="birthdate">Datum rođenja:</label>
			<input type="date" class="form-control" id="birthdate" name="birthdate" required/>
		</div>
		<div class="form-group">
			<label for="address">Adresa:</label>
			<input type="text" class="form-control" id="address" name="address" required/>
		</div>
		<div class="form-group">
			<label for="role">Uloga:</label>
			<select class="form-control" id="role" name="role" required>
				<option value="">---</option>
				<?php 
					foreach ($results as $result):
				?>
				<option value="<?= $result["id"] ?>"><?= $result["naziv"] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<input type="submit" class="btn btn-primary" name="submit" value="Registracija">
		<?php if (isset($_GET["error"])): ?>
			<div class="alert alert-danger mt-4" role="alert">
				Registracija je neuspješna, pokušajte ponovo sa drugim podacima.
			</div>
		<?php endif ?>
	</form>
</div>

<?php
	if (isset($_POST['submit'])) {
		$username  =  $_POST["username"];
		$password  =  password_hash($_POST["password"], PASSWORD_DEFAULT);
		$firstName =  $_POST["firstname"];
		$lastname  =  $_POST["lastname"];
		$birthdate =  $_POST["birthdate"];
		$address   =  $_POST["address"];
		$role_id   =  intval($_POST["role"]);
	
		$sql = "INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime, datum_rodjenja, adresa, tip_korisnika_id) 
			VALUES ("."'". $username."'".","."'". $password."'".","."'". $firstName."'".","."'". $lastname."'".","."'". $birthdate. "'".","."'". $address. "'".","."'". $role_id. "'".")";
		$result = $con->query($sql);

        if ($result) {
			header("Location: prijava.php");
		} else {
			header("Location: registracija.php?error=1");
		}
	}
	
?>

<?php require('footer.php')?>