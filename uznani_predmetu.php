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
            <link rel="stylesheet" href="uznani_style.css">
            <link rel="stylesheet" href="header.css">
            <link rel="stylesheet" href="footer.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <meta charset="UTF-8">
            <meta name="keywords" content="Provozně ekonomická fakulta, ČZU, uznávání žádostí, elektronické dokumenty, schvalování, uznání předmětu, opakování ročníku">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Systém pro uznávání elektronických žádostí Provozně ekonomické fakulty">
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
            <link rel="shortcut icon" href="obrazky/favicon.ico" type="image/x-icon">
            <meta name="author" content="Ondřej Kotyk">
        </head>
        <body>
            <?php include 'header.php'; ?>
            <main id="maincontent">
                <div>
                    <div id="signpost">
                        <div>
                            <div id="form">
                                <h1><b>ŽÁDOST O UZNÁNÍ VYKONANÝCH ZKOUŠEK A ZÁPOČTŮ</b></h1>
                                <p id="warning"><b>!POZOR!</b></p>
                                <p id="notice"> Formulář je pouze pro předměty vystudované na PEF!</p>
                                <form method="POST" action="generovani_uznani.php">
                                    <table width="100%">
                                        <tr>
                                            <td width="35%" id="blank"></td>
                                            <td width="30%" id="year">
                                                <h4><b>Pro akademický rok:</b></h4>
                                                <select name="rocnik">
                                                    <?php $y = 0; ?>
                                                    <?php for ($x = 1; $x <= 3; $x++) { ?>
                                                        <option value="<?php
                                                        echo date("Y") + $y;
                                                        echo'/';
                                                        echo date("Y") + $x;
                                                        ?>"><?php
                                                                    echo date("Y") + $y;
                                                                    echo'/';
                                                                    echo date("Y") + $x;
                                                                    ?></option>
                                                        <?php
                                                        $y++;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td id="img">
                                                <span id="preview">
                                                    <h4>Náhled dokumentu</h4>
                                                    <img src="./img/nahled_uznani.jpg" width="200px" height="150px" alt="document_preview"/>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                    <table id="subjects">
                                        <tr class="next" id="prvni">
                                            <td>
                                                <h4><b>Kód předmětu:</b></h4>
                                                <input type="text" id="code0" name="kod_predmetu0" placeholder="Např. EXE05Z" value="" required>
                                                <div class="displaj" id="displej0"></div>
                                            </td>
                                            <td>
                                                <h4><b>Název předmětu:</b></h4>
                                                <input type="text" id="search0" placeholder="Název předmětu" name="nazev_predmetu0"/>
                                                <div class="displaj" id="display0"></div>
                                            </td>
                                            <td>
                                                <h4><b>Datum vykonání:</b></h4>
                                                <input type="date" id="date0" name="date0">
                                            </td>
                                            <td>
                                                <h4><b>Klasifikace:</b></h4>
                                                <select name="mark0" required>
                                                    <option value="" selected disabled hidden>Vyberte zde</option>
                                                    <option value="Započteno">Započteno (Z)</option>
                                                    <option value="Výborně">Výborně (1)</option>
                                                    <option value="Velmi dobře">Velmi dobře (2)</option>
                                                    <option value="Dobře">Dobře (3)</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <?php for ($x = 1; $x <= 8; $x++) { ?>                                                 
                                            <tr class="next">
                                                <td>
                                                    <h4><b>Kód předmětu:</b></h4>
                                                    <input type="text" id="<?php echo "code$x" ?>" placeholder="Např. EXE05Z" name="<?php echo "kod_predmetu$x" ?>" value="">
                                                    <div class="displaj" id="<?php echo "displej$x" ?>"></div>
                                                </td>
                                                <td>
                                                    <h4><b>Název předmětu:</b></h4>
                                                    <input type="text" id="<?php echo "search$x" ?>" placeholder="Název předmětu" name="<?php echo "nazev_predmetu$x" ?>">
                                                    <div class="displaj" id="<?php echo "display$x" ?>"></div>
                                                </td>
                                                <td>
                                                    <h4><b>Datum vykonání:</b></h4>
                                                    <input type="date" id="<?php echo "date$x" ?>" name="<?php echo "date$x" ?>">
                                                </td>
                                                <td>
                                                    <h4><b>Klasifikace:</b></h4>
                                                    <select name="<?php echo "mark$x" ?>">
                                                        <option value="" selected disabled hidden>Vyberte zde</option>
                                                        <option value="Započteno">Započteno (Z)</option>
                                                        <option value="Výborně">Výborně (1)</option>
                                                        <option value="Velmi dobře">Velmi dobře (2)</option>
                                                        <option value="Dobře">Dobře (3)</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>                                      
                                        <input id="numberofpredmetos" type="hidden" name="clicks" value="1">
                                    </table>
                                    <div id="add_subjects" onclick="myFunction();countclicks()"><img id="nextbtn" src="./img/plus.png" width="40px" height="40px" alt="addsubjects"/><p>Přidat další předmět</p></div>
                                    <input type="submit" value="Odeslat žádost">
                                </form>
                                <hr>
                                <p><b>*Pro uznání předmětu z jiné fakulty/univerzity musíte nechat vyplnit formulář (uvedený níže) na univerzitě a přinést ho na studijní oddělení osobně nebo zaslat emailem.</b></p>
                                <div id="download">
                                    <a href="./pdf/uznani.pdf" download="formular_uznani"><img src="./img/pdf_img.png" alt="pdf icon" width="50" height="50">Stažení žádosti pro osobní vyplnění</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var clicks = 1;
                    function countclicks() {
                        clicks += 1;
                        var s = document.getElementById("numberofpredmetos");
                        s.value = clicks;
                        if (clicks >= 8) {
                            document.getElementById("add_subjects").style.display = "none";
                        }
                    }
                    function myFunction() {
                        var lolko = document.getElementsByClassName('next');

                        function myFunction1(x) {
                            if (x.matches) {
                                lolko[clicks].style.display = "grid";
                            } else {
                                lolko[clicks].style.display = "block";
                            }
                        }

    // Create a MediaQueryList object
                        const mmObj = window.matchMedia("(max-width: 800px)");

    // Call the match function at run time:
                        myFunction1(mmObj);

    // Add the match function as a listener for state changes:
                        mmObj.addListener(myFunction1);
                    }


                    /*AJAX --------------------------------------------------------*/
    <?php for ($x = 0; $x <= 8; $x++) { ?>
                        function fill<?php echo $x; ?>(Value) {
                            //Assigning value to "search" div in "search.php" file.
                            $('#search<?php echo $x; ?>').val(Value);
                            $('#<?php echo $x; ?>').val(Value);
                            //Hiding "display" div in "search.php" file.
                            $('#display<?php echo $x; ?>').hide();
                        }
                        function fillCode<?php echo $x; ?>(Value) {
                            //Assigning value to "search" div in "search.php" file.
                            $('#code<?php echo $x; ?>').val(Value);
                        }

    <?php } ?>

    <?php for ($o = 0; $o <= 8; $o++) { ?>
                        function fill2<?php echo $o; ?>(Value) {
                            //Assigning value to "code" div in "ajax1.php" file.
                            $('#code<?php echo $o; ?>').val(Value);
                            $('#<?php echo $o; ?>').val(Value);
                            //Hiding "display" div in "search.php" file.
                            $('#displej<?php echo $o; ?>').hide();
                        }
                        function fillname<?php echo $o; ?>(Value) {
                            //Assigning value to "search" div in "search.php" file.
                            $('#search<?php echo $o; ?>').val(Value);
                        }

    <?php } ?>

    <?php for ($y = 0; $y <= 8; $y++) { ?>
                        $(document).ready(function () {
                            //On pressing a key on "Search box" in "search.php" file. This function will be called.
                            $("#search<?php echo $y; ?>").keyup(function () {
                                //Assigning search box value to javascript variable named as "name".
                                var name = $('#search<?php echo $y; ?>').val();
                                //Validating, if "name" is empty.
                                if (name == "") {
                                    //Assigning empty value to "display" div in "search.php" file.
                                    $("#display<?php echo $y; ?>").html("");
                                }
                                //If name is not empty.
                                else {
                                    //AJAX is called.
                                    $.ajax({
                                        //AJAX type is "Post".
                                        type: "POST",
                                        //Data will be sent to "ajax.php".
                                        url: "ajax.php",
                                        //Data, that will be sent to "ajax.php".
                                        data: {
                                            //Assigning value of "name" into "search" variable.
                                            search<?php echo $y; ?>: name
                                        },
                                        //If result found, this funtion will be called.
                                        success: function (html) {
                                            //Assigning result to "display" div in "search.php" file.
                                            $("#display<?php echo $y; ?>").html(html).show();
                                        }
                                    });
                                }
                            });
                        });
    <?php } ?>

    <?php for ($p = 0; $p <= 8; $p++) { ?>
                        $(document).ready(function () {
                            //On pressing a key on "Search box" in "search.php" file. This function will be called.
                            $("#code<?php echo $p; ?>").keyup(function () {
                                //Assigning search box value to javascript variable named as "name".
                                var name = $('#code<?php echo $p; ?>').val();
                                //Validating, if "name" is empty.
                                if (name == "") {
                                    //Assigning empty value to "display" div in "ajax.php" file.
                                    $("#displej<?php echo $p; ?>").html("");
                                }
                                //If name is not empty.
                                else {
                                    //AJAX is called.
                                    $.ajax({
                                        //AJAX type is "Post".
                                        type: "POST",
                                        //Data will be sent to "ajax.php".
                                        url: "ajax1.php",
                                        //Data, that will be sent to "ajax.php".
                                        data: {
                                            //Assigning value of "name" into "search" variable.
                                            code<?php echo $p; ?>: name
                                        },
                                        //If result found, this funtion will be called.
                                        success: function (html) {
                                            //Assigning result to "display" div in "search.php" file.
                                            $("#displej<?php echo $p; ?>").html(html).show();
                                        }
                                    });
                                }
                            });
                        });
    <?php } ?>
    // hide search bar when clicking away
                    $("body").click
                            (
                                    function (e)
                                    {
                                        if (e.target.className !== "displaj")
                                        {
                                            $(".displaj").hide();
                                        }
                                    }
                            );
                </script>

                <div style="position:absolute;display:none;">
                    <!--WZ-REKLAMA-1.0-->
                </div>

            </main>
            <?php include 'footer.php'; ?>
        </body>
    </html>
<?php } ?>