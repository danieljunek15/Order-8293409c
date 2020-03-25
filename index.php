<?php
$host = 'localhost';
$db = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$dataFilms = $pdo->query('SELECT * FROM netland.films')->fetchAll();
$dataSeries = $pdo->query('SELECT * FROM netland.series')->fetchAll();

if(isset($_GET['ID'])){
    if($_GET['ID'] == 1){
        $dataSeries = $pdo->query('SELECT * FROM netland.series ORDER BY title')->fetchAll();
    }elseif ($_GET['ID'] == 2){
        $dataSeries = $pdo->query('SELECT * FROM netland.series ORDER BY rating DESC')->fetchAll();
    }

    if($_GET['ID'] == 3){
        $dataFilms = $pdo->query('SELECT * FROM netland.films ORDER BY title')->fetchAll();
    }elseif ($_GET['ID'] == 4){
        $dataFilms = $pdo->query('SELECT * FROM netland.films ORDER BY duur DESC')->fetchAll();
    }
}
?>

<DOCTYPE html>
<head>
<title>Netfix 2.0</title>
</head>
<body>

<h1>Welkom bij Netfix de enige echte fix streamer</h1>
<h2>Series</h2>
<table>
    <tr>
        <th><a href="http://localhost/php1.web/index.php?ID=1">Titel</a></th>
        <th><a href="http://localhost/php1.web/index.php?ID=2">Rating</a></th>
    </tr>
    <tr>
        <td>  
            <?php foreach ($dataSeries as $row){
                echo $row['title'] . "<br />\n";
            } ?>
        </td>
        <td>
            <?php foreach ($dataSeries as $row){
                echo $row['rating'] . "<br />\n";
            } ?>
        </td>
        <td>
        <?php foreach($dataSeries as $row){
            echo "<a href='http://localhost/php1.web/series.php?id=" . $row['id'] . "'>Bekijk details</a><br>";
        } ?>
            
        <?php  ?>
        </td>
    </tr>
</table>


<h2>Films</h2>
<table>
    <tr>
        <th><a href="http://localhost/php1.web/index.php?ID=3">Titel</a></th>
        <th><a href="http://localhost/php1.web/index.php?ID=4">Duur</a></th>
    </tr>
    <tr>
        <td>
            <?php foreach ($dataFilms as $row){
                echo $row['title'] . "<br />\n";
            } ?>
        </td>
        <td>
            <?php foreach ($dataFilms as $row){
                echo $row['duur'] . "<br />\n";
            } ?>
        </td>
        <td>
        <?php foreach($dataFilms as $row){
            echo "<a href='http://localhost/php1.web/films.php?id=" . $row['ID'] . "'>Bekijk details</a><br>";
        } ?>
        </td>
    </tr>
</table>

</body>
</html>