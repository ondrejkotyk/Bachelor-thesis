<!DOCTYPE html>
<?php require('propojeni_databaze_local.php');
session_start();
?>
<html lang="cs">
    <head>
        <title>PEF - Elektornické dokumenty</title>
        <link rel="stylesheet" href="style.css">
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

            <div>
                <div id="signpost">
                    <div>
                        <div>
                            <h1><b>Vítejte na webu pro elektronické žádosti</b></h1>
                            <p id="introduction"> Tento web slouží pro elektronické podávání žádost Provozně ekonomické fakulty. Pro podání žádosti se prosím prvně přihlašte stejnými údaji jako používáte pro přihlášení do Univezitního informačního systému nebo MS moodle. Upozorňuji, že osobní údaje na tomto webu nelze měnit. Po přihlášení klikněte na jedno z tlačítek zde nebo využijte menu nahoře. Budete přesměrováni na stránku, kde po vás budou vyžadovány jenom nejnutnější informace. Systém poté vygeneruje pdf formuláře a zašle je patřiním osobám. Své zaslané žádosti naleznete kliknutím na své jméno v části "Moje žádosti".</p>
                            <button onclick="window.location.href = './uznani_predmetu.php'" class="bigbutt">Uznání předmětu</button>
                            <button onclick="window.location.href = './presun_predmetu.php'" class="bigbutt">Přesun předmětu</button>
                            <button onclick="window.location.href = './opakovani_rocniku.php'" class="bigbutt">Opakování ročníku</button>
                            <h2><b>Další formuláře</b></h2>
                            <div id="other">
                                <button onclick="window.location.href = './uni_zadost.php'" class="smallbutt">Univerzální žádost</button>
                                <button onclick="window.location.href = './prihlaska_promoce.php'" class="smallbutt">Přihláška k promoci</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="position:absolute;display:none;">
                <!--WZ-REKLAMA-1.0-->
            </div>

        </main>
<?php include 'footer.php'; ?>
    </body>
</html>
