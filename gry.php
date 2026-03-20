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

$result = mysqli_query($connection,$query);


while($dane = mysqli_fetch_array($result)){
    echo "<li>
    
$dane[nazwa]

    </li>
    
    <li>
    
$dane[punkty]

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

<?php

$connection = mysqli_connect($server, $user, $password, $database);

$query2 = "SELECT id,nazwa,zdjecie FROM gry;";

$result2 = mysqli_query($query2);

?>

</div>

<div class="right">

<h3>Dodaj nową grę</h3>

<form method="post">

<p>nazwa</p>
<input>

<p>opis</p>
<input>

<p>cena</p>
<input>

<p>zdjęcie</p>
<input>

<button type="submit">DODAJ</button>

</form>

</div>

<div class="foot">

<form method="post">

<input>
<button type="submit">Pokaż opis</button>

</form>

</div>

</body>
</html>