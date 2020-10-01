<?php
    require ('baza.php');
    require('nav.php');
    if (empty($_SESSION["user"])) {
        header('Location: prijava.php');
    }
    $automobil_id = $_GET["id"];
    $korisnik_id = $_SESSION["user"];
?>
<div class="container mt-5 form-container">
	<h2 class="mb-5">Iznajmi automobil</h2>
	<form action="" method="post">
		<div class="form-group">
			<label for="startDate">Datum početka:</label>
			<input type="date" class="form-control" id="startDate" name="startDate" required/>
		</div>
		<div class="form-group">
			<label for="endDate">Datum završetka:</label>
			<input type="date" class="form-control" id="endDate" name="endDate" required/>
		</div>
		<div class="form-group">
			<label for="hours">Broj sati:</label>
			<input type="number" class="form-control" id="hours" name="hours" required/>
		</div>
		<input type="submit" class="btn btn-primary" name="submit" value="Iznajmi automobil">
	</form>
</div>

<?php
	if (isset($_POST['submit'])) {
		$startDate =  $_POST["startDate"];
		$endDate   =  $_POST["endDate"];
		$hours     =  $_POST["hours"];
		
        $sql = "INSERT INTO najam (datum_pocetka, datum_zavrsetka, broj_sati, automobil_id, korisnik_id) 
                VALUES ("."'". $startDate."'".","."'". $endDate."'".","."'". $hours."'".","."'". $automobil_id."'".","."'". $korisnik_id. "'".")";
        $result = $con->query($sql);

        if ($result) {
            header("Location: najmovi.php");
        }	
	}
?>

<?php require('footer.php')?>