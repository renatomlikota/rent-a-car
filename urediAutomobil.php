<?php
    require ('baza.php');
    require('nav.php');
    $id = $_GET["id"];

    $sql = "SELECT a.*, ma.id as marka_id FROM automobil a JOIN marka_automobila ma WHERE a.marka_id = ma.id AND a.id = ". $id;
    $result1 = $con->query($sql)->fetch_all(MYSQLI_ASSOC)[0];

    $sql = "SELECT * from marka_automobila";
	$results2 = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<div class="container mt-5 form-container">
	<h2 class="mb-5">Automobil</h2>
	<form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
			<label for="role">Marka automobila:</label>
			<select class="form-control" id="brand" name="brand" required value=<?= $result1["marka_id"] ?>>
				<option value="">---</option>
				<?php 
					foreach ($results2 as $result):
				?>
				<option value="<?= $result["id"] ?>"><?= $result["naziv"] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="form-group">
			<label for="name">Naziv:</label>
			<input type="text" class="form-control" id="name" name="name" required value=<?= $result1["naziv"] ?>>
		</div>
		<div class="form-group">
			<label for="year">Godište:</label>
			<input type="text" class="form-control" id="year" name="year" required value=<?= $result1["godiste"] ?>>
		</div>
		<div class="form-group">
			<label for="price">Cijena po satu:</label>
			<input type="text" class="form-control" id="price" name="price" required value=<?= $result1["cijena_po_satu"] ?>>
		</div>
		<div class="form-group">
			<label for="quantity">Količina:</label>
			<input type="text" class="form-control" id="quantity" name="quantity" required value=<?= $result1["kolicina"] ?>>
		</div>
		<div class="form-group">
			<label for="quantity">Slika:</label>
			<input type="file" class="form-control" id="image" name="image"/>
		</div>
		<input type="submit" class="btn btn-primary" name="submit" value="Uredi automobil">
	</form>
</div>

<?php

	if (isset($_POST['submit'])) {
		$name      =  $_POST["name"];
		$year      =  $_POST["year"];
		$price     =  $_POST["price"];
		$quantity  =  $_POST["quantity"];
		$brand_id  =  intval($_POST["brand"]);
		
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		if (isset($_POST["submit"])) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $target_file = '';
            }

            $sql = "UPDATE automobil SET naziv=". $name. ", godiste=". $year. ", cijena_po_satu=". $price. ", kolicina=". $quantity. ", putanja_slike=". $target_file. ", marka_id=". $brand_id." WHERE id= " . $id;
            $result = $con->query($sql);

            if ($result) {
                header("Location: automobili.php");
            }
        }
    }
?>

<?php require('footer.php')?>