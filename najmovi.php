<?php
	require('nav.php'); 
	require ('baza.php'); 
    $sql = "SELECT N.datum_pocetka, N.datum_zavrsetka, N.broj_sati * A.cijena_po_satu as cijena, CONCAT(MA.naziv, ' ', A.naziv) as automobil, 
    CONCAT(K.ime, ' ', K.prezime) as imePrezime from najam N JOIN automobil A JOIN korisnik K JOIN marka_automobila MA 
    WHERE N.automobil_id = A.id AND N.korisnik_id = K.id AND MA.id = A.marka_id";
    if ($_SESSION["role"] == "kupac") {
        $sql .= " AND K.id=" . $_SESSION["user"];
	}
	$result = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
?>

<body>
	<div class="container">
		<div class="row">
    		<div class="col">
				<?php if (count($result)): ?>
					<table class="table table-hover table-dark mt-5">
						<thead>
							<tr>
								<th>Korisnik</th>
								<th>Automobil</th>
								<th>Cijena (KM)</th>
								<th>Datum početka</th> 
								<th>Datum završetka</th> 
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($result as $res):
							?>
								<tr>
									<td><?= $res["imePrezime"] ?></td>
									<td><?= $res["automobil"] ?></td>
									<td><?= $res["cijena"] ?></td>
									<td><?= $res["datum_pocetka"] ?></td>
									<td><?= $res["datum_zavrsetka"] ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
                <?php else: ?>
                <p class="mt-5 text-center">Nema najmova</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php require('footer.php')?>
</html>
