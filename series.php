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

$dataSeries = $pdo->prepare('SELECT *
        FROM netland.series 
        WHERE id = :id');
$dataSeries->execute(array(':id' => $_GET['id']));
$dataSeries = $dataSeries->fetchAll();

?>

<DOCTYPE html>
    <head>
    <title>Netfix series</title>
    </head>
    <body>
    <a href="http://localhost/php1.web/">Terug</a>
        <h1>
            <?php foreach($dataSeries as $row){
                echo $row['title'];
            } ?>
        </h1>
        <h4>
            <?php foreach($dataSeries as $row){
                echo "Awards?"." ".$row['has_won_awards']."<br />";
                echo "Seasons"." ".$row['seasons']."<br />";
                echo "Country"." ".$row['country']."<br />";
                echo "Language"." ".$row['language'];
            } ?>
        </h4>
        <h5>
            <?php foreach($dataSeries as $row){
                echo $row['description'];
            } ?>
        </h5>
    </body>
</html>