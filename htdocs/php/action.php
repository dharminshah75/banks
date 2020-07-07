<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

header("Location: http://dharminbanks.epizy.com/add.html");

$date = $_POST['date'];
$account = $_POST['account'];
$particulars = $_POST['particulars'];
$amount = $_POST['amount'];
$cheque = $_POST['cheque'];
$type = $_POST['type'];
$debit = 0;
$credit = 0;

$servername = "sql210.epizy.com";
$username = "epiz_26162415";
$password = "jUtkY9QuUoc";
$database = "epiz_26162415_banks";

$conn = new mysqli($servername,$username,$password,$database);
if ($conn -> connect_error) {
    die("Connection Failed " .$conn->connect_error);
}
else{
    
}

$sql = "select * from Balances where name='$account' " ;
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$balance = $row['balance'];

if($type == "debit"){
    $balance = $balance - $amount;
    $debit = $amount;
}
else{
    $balance = $balance + $amount;
    $credit = $amount;
}

$sql_1 = "update Balances set balance='$balance' where name='$account' ";
$sql_2 = "insert into $account(date,particulars,debit,credit,cheque,balance) values('$date','$particulars','$debit','$credit','$cheque','$balance') " ;


if ($conn->query($sql_2) && $conn->query($sql_1) ) {
	echo "<h3>Added Successfully</h3>";
} else {
	echo $conn->error;
}

echo "<a href='http://dharminbanks.epizy.com/'>Back</a>";

$conn->close();

exit();

?> 