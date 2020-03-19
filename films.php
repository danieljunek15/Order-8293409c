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

$dataFilms = $pdo->prepare('SELECT *
        FROM netland.films 
        WHERE ID = :ID');
$dataFilms->execute(array(':ID' => $_GET['id']));
$dataFilms = $dataFilms->fetchAll();



?>

<DOCTYPE html>
    <head>
    <title>Netfix films</title>
    </head>
    <body>
        <a href="http://localhost/php1.web/">Terug</a>
        <h1>   
            <?php foreach ($dataFilms as $row){
                echo $row['title'];
            }?>
        </h1>
        <h4> 
            <?php foreach ($dataFilms as $row){
                echo 'Datum van uitkomst'.' '.$row['datum_van_uitkomst'].'.'."<br />";
                echo 'Land van uitkomst'.' '.$row['land_van_uitkomst'].'.';
            }?>
        </h4>
        <h5>
            <?php foreach ($dataFilms as $row){
                echo $row['omschrijfing'];
            }?>
        </h5>
            <?php foreach ($dataFilms as $row){
                $link = $row['trailer'];
                echo "<a href='".$link."'>Link for the trailer</a>";
            } ?>
    </body>
</html>