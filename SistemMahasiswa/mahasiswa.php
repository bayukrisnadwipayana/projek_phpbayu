<?php
	session_start();
	if (!isset($_SESSION["namauser"]))
	{
		header("Location:login.php");
	}
	echo date("d-m-Y");
	$waktusekarang=time();
	$waktu5menit=time()+60*60*5;
	$selisih=$waktu5menit-$waktusekarang;
	if($selisih>$waktu5menit)
	{
		session_unset();
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
	</head>
<body>
	<h2 class="align-content-center text-lg-center">APLIKASI MAHASISWA</h2>
	<form class="form-control input-group-sm" action="mahasiswa.php" method="post">
	<div class="input-group-lg">
		<label for="nim">NIM</label>
		<br>
		<input type="text" name="nim" />
		<br />
		<label for="nama">Nama</label>
		<br />
		<input type="text" name="nama" />
		<br />
		<label for="alamat">Alamat</label>
		<br />
		<input type="text" name="alamat">
		<br />
		<label for="jurusan">Jurusan</label>
		<br />
		<input type="text" name="jurusan" />
		<br /><br />
	</div>
		<input type="submit" name="submit" class="btn btn-primary" value="Simpan" />
		<input type="submit" name="read" class="btn btn-secondary" value="Read" />
		<br /><br />
		<label for="cari">Cari</label>
		<br />
		<input type="text" name="search" />
		<input type="submit" name="cari" class="btn btn-primary" value="Cari" />
	</form>
	<?php
	//script halaman mahasiswa.php
	require_once("koneksi.php");
	if(isset($_POST["submit"]) && !empty($_POST["nim"]) && !empty($_POST["nama"]) && !empty($_POST["alamat"]) && !empty($_POST["jurusan"]))
	{
		$nim=$_POST["nim"];
		$nama=$_POST["nama"];
		$alamat=$_POST["alamat"];
		$jurusan=$_POST["jurusan"];
		$query="insert into identitas(nama,alamat,jurusan,nim)values('$nama','$alamat','$jurusan','$nim')";
		$hasil=mysqli_query($koneksi,$query);
		if(mysqli_affected_rows($koneksi)>0)
		{
			echo "<script type='text/javascript'>alert('Data Berhasil Disimpan')</script>";
		}
		else
		{
			echo "<script>alert('Data Gagal Disimpan')</script>";
		}
	}
	else if(isset($_POST["read"]))
	{
		$nim=$_POST["nim"];
		$nama=$_POST["nama"];
		$alamat=$_POST["alamat"];
		$jurusan=$_POST["jurusan"];
		$query="select*from identitas";
		$hasil=mysqli_query($koneksi,$query);
		echo "<table class='table table-success d-lg-table table-bordered'>";
		echo "<tr>";
		echo "<th class='table-bordered table-dark'>NIM</th>";
		echo "<th class='table-bordered table-dark'>Nama</th>";
		echo "<th class='table-bordered table-dark'>Alamat</th>";
		echo "<th class='table-bordered table-dark'>Jurusan</th>";
		echo "<th class='table-bordered table-dark'>Edit</th>";
		echo "<th class='table-bordered table-dark'>Detail</th>";
		echo "</tr>";
		while($baris=mysqli_fetch_array($hasil))
		{
			echo "<tr>";
			echo "<td>".$baris["nim"]."</td>";
			echo "<td>".$baris["nama"]."</td>";
			echo "<td>".$baris["alamat"]."</td>";
			echo "<td>".$baris["jurusan"]."</td>";
			echo '<td><a href="mahasiswa_update.php?nim='.$baris['nim'].'">Update</a> | <a href="mahasiswa.php?nim='.$baris['nim'].'">Delete</a></td>';
			echo "<td><a href=mahasiswa.php?link=".$baris["nama"].">".$baris["nama"]."</a>";
			echo "</tr>";
		}
			echo "</table>";
	}
	/*else
	{
		echo "<h3 class='h3'>Tolong Isi Data</h3> <br />";
	}
	*/
	if(isset($_GET["nim"]))
	{
		$nim=$_GET["nim"];
		$query="delete from identitas where nim='$nim'";
		$hasil=mysqli_query($koneksi,$query);
		echo "<script>alert('Data Dengan Nim $nim Sukses Terhapus')</script>";
	}
	if(isset($_POST["cari"]))
	{
		carimahasiswa();
	}
	function carimahasiswa()
	{
		global $koneksi;
		$nim=$_POST["search"];
		$sql="select*from identitas where nim='$nim'";
		$query=mysqli_query($koneksi,$sql);
		echo "<table class='table table-success d-lg-table table-bordered'>";
		echo "<tr>";
		echo "<th class='table-bordered table-dark'>NIM</th>";
		echo "<th class='table-bordered table-dark'>Nama</th>";
		echo "<th class='table-bordered table-dark'>Alamat</th>";
		echo "<th class='table-bordered table-dark'>Jurusan</th>";
		echo "<th class='table-bordered table-dark'>Edit</th>";
		echo "<th class='table-bordered table-dark'>Detail</th>";
		echo "</tr>";
		while($baris=mysqli_fetch_array($query))
		{
			echo "<tr>";
			echo "<td>".$baris["nim"]."</td>";
			echo "<td>".$baris["nama"]."</td>";
			echo "<td>".$baris["alamat"]."</td>";
			echo "<td>".$baris["jurusan"]."</td>";
			echo '<td><a href="mahasiswa_update.php?nim='.$baris['nim'].'">Update</a> | <a href="mahasiswa.php?nim='.$baris['nim'].'">Delete</a></td>';
			echo "<td><a href=mahasiswa.php?link=".$baris["nama"].">".$baris["nama"]."</a>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>
	<a href="user_logout.php" class="bg-primary bg-info">
		<button class="btn btn-primary bg-primary">LOGOUT</button>
	</a>
	<?php
		if(isset($_GET["link"]))
		{
			$detail=$_GET["link"];
			include("mahasiswa_detail.php");
		}
	?>
</body>
</html>