<?php
	require('nav.php'); 
	require ('baza.php'); 
	$sql = "Select a.*, ma.naziv as marka from automobil a JOIN marka_automobila ma Where a.marka_id = ma.id";
	$result = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
?>

<body>
	<div class="container">
		<?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): ?>
			<div class="row">
				<div class="col offset-sm-10 mt-5">
					<a href="dodajAutomobil.php" class="btn btn-info d-flex" title="Dodaj automobil">
						<i class="material-icons pr-3">add_circle</i> Automobil
					</a>	
				</div>
			</div>
		<?php endif ?>
		<div class="row">
    		<div class="col">
				<?php if (count($result)): ?>
					<table class="table table-hover table-dark mt-5">
						<thead>
							<tr>
								<th>Naziv</th>
								<th>Godište</th>
								<th>Cijena po satu</th>
								<th>Količina</th> 
								<th>Slika</th> 
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($result as $res):
							?>
								<tr>
									<td><?= $res["marka"] ?> <?= $res["naziv"] ?></td>
									<td><?= $res["godiste"] ?></td>
									<td><?= $res["cijena_po_satu"] ?></td>
									<td><?= $res["kolicina"] ?></td>
									<td>
										<?php if ($res["putanja_slike"]): ?>
											<a href="/rent-a-car/<?= $res["putanja_slike"] ?>" target="_blank">
												Fotografija
											</a>
										<?php endif ?>
									</td>
									<?php if (isset($_SESSION["role"]) &&  $_SESSION["role"] == "admin"): ?>
										<td>
											<a href="urediAutomobil.php?id=<?= $res["id"] ?>" title="Uredi automobil"><i class="material-icons">edit</i></a>
										</td>
										<td>
											<a onclick="return confirm('Jeste li sigurni?');" href="izbrisiAutomobil.php?id=<?= $res["id"] ?>" title="Izbriši automobil" >
												<i class="material-icons">delete</i>
											</a>
										</td>
										<?php endif ?>
										<?php if (!isset($_SESSION["role"]) || (isset($_SESSION["role"]) && $_SESSION["role"] != "admin")): ?>
											<td>
												<a onclick="return confirm('Jeste li sigurni da želite izajmiti automobil?');" href="iznajmiAutomobil.php?id=<?= $res["id"] ?>" title="Iznajmi automobil" >
													<i class="material-icons">send</i>
												</a>
											</td>
										<?php endif; ?>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php require('footer.php')?>
</html>
