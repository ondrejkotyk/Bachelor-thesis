<!DOCTYPE html>
<?php
require('propojeni_databaze_local.php');
session_start();
if (!isset($_SESSION['iduser'])) {
    header('Location: index.php');
} else {
    ?>
    <html lang="cs">
        <head>
            <title> Elektornické dokumenty - Účet</title>
            <link rel="stylesheet" href="account_style.css">
            <link rel="stylesheet" href="header.css">
            <link rel="stylesheet" href="footer.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <meta charset="UTF-8">
            <meta name="keywords" content="Provozně ekonomická fakulta, ČZU, uznávání žádostí, elektronické dokumenty, schvalování, uznání předmětu, opakování ročníku">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Systém pro uznávání elektronických žádostí Provozně ekonomické fakulty">
            <link rel="shortcut icon" href="obrazky/favicon.ico" type="image/x-icon">
            <meta name="author" content="Ondřej Kotyk">
        </head>
        <body>
            <?php include 'header.php'; ?>
            <main id="maincontent">
                <div id="main">
                    <h1>Osobní údaje</h1>
                    <p><img id="img" src="img/avatar.jpg" alt="Avatar"></p>
                    <h2><?php
                        echo $_SESSION['name'];
                        echo ' ';
                        echo $_SESSION['surname'];
                        ?></h2>
                    <table id="info">
                        <tr>
                            <td>
                                <p class="bold">ID studia:</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['study_id']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"> Obor studia:</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['field']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"> E-mailová adresa:</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['login']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"> Adresa bydliště (včetně PSČ):</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['street'], " ", $_SESSION['house_number'], " ", $_SESSION['city'], " ", $_SESSION['postcode']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"> Ročník:</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['year'], "."; ?> Ročník</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"> Telefon:</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['tel_number']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"> Datum narození:</p>    
                            </td>
                            <td>
                                <p class="border"><?php echo $_SESSION['birth_date']; ?></p>
                            </td>
                        </tr>

                    </table>
                    <p id="notice"><b>Osobní údaje jsou napojené na Univezitní informační systém. Pokud chcete údaje změnit musíte je změnit v UIS!!!</b></p>
                    <button id="logout" onclick="window.location.href = './logout.php'">Odhlásit se</button>

                    <?php if ($_SESSION['study_id'] == 1) { ?>
                        <h3>Žádosti na schválení</h3>
                        <form method="POST" action="./aprove.php">
                            <table id="myrequests">
                                <tr>
                                    <th width="15%">Datum vytvoření</th>
                                    <th width="35%">Název</th>
                                    <th width="25%">Druh žádosti</th>
                                    <th width="5%">Stáhnout</th>
                                    <th width="5%">Schválit</th>
                                    <th width="20%">Stav</th>
                                <tr>
                                    <?php
                                    $sqlko = "SELECT * FROM user_has_subject JOIN history_has_subject ON user_has_subject.subject_code=history_has_subject.subject_code
JOIN history ON history.idhistory = history_has_subject.history_idhistory where user_has_subject.user_iduser = '" . $_SESSION['iduser'] . "' GROUP BY history_idhistory;";
                                    $reg = $conn->query($sqlko);
                                    $reg->setFetchMode(PDO::FETCH_ASSOC);
                                    ?>  
                                    <?php while ($row = $reg->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ($row['date_of_creation']) ?>
                                        </td>
                                        <td>
                                            <?php echo ($row['name']) ?>
                                        </td>
                                        <td>
                                            <?php echo ($row['type']) ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo ($row['link']) ?>" download="zadost.pdf"><img src="./img/pdf_img.png" alt="pdf icon" width="30" height="30"></a>
                                        </td>
                                        <?php if ($row['checked'] == 1) { ?>
                                            <td>
                                                <input type="checkbox" id="check<?php echo $row['history_idhistory'] ?>" name="check<?php echo $row['history_idhistory'] ?>" disabled checked>
                                            </td>
                                        <?php } else { ?>
                                            <td>
                                                <input type="checkbox" id="check<?php echo $row['history_idhistory'] ?>" name="check<?php echo $row['history_idhistory'] ?>">
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <?php
                                            if ($row['checked'] == 0) {
                                                echo 'X - žádost neschválena';
                                            } else {
                                                echo '✓ - žádost schválena';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?> 
                            </table>
                            <button id="submit">Potvrdit</button>
                        </form>
                    <?php } else {
                        ?>
                        <h3>Moje žádosti</h3>
                        <table id="myrequests">
                            <tr>
                                <th width="30%">Datum vytvoření</th>
                                <th width="40%">Název</th>
                                <th width="30%">Druh žádosti</th>
                                <th width="5%">Stáhnout</th>
                            <tr>
                                <?php
                                $sqlko = "SELECT date_of_creation,name,type,link FROM history WHERE user_iduser = '" . $_SESSION['iduser'] . "';";
                                $reg = $conn->query($sqlko);
                                $reg->setFetchMode(PDO::FETCH_ASSOC);
                                ?>  
                                <?php while ($row = $reg->fetch()) { ?>
                                <tr>
                                    <td>
                                        <?php echo ($row['date_of_creation']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['name']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['type']) ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo ($row['link']) ?>" download="zadost.pdf"><img src="./img/pdf_img.png" alt="pdf icon" width="30" height="30"></a>
                                    </td>
                                </tr>
                            <?php } ?> 
                        </table>
                    <?php } ?>
                    <div style="position:absolute;display:none;">
                        <!--WZ-REKLAMA-1.0-->
                    </div>
                </div>
            </main>
            <?php include 'footer.php'; ?>
        </body>
    </html>
<?php } ?>