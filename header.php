<header>
    <div class="navbar">
        <a href="./index.php"><div class="logo"><img id="logo" src="./img/logo_b.png" alt="logo školy"><div id="logo_text">Provozně ekonomická fakulta</div></div></a>
        <nav class="nav-links">
            <input type="checkbox" id="checkbox_toggle">
            <label for="checkbox_toggle" class="hamburger">&#9776;</label>
            <!-- NAVIGATION MENU -->
            <div class="menu">
                <a href="./uznani_predmetu.php"><div>Uznání předmětu</div></a>
                <a href="./presun_predmetu.php"><div>Přesun předmětu</div></a>
                <div class="services">
                    <a>Další žádosti</a>
                    <!-- DROPDOWN MENU -->
                    <ul class="dropdown">
                        <li><a href="./uni_zadost.php">Univerzání žádost</a></li>
                        <li><a href="./opakovani_rocniku.php">Opakování ročníku</a></li>
                        <li><a href="./prihlaska_promoce.php">Přihláška k promoci</a></li>
                    </ul>
                </div>
                <?php if (isset($_SESSION['iduser'])) { ?>
                    <a href="./account.php"><div><?php
                            echo $_SESSION['name'];
                            echo ' ';
                            echo $_SESSION['surname'];
                            ?></div></a>
                <?php } ?>
                <?php if (!isset($_SESSION['iduser'])) { ?>
                    <a onclick="openForm()"><div>Přihlášení</div></a>
                <?php } ?>
            </div>
        </nav>
    </div>
    <div id="pozadi">         
        <div id="prihlaseni">
            <span onclick="closeForm()" id="exit">×</span>
            <div id="whitebck">
                <form id="login" action="login.php" method="POST">
                    <div class="container">
                        <h2>Přihlásit se</h2>
                        <p id="pozn">Pro přihlášení vyplňte pole níže.</p>
                        <hr>
                        <label for="e-mail"><b>Uživatelské jméno</b></label>
                        <input type="email" placeholder="xuzivatel001@studenti.czu.cz" id="e-mail" name="email" required>
                        <label for="w2"><b>Heslo</b></label>
                        <input id="w2" type="password" placeholder="Heslo" name="password" required>
                        <a id="forgotpass" href="/zapom_heslo.php" >Zapomněli jste heslo?</a>
                        <div id="hlaska"></div>
                        <button type="submit" id="signupbtn">Přihlásit se</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <script>
        function openForm() {
            document.getElementById("pozadi").style.display = "block";
        }
        function closeForm() {
            document.getElementById("pozadi").style.display = "none";
        }
    </script>
</header>

