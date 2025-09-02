<!DOCTYPE html>
<?php
require('propojeni_databaze_local.php');
session_start();
?>
<html lang="cs">
    <head>
        <title>PEF - Elektornické dokumenty </title>
        <link rel="stylesheet" href="prihlaseni_style.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <meta name="keywords" content="Provozně ekonomická fakulta, ČZU, uznávání žádostí, elektronické dokumenty, schvalování, uznání předmětu, opakování ročníku">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Systém pro uznávání elektronických žádostí Provozně ekonomické fakulty">
        <meta name="author" content="Ondřej Kotyk">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <main id="maincontent">
            <h1>Přihlašte se ke svému účtu</h1>
            <div id="sign_up">
                <form id="form" action="login.php" method="post">
                    <div class="imgcontainer">
                        <img src="./img/logo.png" height="130" width="120" alt="ukázky formulářů" class="avatar">
                    </div>

                    <div class="kontainer">
                        <h2>Přihlásit se</h2>
                        <p id="pozna">Pro přihlášení vyplňte pole níže.</p>
                        <label for="email"><b>Uživatelské jméno</b></label>
                        <input type="email" id="email" placeholder="xuzivatel001@studenti.czu.cz" name="email" required>

                        <label for="password"><b>Heslo</b></label>
                        <input type="password" id="password" placeholder="Heslo" name="password" required>

                        <button type="submit">Přihlásit se</button>
                    </div>

                    <div class="kontainer" style="background-color:#f1f1f1">
                        <span class="psw">Forgot <a href="#">password?</a></span>
                    </div>
                </form>
                <div id="images">
                    <div class="imgcontainer">
                        <div class="slider">
                            <ul class="slider__list">
                                <li id="first" class="slider__slide"><img src="./img/nahled_opakovani.jpg" alt="Slide 1"></li>
                                <li class="slider__slide"><img src="./img/nahled_presun.jpg" alt="Slide 2"></li>
                                <li class="slider__slide"><img src="./img/nahled_uni.jpg" alt="Slide 3"></li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div style="position:absolute;display:none;">
            <!--WZ-REKLAMA-1.0-->
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
