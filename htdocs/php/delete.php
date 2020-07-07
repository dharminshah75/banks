<?php

header("Location: http://dharminbanks.epizy.com/");

$id = $_GET['id'];
$account = $_GET['acc'];
$servername = "sql210.epizy.com";
$username = "epiz_26162415";
$password = "jUtkY9QuUoc";
$database = "epiz_26162415_banks";
$conn = new mysqli($servername,$username,$password,$database);
if ($conn -> connect_error) {
	die("Connection Failed " .$conn->connect_error);
}
else{
	echo "";
}

$sql = "select * from Balances where name='$account' " ;
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$balance = $row['balance'];


$sql = "select * from $account where id='$id'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$debit = $row['debit'];
$credit = $row['credit'];
$type = "";
$amount = 0;
if($debit == 0){
    //credited, so now debit
    $amount = $credit; 
    $balance = $balance - $amount;
}
else{
    //debited , so now credit
    $amount = $debit;
    $balance = $balance + $amount;
}

$sql_1 = "update Balances set balance=$balance where name='$account' ";
$sql_2 = "delete from $account where id='$id' ";
// echo "<p>".$sql_1."</p>";
// echo "<p>".$sql_2."</p>";

if ($conn->query($sql_1) && $conn->query($sql_2)) {
	echo "Deleted Successfully";
} else {
	echo "Some error occured";
	echo $conn->error;
}

$conn->close();

exit();

?>
