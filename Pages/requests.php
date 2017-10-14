<!DOCTYPE html>
<body>
<?php

$users = [];

print_r($_REQUEST);

//array_push($users, ["username" => $_REQUEST['user']]);

//print_r(json_encode($users));

//print_r(json_decode(json_encode($users), true));

    $name = $_GET['name'];
    $payment = $_GET['Payment_Offered'];
    $request = $_GET['Request_Details'];
    $myFile= "requests.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    fwrite($fh, $name . ":" . $payment . ":" . $request . ":");

    fclose($fh);
?>

<script> window.location.href = "MainPageLogged.php";</script>

</body>

