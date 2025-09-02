<?php
require('propojeni_databaze_local.php');
session_start();
for ($i = 0; $i < 90; $i++) {
    if (isset($_POST['check' . $i])) {
        if ($_POST['check' . $i] == true) {
            $sql = $conn->prepare("UPDATE history_has_subject SET checked = 1 WHERE history_idhistory = '" . $i . "' AND subject_code IN (Select subject_code from user_has_subject where user_iduser = '" . $_SESSION['iduser'] . "');");
            $sql->execute();
        } else {
            
        }
    }
}
echo '<script>window.location.replace("./account.php");</script>';
exit();

