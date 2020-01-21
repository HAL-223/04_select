<?php

define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

try {
  $dbh = new PDO(DSN, USER, PASSWORD);
  // echo '接続に成功しました！' . '<br>';
} catch (PDOException $e) {
  // 接続がうまくいかない場合こちらの処理がなされる
  echo $e->getMessage();
  exit;
}