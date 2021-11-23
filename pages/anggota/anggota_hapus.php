<?php
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM user WHERE id='$id'");
echo "<script>window.location.href='index.php?page=Anggota';</script>";
exit;
?>
