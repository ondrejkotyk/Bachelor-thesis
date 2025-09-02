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

            // header
            function Header() {
                // Logo
                $this->Image('img/logo.png', 10, 6, 80);
                // blank space
                $this->Cell(80);
                // end of line
                $this->Ln(20);
            }

            // footer
            function Footer() {
                // 15 pixels from bottom
                $this->SetY(-15);
                $this->SetFont('Times', 'I', 8);
                // page number
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }

            //table header
            function headerTable() {
                $this->SetXY(25, 30);
                $this->SetFont('timesb', '', 14);
                $this->Cell(40, 10, 'Příjmení:');
                $this->SetFont('times', '', 14);

                $this->SetXY(47, 35);
                $this->Write(0, '_____________________');

                $this->SetXY(55, 34);
                $this->Write(0, $_SESSION['surname']);
                $this->SetFont('timesb', '', 14);

                $this->SetXY(105, 30);
                $this->Cell(40, 10, 'Ročník:');
                $this->SetFont('times', '', 14);

                $this->SetXY(122, 35);
                $this->Write(0, '________________________');

                $this->SetXY(128, 34);
                $this->Write(0, $_SESSION['year'] . "." . " Ročník");
                $this->Ln();

                $this->SetXY(25, 40);
                $this->SetFont('timesb', '', 14);
                $this->Cell(40, 10, 'Jméno:');
                $this->SetFont('times', '', 14);

                $this->SetXY(42, 45);
                $this->Write(0, '_______________________');

                $this->SetXY(48, 44);
                $this->Write(0, $_SESSION['name']);
                $this->SetFont('timesb', '', 14);

                $this->SetXY(105, 40);
                $this->Cell(40, 10, 'Studijní obor:');
                $this->SetFont('times', '', 14);

                $this->SetXY(135, 45);
                $this->Write(0, '___________________');

                $this->SetXY(136, 44);
                $this->SetFont('times', '', 12);
                $this->Write(0, $_SESSION['field']);
                $this->SetFont('times', '', 14);
                $this->Ln();

                $this->SetXY(25, 50);
                $this->SetFont('timesb', '', 14);
                $this->Cell(40, 10, 'Datum narození:');
                $this->SetFont('times', '', 14);

                $this->SetXY(60, 55);
                $this->Write(0, '________________');

                $this->SetXY(65, 54);
                $this->Write(0, $_SESSION['birth_date']);
                $this->SetFont('timesb', '', 14);

                $this->SetXY(105, 50);
                $this->Cell(40, 10, 'ID studia:');
                $this->SetFont('times', '', 14);

                $this->SetXY(127, 55);
                $this->Write(0, '______________________');

                $this->SetXY(135, 54);
                $this->Write(0, $_SESSION['study_id']);
                $this->Ln();

                $this->SetXY(25, 60);
                $this->SetFont('timesb', '', 14);
                $this->Cell(40, 10, 'Adresa:');
                $this->SetFont('times', '', 14);

                $this->SetXY(43, 65);
                $this->Write(0, '______________________');

                $this->SetXY(43, 65);
                $this->SetFont('times', '', 12);
                $this->Write(0, $_SESSION['street'] . " " . $_SESSION['house_number'] . " " . $_SESSION['city']);
                $this->SetFont('timesb', '', 14);

                $this->SetXY(105, 60);
                $this->Cell(40, 10, 'E-mail:');
                $this->SetFont('times', '', 14);

                $this->SetXY(122, 65);
                $this->Write(0, '________________________');

                $this->SetXY(123, 64);
                $this->SetFont('times', '', 13);
                $this->Write(0, $_SESSION['login']);
                $this->SetFont('times', '', 14);
                $this->Ln();

                $this->SetXY(25, 70);
                $this->SetFont('timesb', '', 14);
                $this->Cell(40, 10, 'PSČ:');
                $this->SetFont('times', '', 14);

                $this->SetXY(38, 75);
                $this->Write(0, '________________________');

                $this->SetXY(42, 74);
                $this->Write(0, $_SESSION['postcode']);
                $this->SetFont('timesb', '', 14);

                $this->SetXY(105, 70);
                $this->Cell(40, 10, 'Telefon:');
                $this->SetFont('times', '', 14);

                $this->SetXY(123, 75);
                $this->Write(0, '________________________');

                $this->SetXY(128, 74);
                $this->Write(0, $_SESSION['tel_number']);
                $this->Ln();
            }

            // inserting user data
            function maincontent() {
                $this->SetXY(40, 90);
                $this->SetFont('timesb', '', 24);
                $this->Write(0, 'ŽÁDOST O PŘESUN PŘEDMĚTU');
                $this->SetFont('times', '', 14);

                $this->SetXY(68, 100);
                $this->Write(0, 'Do');
                $this->SetXY(75, 100);
                $this->Write(0, '__________');
                $this->SetXY(80, 100);
                $this->Write(0, $_POST['rocnik']);
                $this->SetXY(100, 100);
                $this->Write(0, 'ročníku');

                $this->SetXY(20, 110);
                $this->SetFont('timesb', '', 14);
                $this->Cell(40, 10, 'Kód předmětu', 1, 0, 'C');
                $this->Cell(90, 10, 'Název předmětu', 1, 0, 'C');
                $this->Cell(40, 10, 'Semestr (LS/ZS)', 1, 0, 'C');
                $this->SetFont('times', '', 14);
                $this->Ln();

                $this->SetX(20);
                for ($i = 0; $i < $_POST['clicks']; $i++) {
                    $this->Cell(40, 10, $_POST['kod_predmetu' . $i], 1, 0, 'C');
                    $this->Cell(90, 10, $_POST['nazev_predmetu' . $i], 1, 0, 'C');
                    $this->Cell(40, 10, $_POST['semestr' . $i], 1, 0, 'C');
                    $this->Ln();
                    $this->SetX(20);
                }
            }

            //footer
            function endofpage() {
                $this->SetXY(35, 256);
                $this->Write(0, date("d.m.Y"));

                $this->SetXY(20, 260);
                $this->Write(0, '------------------------------------');

                $this->SetXY(38, 270);
                $this->Write(0, 'datum');

                $this->SetXY(130, 260);
                $this->Write(0, '------------------------------------');

                $this->SetXY(140, 256);
                $this->Write(0, 'digitálně podepsáno');

                $this->SetXY(142, 270);
                $this->Write(0, 'podpis studenta');
            }

        }

        $pdf = new PDF();

        $pdf->AddFont('times', '', 'times.ttf', true);
        $pdf->AddFont('timesb', '', 'timesbd.ttf', true);
        $pdf->SetFont('times', '', 14);

        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->headerTable();
        $pdf->maincontent();
        $pdf->endofpage();

        $path = './pdf/' . $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_presun' . '.pdf';
        $pdf->Output($path, 'F');

        $type = 'Přesun předmětu';
        $date = date("d.m.Y");
        $name = $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_presun';

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
                header('Location: ./presun_predmetu.php');
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
                <a href="./pdf/<?php echo $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_presun'; ?>.pdf" download="<?php echo $_SESSION['study_id'] . '_' . date("d.m.Y") . '_' . $_SESSION['time'] . '_presun' . '.pdf'; ?>"><img src="./img/pdf_img.png" alt="pdf icon" width="70" height="70">Stažení žádosti</a>
            </div>

            <div style="position:absolute;display:none;">
                <!--WZ-REKLAMA-1.0-->
            </div>

        </main>
<?php include 'footer.php'; ?>
    </body>
</html>
