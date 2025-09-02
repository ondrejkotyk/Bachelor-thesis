<!DOCTYPE html>
<?php
require('propojeni_databaze_local.php');
session_start();
?>
<html lang="cs">
    <head>
        <title>PEF - Elektornické dokumenty </title>
        <link rel="stylesheet" href="promoce_style.css">
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

            <div id="form">
                <h1><b>ZÁVAZNÁ PŘIHLÁŠKA K PROMOCI</b></h1>
                <p class="notice">Přihlášku podejte vyplněním formuláře níže.</p>
                <div id="navigation">
                    <button onclick="window.open('./pdf/prihlaska-promoce-active.pdf', '_blank')"><img src="./img/pdf_img.png" alt="pdf icon" width="40" height="40"><p>Otevřít PDF formulář k promoci</p></button>
                </div>
                <h2>Postup:</h2>
                <p class="notice">1. Vyplňte formulář</p>
                <div id="guide">
                    <img src="./img/first.jpg" alt="pdf icon" width="600" height="600">
                </div>
                <p class="notice">2. Vytiskněte formulář</p>
                <div id="print">
                    <img src="./img/second.jpg" alt="pdf icon" width="500" height="300">
                    <img src="./img/second2.jpg" alt="pdf icon" width="500" height="300">
                </div>
                <p class="notice">3. Podepište a odevzdejte osobně nebo emailem svojí studijní referentce</p>
                <div id="linkdiv">
                    <button id="link" onclick="window.open('https://www.pef.czu.cz/cs/r-7008-studium/r-7025-studijni-oddeleni', '_blank')">Odkaz na studijní oddělení</button>
                </div>
            </div>
            <div style="position:absolute;display:none;">
                <!--WZ-REKLAMA-1.0-->
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </body>
</html>
