<?php 
include './index.php'; 
?>
<html>
    <body>
        <script>
            var chyba = document.getElementById('w2');
            var chyba1 = document.getElementById('e-mail');
            document.getElementById("pozadi").style.display = "block";
            chyba1.style.border = "1px solid red";
            chyba.style.border = "1px solid red";
            document.getElementById("hlaska").innerHTML = "Přihlašovací údaje jsou nesprávné !!!";
            document.getElementById("exit").onclick = function () {
                window.location.replace("./index.php");
            };
        </script>
    </body>
</html>
