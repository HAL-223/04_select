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



// $keyword = '%'.$keyword.'%';
// $stmt = $dbh->prepare("select * from animals where description like :keyword");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $keyword = $_GET['keyword']; 

  if ($keyword == '') {
  $sql = "select * from animals";
  $stmt = $dbh->prepare($sql);
} else {
  $sql = "select * from animals where description like :keyword";
  $stmt = $dbh->prepare($sql);
  $keyword_param = '%' . $keyword . '%';
  $stmt -> bindParam(":keyword", $keyword_param);
}
  $stmt->execute();
  
  $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


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
      キーワード:<input type="text" name="keyword" placeholder="キーワードの入力">
      <input type="submit" value="検索">
    </form>
  </p>
  <?php foreach ($animals as $animal) : ?>
  <?php echo $animal['type']. 'の' . $animal['classifcation']. 'ちゃん'. '<br>' . $animal['description']. '<br>' . $animal['birthday'].   ' ' . '生まれ'. '<br>' . '出身地'. ' ' . $animal['birthplace']. '<br>'. '<hr>'; ?>
  <?php endforeach;?>
</body>
</html>