<!DOCTYPE html>
<?php
require('propojeni_databaze_local.php');
session_start();
$_SESSION['time'] = time();
if (!isset($_SESSION['iduser'])) {
    header('Location: ./prihlaseni.php');
} else {
    ?>
    <html lang="cs">
        <head>
            <title>PEF - Elektornické dokumenty </title>
            <link rel="stylesheet" href="uni_zadost_style.css">
            <link rel="stylesheet" href="header.css">
            <link rel="stylesheet" href="footer.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <meta charset="UTF-8">
            <meta name="keywords" content="Provozně ekonomická fakulta, ČZU, uznávání žádostí, elektronické dokumenty, schvalování, uznání předmětu, opakování ročníku">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Systém pro uznávání elektronických žádostí Provozně ekonomické fakulty">
            <link rel="shortcut icon" href="obrazky/favicon.ico" type="image/x-icon">
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
            <meta name="author" content="Ondřej Kotyk">
        </head>
        <body>
            <?php include 'header.php'; ?>
            <main id="maincontent">
                <div>
                    <div>
                        <div id="form">
                            <h1><b>UNIVERZÁLNÍ ŽÁDOST</b></h1>
                            <span id="preview">
                                <h4>Náhled dokumentu</h4>
                                <img src="./img/nahled_uni.jpg" width="150px" height="170px" alt="document_preview"/>
                            </span>
                            <form method="POST" action="./generovani_uni.php">
                                <h3>Předmět žádosti:</h3>
                                <input placeholder="Žádost o dodatečné opakování ročníku..." type="text" size="60" name="predmet">
                                <h3>Obsah a odůvodnění žádosti:</h3>
                                <textarea placeholder="Stručné odůvodnění..." rows="10" name="obsah" cols="80" maxlength="1200"></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 1200</span>
                                </div>
                                <input type="submit" value="Odeslat žádost">
                            </form> 
                        </div>
                    </div>
                </div>

                <div style="position:absolute;display:none;">
                    <!--WZ-REKLAMA-1.0-->
                </div>
                <script> /*JSON limiting number of characters*/
                    $('textarea').keyup(function () {

                        var characterCount = $(this).val().length,
                                current = $('#current'),
                                maximum = $('#maximum'),
                                theCount = $('#the-count');
                        current.text(characterCount);

                        if (characterCount == 1200) {
                            maximum.css('color', '#8f0001');
                            current.css('color', '#8f0001');
                            theCount.css('font-weight', 'bold');
                        } else {
                            theCount.css('font-weight', 'normal');
                            maximum.css('color', '#000000');
                            current.css('color', '#000000');
                        }
                    });

                    $(document).ready(function () { /*vypne enter a kopírování*/

                        $('textarea').keypress(function (event) {

                            if (event.keyCode == 13) {
                                event.preventDefault();
                            }
                        });
                        $('textarea').bind("cut copy paste", function (e) {
                            e.preventDefault();
                        });
                    })
                </script>
            </main>
            <?php include 'footer.php'; ?>
        </body>
    </html>
<?php } ?>