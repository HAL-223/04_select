<?php

define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

try {
  $dbh = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//   $keyword = $_GET['keyword'];
$keyword = $_GET["keyword"];
echo $_GET["description"];
// $keyword = '%'.$keyword.'%';
$sql = "select * from animals where description like:keyword";

$sql = "select * from animals";

$stmt = $dbh->prepare($sql);

$stmt->execute();

$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
$keyword = '%'.$keyword.'%';
$stmt = $dbh->prepare("select * from animals where description like :keyword");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>本日のご紹介ペット！</h1>
  <p>
    <form action="" method="get">
      キーワード:<input type="text" name="description" placeholder="キーワードの入力">
      <input type="submit" value="検索">
    </form>
    <p>
      <!-- <?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?> -->
    </p>
  </p>
  <?php foreach ($animals as $animal) : ?>
  <?php echo $animal['type']. 'の' . $animal['classifcation']. 'ちゃん'. '<br>' . $animal['description']. '<br>' . $animal['birthday'].   ' ' . '生まれ'. '<br>' . '出身地'. ' ' . $animal['birthplace']. '<br>'. '<hr>'; ?>
  <?php endforeach;?>
</body>
</html>