<?php require('propojeni_databaze_local.php'); ?>
<?php
for ($z = 0; $z <= 30; $z++) {
    $word = "search" . $z;
    $fillchange = "fill" . $z; //JS function that fill name to input
    $fillCode = "fillCode" . $z; //JS function that fill code to input
    ?>
    <?php
    if (isset($_POST[$word])) {
//Search box value assigning to $Name variable.
        $Name = $_POST[$word];
//Search query.
        $Query = "SELECT code,name FROM subject WHERE name LIKE '%$Name%' LIMIT 30";
//Query execution
        $ExecQuery = $conn->query($Query);
//Creating unordered list to display result.
        echo '
<ul style="overflow-y: auto;max-height:300px;">
   ';
        //Fetching result from database.
        while ($row = $ExecQuery->fetch()) {
            ?>
            <!-- Creating unordered list items.
                 Calling javascript function named as "fill" found in "script.js" file.
                 By passing fetched result as parameter. -->
            <li onclick='<?php echo $fillchange ?>("<?php echo $row['name']; ?>");<?php echo $fillCode ?>("<?php echo $row['code']; ?>");'>

                <!-- Assigning searched result in "Search box" in "search.php" file. -->

                <?php echo $row['name'];
                ?>
            </li>
            <li onclick='<?php echo $fillchange ?>("<?php echo $row['name']; ?>");<?php echo $fillCode ?>("<?php echo $row['code']; ?>");'><b><?php echo $row['code']; ?></b></li>
            <hr>
            <!-- Below php code is just for closing parenthesis. Don't be confused. -->
            <?php
        }
    }
    ?>

    </ul>

<?php } ?>


