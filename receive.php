<?php
$recipe_name = $_POST['recipe_name'];
$category = (int)$_POST['category'];
$difficulty = (int)$_POST['difficulty'];
$budget = (int)$_POST['budget'];
$howto = $_POST['howto'];

$user = "root";
$password = "root";

try {
    $dbh = new PDO('mysql:host=localhost;dbname=recipe;charset=utf8', $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM recipes";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
} catch (Exception $e) {
    echo "エラー発生：".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    die();
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
<?php

echo htmlspecialchars($recipe_name, ENT_QUOTES, 'UTF-8');
echo "<br>";

if ($category === '1') {
    echo '和食';
} elseif ($category === '2') {
    echo '中華';
} else {
    echo '洋食';
}
echo "<br>";

if ($difficulty === '1') {
    echo '簡単';
} elseif ($difficulty === '2') {
    echo '普通';
} else {
    echo '難しい';
}
echo "<br>";

if (is_numeric($budget)) {
    echo number_format($budget);
}
echo "<br>";

echo nl2br(htmlspecialchars($howto, ENT_QUOTES, 'UTF-8'));
?>
</body>
</html>
