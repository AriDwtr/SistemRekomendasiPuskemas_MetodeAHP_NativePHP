<?php
$id=$_GET['id'];
$query = mysqli_query($conn,"SELECT * FROM rekmed WHERE no_rekmed='$id'");
$data=mysqli_fetch_array($query);
$no=$data['no_pasien'];
mysqli_query($conn,"DELETE FROM rekmed WHERE no_rekmed='$id'");
mysqli_query($conn,"DELETE FROM spk WHERE no_rekmed='$id'");
echo "<script>window.location.href='index.php?page=Form_Rekmde&id=$no';</script>";
exit;
?>
