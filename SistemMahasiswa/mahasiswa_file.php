
<?php
//script menghapus data
	if(isset($_GET["nim"]))
	{
		$nim=$_GET["nim"];
		$query="delete from identitas where nim='$nim'";
		$hasil=mysqli_query($koneksi,$query);
		echo "<script>alert('Data Dengan Nim $nim Sukses Terhapus')</script>";
	}
?>
<?php
	
?>