<?php
	require ('baza.php');
	require('nav.php');
	$error = false;
?>

<div class="container mt-5 form-container">
	<h2 class="mb-5">Prijava</h2>
	<form action="" method="post">
		<div class="form-group">
			<label for="email">Korisničko ime:</label>
			<input type="text" class="form-control" id="username" name="username" required />
		</div>
		<div class="form-group">
			<label for="password">Lozinka:</label>
			<input type="password" class="form-control" id="password" name="password" required/>
		</div>
    	<input type="submit" class="btn btn-primary" name="submit" value="Prijava">
		<?php if (isset($_GET["error"])): ?>
			<div class="alert alert-danger mt-4" role="alert">
				Prijava je neuspješna, pokušajte sa drugim korisničkim imenom i lozinkom.
			</div>
		<?php endif ?>
	</form>
</div>

<?php
	if (isset($_POST['submit'])) {
		if (isset($_POST["username"]) && isset($_POST["password"])) {
			$username = $_POST["username"];
			$password = $_POST["password"];
		
			$sql = "Select id from korisnik where korisnicko_ime='" . $username ."'";
			$result = $con->query($sql);
			$row = $result->fetch_object();

			if (!$row) {
				header('Location: prijava.php?error=1');
			}
	
			$sql = "Select k.id, k.lozinka, tk.naziv from korisnik k JOIN tip_korisnika tk where k.tip_korisnika_id = tk.id 
				AND k.id='" . $row->id. "'";
			$result = $con->query($sql);
			$row = $result->fetch_object();
			$hashedPassword = $row->lozinka;

			if (password_verify($password, $hashedPassword)) {
				$_SESSION["user"] = $row->id;
				$_SESSION["role"] = $row->naziv;
				header('Location: index.php');
			} else {
				header('Location: prijava.php?error=1');
			}
    	} else {
			header('Location: prijava.php?error=1');
		}
	}
?>
<?php require('footer.php')?>