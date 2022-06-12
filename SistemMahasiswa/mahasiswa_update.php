<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
</head>
<body>
	<?php
		require_once("koneksi.php");
		$nim=$_GET["nim"];
		$query="select*from identitas where nim='$nim'";
		$hasil=mysqli_query($koneksi,$query);
		$baris=mysqli_fetch_array($hasil);
	?>
	<a class="bg-primary" href="mahasiswa.php">
		<button class="btn btn-primary bg-info">Kembali Ke Mahasiswa</button>
	</a>
<form action="mahasiswa_update.php?nim=<?php echo $baris['nim']; ?>" class="form-control input-group-sm" method="post">
		<label for="nim">NIM</label>
		<br />
		<input type="text" name="nim" value="<?php echo $baris['nim']; ?>" disabled />
		<br />
		<label for="nama">Nama</label>
		<br />
		<input type="text" name="nama" value="<?php echo $baris['nama']; ?>" />
		<br />
		<label for="alamat">Alamat</label>
		<br />
		<input type="text" name="alamat" value="<?php echo $baris['alamat']; ?>" />
		<br />
		<label for="jurusan">Jurusan</label>
		<br />
		<input type="text" name="jurusan" value="<?php echo $baris['jurusan']; ?>" />
		<br /><br />
		<input type="submit" name="simpan" class="btn btn-primary" value="simpan" />
		<br />
		<input type="hidden" name="nim2" value="<?php echo  $baris['nim']; ?>" />
	</form>
	<?php
		require_once("koneksi.php");
		if(isset($_POST["simpan"]))
		{
			$nim=$_POST["nim2"];
			$nama=$_POST["nama"];
			$alamat=$_POST["alamat"];
			$jurusan=$_POST["jurusan"];
			$query="update identitas set nama='$nama',alamat='$alamat',jurusan='$jurusan' where nim='$nim'";
			$hasil=mysqli_query($koneksi,$query);
			echo "<script>alert('data sukses tersimpan')</script>";
			//header("Location:mahasiswa.php");
		}
	?>
</body>
</html>