<?php
    require ('baza.php');
	require('nav.php');
	$sql = "select * from marka_automobila";
	$results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<div class="container mt-5 form-container">
	<h2 class="mb-5">Automobil</h2>
	<form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
			<label for="role">Marka automobila:</label>
			<select class="form-control" id="brand" name="brand" required>
				<option value="">---</option>
				<?php 
					foreach ($results as $result):
				?>
				<option value="<?= $result["id"] ?>"><?= $result["naziv"] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="form-group">
			<label for="name">Naziv:</label>
			<input type="text" class="form-control" id="name" name="name" required/>
		</div>
		<div class="form-group">
			<label for="year">Godište:</label>
			<input type="text" class="form-control" id="year" name="year" required/>
		</div>
		<div class="form-group">
			<label for="price">Cijena po satu:</label>
			<input type="text" class="form-control" id="price" name="price" required/>
		</div>
		<div class="form-group">
			<label for="quantity">Količina:</label>
			<input type="text" class="form-control" id="quantity" name="quantity" required/>
		</div>
		<div class="form-group">
			<label for="quantity">Slika:</label>
			<input type="file" class="form-control" id="image" name="image"/>
		</div>
		<input type="submit" class="btn btn-primary" name="submit" value="Dodaj automobil">
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
		if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			$target_file = '';
		}

		$sql = "INSERT INTO automobil (naziv, godiste, cijena_po_satu, kolicina, putanja_slike, marka_id) 
				VALUES ("."'". $name."'".","."'". $year."'".","."'". $price."'".","."'". $quantity. "'". "," . "'". $target_file. "'".","."'". $brand_id. "'".")";
		$result = $con->query($sql);

		if ($result) {
			header("Location: automobili.php");
		}
				
	}
	
?>

<?php require('footer.php')?>