<?php
require('propojeni_databaze_local.php');
error_reporting(0);
// get user input
$email = $_POST["email"];
$password = $_POST["password"];
$corpsw = 0;
// see if user password match with database value
$lolko = "SELECT count(*) FROM user WHERE email = '" . $email . "'";
$pocet = $conn->query($lolko)->fetchColumn();


$sql = "SELECT iduser,name,surname,birth_date,year,email,tel_number,study_id,password,residence_idresidence,field_idfield,city_idcity FROM user WHERE email = '" . $email . "'";
$overeni = $conn->query($sql);
$row = $overeni->fetch();

if (password_verify($password, $row['password'])) {
    $corpsw = 1;
};


$sql1 = "SELECT street,house_number FROM residence WHERE idresidence = '" . $row['residence_idresidence'] . "'";
$overeni1 = $conn->query($sql1);
$row1 = $overeni1->fetch();

$sql2 = "SELECT name,postcode FROM city WHERE idcity = '" . $row['city_idcity'] . "'";
$overeni2 = $conn->query($sql2);
$row2 = $overeni2->fetch();

$sql3 = "SELECT name FROM field WHERE idfield = '" . $row['field_idfield'] . "'";
$overeni3 = $conn->query($sql3);
$row3 = $overeni3->fetch();

 //TOTO JE NA ZÍSKÁVÁNÍ INFO DO SEASION

if ($pocet == 1 && $corpsw == 1) {
    session_start();
    $_SESSION['iduser'] = $row['iduser'];
    $_SESSION['login'] = $email;
    $_SESSION['name'] = $row['name'];
    $_SESSION['surname'] = $row['surname'];
    $_SESSION['birth_date'] = $row['birth_date'];
    $_SESSION['year'] = $row['year'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['tel_number'] = $row['tel_number'];
    $_SESSION['study_id'] = $row['study_id'];
    $_SESSION['street'] = $row1['street'];
    $_SESSION['house_number'] = $row1['house_number'];
    $_SESSION['city'] = $row2['name'];
    $_SESSION['postcode'] = $row2['postcode'];
    $_SESSION['field'] = $row3['name'];
    $_SESSION['time'] = time();

    header('Location: ./index.php');
} else {
    require('wrong_pass.php');
}
