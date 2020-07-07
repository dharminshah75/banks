<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>

<?php  
    $account = $_POST['account'];
    $date1 = "";
    $date2 = "";
?>

<div class="container m-2 mt-5">

<form class="form" method="POST" action="http://dharminbanks.epizy.com/php/show_passbook.php">
<div class="row">
    <input type="text" name="account" value=<?php echo $account; ?> hidden />
    <div class="col-md-6 mb-4">

        <div class="md-form">
        <!--The "from" Date Picker -->
        <label for="startingDate">Start</label>
        <input placeholder="Starting date" name="date1" type="date" id="startingDate" class="form-control datepicker">
        </div>

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-6 mb-4">

        <div class="md-form">
        <!--The "to" Date Picker -->
        <label for="endingDate">End</label>
        <input placeholder="Ending date" name="date2" type="date" id="endingDate" class="form-control datepicker">
        </div>

    </div>
    <!--Grid column-->

    <div class="col-md-6 mb-4">

        <div class="md-form">
            <input type="submit" value="Apply" class="btn btn-primary" />
        </div>
    
        </div>
        <!--Grid column-->

    </div>
</form>
        


<?php

if($_POST['date1']){
    $date1 = $_POST['date1'];
}
if($_POST['date2']){
    $date2 = $_POST['date2'];
}
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

echo "<h3>".$account."</h3>";
echo "<h4>Balance : ".$balance."</h4>";


$sql = "select *,DATE_FORMAT(date,'%d/%m/%Y') AS dates from $account order by date desc " ;

if($date1!="" && $date2!=""){
    echo "<p>Period : ".$date1." to ".$date2."</p>";
    $sql = "select *,DATE_FORMAT(date,'%d/%m/%Y') AS dates from $account where date>='$date1' and date<='$date2' order by date desc";
}

$result = $conn->query($sql);

if ($result->num_rows > 0 ) {
	echo "<table class='table table-bordered thead-dark'>";
		echo "<tr><th>Date</th><th>Particulars</th><th>Debit</th><th>Credit</th><th>Cheque</th><th>Balance</th><th>Actions</th></tr>";
		while ($row = $result->fetch_assoc()) {
		    $id = $row['id'];
		    $delete = "<a href='./delete.php?id=".$id."&acc=".$account."'>delete</a>";
			echo '<tr> <td>'.$row['dates'].'</td> <td>'.$row['particulars'].'</td><td>'.$row['debit'].'</td> <td>'.$row['credit'].'</td> <td>'.$row['cheque'].'</td> <td>'.$row['balance'].'</td> <td>'.$delete.'</td> </tr>';
		}
	echo "</table";
} else {
	echo "0 records found";
}


$conn->close();

exit();

?> 


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
