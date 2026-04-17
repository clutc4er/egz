<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gry komputerowe</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>

    <?php

    use Dom\Document;

    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'gry';

    $connection = mysqli_connect($server, $user, $password, $database);
    if ($connection = false) {
        echo 'error';
    } else {
        echo 'database is active';
    }


    ?>

    <div class="head">

        <h1>Ranking gier komputerowych</h1>

    </div>

    <div class="left">

        <h3>Top 5 gier w tym miesiącu</h3>

        <ul>

            <?php

            $connection = mysqli_connect($server, $user, $password, $database);

            $query = "SELECT nazwa,punkty FROM `gry` order by punkty DESC limit 5";

            $result = mysqli_query($connection, $query);


            while ($dane = mysqli_fetch_array($result)) {
                echo "<li>
    
$dane[nazwa]

    </li>
    
    <li class='pun'>
    
$dane[punkty]
,0
    </li>

    ";
            }

            ?>

        </ul>

        <h3>Nasz sklep</h3>

        <a href="http://sklep.gry.pl ">Tu kupisz gry</a>

        <h3>Stronę wykonal</h3>
        <p>johny jostar</p>

    </div>

    <div class="main">
        <section id="center">

            <?php

            $connection = mysqli_connect($server, $user, $password, $database);

            $query2 = "SELECT id,nazwa,zdjecie FROM gry;";

            $result2 = mysqli_query($connection, $query2);

            for ($i = 0; $i < mysqli_num_rows($result2); $i++) {
                $dane1 = mysqli_fetch_array($result2);
                $zdjecie = $dane1['zdjecie'];
                $nazwa = $dane1['nazwa'];
                echo "<img src='$zdjecie'>";
                echo "<p>$nazwa</p>";
            }
            ?>


        </section>
    </div>

    <div class="right">

        <h3>Dodaj nową grę</h3>

        <form method="post">

            <p>nazwa</p>
            <input name="nazwa">

            <p>opis</p>
            <input name="opis">

            <p>cena</p>
            <input name="cena">

            <p>zdjęcie</p>
            <input name="photo">

            <button type="submit">DODAJ</button>

            <?php
            $connection = mysqli_connect($server, $user, $password, $database);

            if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["nazwa"]) && isset($_POST["opis"]) && isset($_POST["cena"]) && isset($_POST["photo"])) {
                $nazwa = mysqli_real_escape_string($connection, $_POST["nazwa"]);
                $opis = mysqli_real_escape_string($connection, $_POST["opis"]);
                $cena = (float) $_POST["cena"];
                $photo = mysqli_real_escape_string($connection, $_POST["photo"]);

                $query4 = "INSERT INTO gry (nazwa, opis, punkty, cena, zdjecie) VALUES ('$nazwa', '$opis', 0, $cena, '$photo')";

                $result4 = mysqli_query($connection, $query4);
                if (!$result4) {
                    die("Bład");
                }
                echo "complete";
            }

            ?>

        </form>

    </div>

    <div class="foot">

        <form method="post">

            <input name="idgry">
            <button type="submit">Pokaż opis</button>
            <?php

            $connection = mysqli_connect($server, $user, $password, $database);

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idgry"])) {
                $temp = $_POST["idgry"];
                $query3 = "SELECT gry.nazwa, LEFT(gry.opis, 100) opis,gry.punkty, gry.cena FROM gry WHERE id = $temp;";

                $result3 = mysqli_query($connection, $query3);

                for ($i = 0; $i < mysqli_num_rows($result3); $i++) {

                    $dane3 = mysqli_fetch_array($result3);
                    $nazwa1 = $dane3['nazwa'];
                    $puntky = $dane3['punkty'];
                    $cena = $dane3['cena'];
                    echo "<h2>$nazwa1 $puntky $cena zl</h2>";
                }
            }
            ?>

        </form>

    </div>

</body>

</html>