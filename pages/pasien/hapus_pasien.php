<?php
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM pasien WHERE no_pasien='$id'");
mysqli_query($conn,"DELETE FROM rekmed WHERE no_pasien='$id'");
echo "<script>window.location.href='index.php?page=Pasien';</script>";
exit;
 ?>
