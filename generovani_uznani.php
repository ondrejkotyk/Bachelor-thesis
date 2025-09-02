<!DOCTYPE html>
<?php
require('propojeni_databaze_local.php');
session_start();
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
        <meta name="author" content="Ondřej Kotyk">
    </head>
    <body>
        <?php
        include 'header.php';
        require('FPDF/tfpdf/tfpdf.php');

        class PDF extends tfpdf {

            // Page header
            function Header() {
                // Logo
                $this->Image('img/logo.png', 10, 6, 80);
                $this->Ln(20);
            }

            function Hr() {
                $this->Cell(80);
                $this->SetXY(15, 24);
                $this->Write(0, '_________________________________________________________________________________________________________');
            }

            // Page footer
            function Footer() {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);

                $this->SetFont('Times', 'I', 8);
                // Page number
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }

            function headerTable() {
                $this->SetXY(35, 30);
                $this->SetFont('timesb', '', 12);
                $this->Cell(40, 10, 'Příjmení:');
                $this->SetFont('times', '', 12);
                $this->SetXY(54, 35);
                $this->Write(0, '...............................................................');
                $this->SetXY(61, 33);
                $this->Write(0, $_SESSION['surname']);
                $this->SetFont('timesb', '', 12);
                $this->SetXY(165, 30);
                $this->Cell(40, 10, 'Ročník:');
                $this->SetFont('times', '', 12);
                $this->SetXY(180, 35);
                $this->Write(0, '...............................................................................');
                $this->SetXY(188, 33);
                $this->Write(0, $_SESSION['year'] . "." . " Ročník");
                $this->Ln();

                $this->SetXY(35, 40);

                $this->SetFont('timesb', '', 12);
                $this->Cell(40, 10, 'Jméno:');
                $this->SetFont('times', '', 12);
                $this->SetXY(50, 45);
                $this->Write(0, '...................................................................');
                $this->SetXY(61, 43);
                $this->Write(0, $_SESSION['name']);
                $this->SetFont('timesb', '', 12);
                $this->SetXY(165, 40);
                $this->Cell(40, 10, 'Studijní obor:');
                $this->SetFont('times', '', 12);
                $this->SetXY(192, 45);
                $this->Write(0, '...................................................................');
                $this->SetXY(196, 43);
                $this->Write(0, $_SESSION['field']);
                $this->Ln();

                $this->SetXY(35, 50);

                $this->SetFont('timesb', '', 12);
                $this->Cell(40, 10, 'Datum narození:');
                $this->SetFont('times', '', 12);
                $this->SetXY(67, 55);
                $this->Write(0, '...................................................');
                $this->SetXY(73, 53);
                $this->Write(0, $_SESSION['birth_date']);
                $this->SetFont('timesb', '', 12);
                $this->SetXY(165, 50);
                $this->Cell(40, 10, 'ID studia:');
                $this->SetFont('times', '', 12);
                $this->SetXY(184, 55);
                $this->Write(0, '...........................................................................');
                $this->SetXY(192, 53);
                $this->Write(0, $_SESSION['study_id']);
                $this->Ln();

                $this->SetXY(25, 60);
            }

         /*   function data() {
                
            }
         */
            function maincontent() {
                $this->SetXY(80, 64);
                $this->SetFont('timesb', '', 19);
                $this->Write(0, 'Žádost o uznání vykonaných zkoušek a zápočtů');
                $this->SetFont('times', '', 11);
                $this->SetXY(107, 72);
                $this->Write(0, 'pro akademický rok');
                $this->SetXY(139, 72);
                $this->Write(0, '...................................................');
                $this->SetXY(150, 71);
                $this->Write(0, $_POST['rocnik']);
                $this->SetXY(45, 80);
                $this->SetFont('timesb', '', 11);
                $this->Write(0, 'Žádám o uznání uvedených zkoušek a zápočtů z České zemědělské univerzity v Praze fakulty Provozně ekonomické, ');
                $this->SetXY(45, 86);
                $this->SetFont('timesb', '', 11);
                $this->Write(0, 'které jsem vykonal/a v předchozím studiu bakalářského/magisterského* programu/oboru ');
                $this->SetFont('times', '', 11);
                $this->Write(0, '.................................................................');
                $this->SetXY(196, 85);
                $this->Write(0, $_SESSION['field']);
                $this->SetXY(20, 95);
                $this->SetFont('timesb', '', 11);
                $this->SetLineWidth(0.4);
                $this->Cell(70, 18, 'Název a kód předmětu', 1, 0, 'C');
                $this->Cell(35, 18, 'Datum vykonání', 1, 0, 'C');
                $this->Cell(35, 18, 'Klasifikace', 1, 0, 'C');
                $this->Cell(45, 18, 'Vyjádření katedry', 1, 0, 'C');
                $this->Cell(70, 18, 'Potvrzení katedry', 1, 0, 'C');
                $this->SetFont('times', '', 11);
                $this->Ln();
                $this->SetXY(207, 109);
                $this->SetFont('times', '', 9);
                $this->Write(0, '(datum, podpis odpovědného vyučujícího, razítko)');
                $t1 = 128;
                $t2 = 132;
                for ($x = 0; $x <= 2; $x++) {
                    $this->SetXY(173, $t1);
                    $this->Write(0, '- doporučuji*');
                    $this->SetXY(173, $t2);
                    $this->Write(0, '- nedoporučuji*');
                    $t1 = $t1 + 24;
                    $t2 = $t2 + 24;
                }
                $this->SetFont('times', '', 11);
                $z = 100;
                $i = 108;
                $o = 100;
                $n = 93;
                for ($y = 0; $y < $_POST['clicks'] & $y < 3; $y++) {
                    $z = $z + 24;
                    $i = $i + 24;
                    $o = $o + 24;
                    $n = $n + 24;
                    $this->SetXY(30, $n);
                    $this->MultiCell(59, 5, $_POST['nazev_predmetu' . $y], 0);
                    $this->SetXY(98, $z);
                    $this->Write(0, $_POST['date' . $y]);
                    $this->SetXY(43, $i);
                    $this->Write(0, $_POST['kod_predmetu' . $y]);
                    $this->SetXY(133, $o);
                    $this->Write(0, $_POST['mark' . $y]);
                }

                $this->SetXY(20, 112);
                $this->SetLineWidth(0.2);
                for ($x = 0; $x <= 7; $x++) {
                    $this->Cell(70, 24, '', 1, 0, 'C');
                    $this->Cell(35, 24, '', 1, 0, 'C');
                    $this->Cell(35, 24, '', 1, 0, 'C');
                    $this->Cell(45, 24, 'Uznání tohoto výsledku', 1, 0, 'C');
                    $this->Cell(70, 24, '', 1, 0, 'C');
                    $this->Ln();
                    $this->SetX(20);
                }
                /* Tady dolu upravujes druhou stranu (myslim xd) */
                $this->SetFont('times', '', 9);
                $t1 = 51;
                $t2 = 46;
                for ($x = 0; $x <= 4; $x++) {
                    $this->SetXY(173, $t1);
                    $this->Write(0, '- doporučuji*');
                    $this->SetXY(173, $t2);
                    $this->Write(0, '- nedoporučuji*');
                    $t1 = $t1 + 24;
                    $t2 = $t2 + 24;
                }
                $this->SetFont('times', '', 11);
                $z = 18;
                $i = 27;
                $o = 18;
                $n = 10;
                for ($y = 3; $y < $_POST['clicks'] & $_POST['clicks'] > 3; $y++) {
                    $z = $z + 24;
                    $i = $i + 24;
                    $o = $o + 24;
                    $n = $n + 24;
                    $this->SetXY(30, $n);
                    $this->MultiCell(59, 5, $_POST['nazev_predmetu' . $y], 0);
                    $this->SetXY(98, $z);
                    $this->Write(0, $_POST['date' . $y]);
                    $this->SetXY(43, $i);
                    $this->Write(0, $_POST['kod_predmetu' . $y]);
                    $this->SetXY(133, $o);
                    $this->Write(0, $_POST['mark' . $y]);
                }
            }

            function endofpage() {
                $this->SetXY(52, 170);
                $this->Write(0, date("d.m.Y"));
                $this->SetXY(39, 173);
                $this->Write(0, '------------------------------------');
                $this->SetXY(54, 176);
                $this->Write(0, 'datum');
                $this->SetXY(198, 173);
                $this->Write(0, '------------------------------------');
                $this->SetXY(205, 170);
                $this->Write(0, 'digitálně podepsáno');
                $this->SetXY(207, 176);
                $this->Write(0, 'podpis studenta');
            }

        }

        $pdf = new PDF();

        $pdf->AddFont('times', '', 'times.ttf', true);
        $pdf->AddFont('timesb', '', 'timesbd.ttf', true);
        $pdf->SetFont('times', '', 14);

        $pdf->AliasNbPages();
        $pdf->AddPage("L", "A4");
        $pdf->Hr();
        $pdf->headerTable();
        $pdf->maincontent();
        //$pdf->data();
        $pdf->endofpage();

        $path = './pdf/' . $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_uznani' . '.pdf';
        $pdf->Output($path, 'F');

        $type = 'Uznání předmětu';
        $date = date("d.m.Y");
        $name = $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_uznani';

        $exists = "SELECT count(*) from history WHERE name = '" . $name . "';";
        $count = $conn->query($exists)->fetchColumn();

        if ($count == 1) {
            //do nothing
        } else {
            $sql = $conn->prepare("INSERT INTO history (date_of_creation,name,type,link,user_iduser) VALUES (:date,:name,:type,:link,:id);");
            $sql->bindParam(':date', $date);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':type', $type);
            $sql->bindParam(':link', $path);
            $sql->bindParam(':id', $_SESSION['iduser']);
            $sql->execute();

            $sql3 = "SELECT idhistory FROM history WHERE link = '" . $path . "'";
            $overeni = $conn->query($sql3);
            $row = $overeni->fetch();

            try {
                for ($i = 0; $i < $_POST['clicks']; $i++) {
                    $sql2 = $conn->prepare("INSERT INTO history_has_subject (history_idhistory,subject_code,checked) VALUES (:history,:subject_code,'0');");
                    $sql2->bindParam(':history', $row['idhistory']);
                    $sql2->bindParam(':subject_code', $_POST['kod_predmetu' . $i]);
                    $sql2->execute();
                }
            } catch (Throwable $e) {
                header('Location: ./uznani_predmetu.php');
            }
        }
        ?>

        <main id="maincontent">
            <h1>Formulář úspěšně vygenerován</h1>
            <p id="notice">Formulář byl úspěšně vygenerován a záslán na studijní oddělení PEF.</p>
            <div id="navigation">
                <button onclick="window.open('<?php echo $path; ?>', '_blank')">Náhled PDF ke schválení</button>
                <button onclick="window.location.href = './index.php'">Zpět na hlavní stránku</button>
                <button onclick="window.location.href = './account.php'">Přehled mých žádostí</button>
            </div>
            <div id="download">
                <a href="./pdf/<?php echo $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_uznani'; ?>.pdf" download="<?php echo $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_uznani' . '.pdf'; ?>"><img src="./img/pdf_img.png" alt="pdf icon" width="70" height="70">Stažení žádosti</a>
            </div>

            <div style="position:absolute;display:none;">
                <!--WZ-REKLAMA-1.0-->
            </div>

        </main>
<?php include 'footer.php'; ?>
    </body>
</html>
