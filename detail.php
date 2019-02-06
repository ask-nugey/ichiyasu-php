<?php

$id = (int)$_GET['id'];

$user = "root";
$password = "root";

try {
    if (empty($id)) {
        throw new Exception('id不正');
    }

    $dbh = new PDO('mysql:host=localhost;dbname=recipe;charset=utf8', $user, $password);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM recipes WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($result);
} catch (Exception $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
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
  <br>
<?php
echo htmlspecialchars($result['recipe_name'], ENT_QUOTES, 'UTF-8')."<br>\n";
echo htmlspecialchars($result['category'], ENT_QUOTES, 'UTF-8')."<br>\n";
echo htmlspecialchars($result['difficulty'], ENT_QUOTES, 'UTF-8')."<br>\n";
echo htmlspecialchars($result['budget'], ENT_QUOTES, 'UTF-8')."<br>\n";
echo nl2br(htmlspecialchars($result['howto'], ENT_QUOTES, 'UTF-8'))."<br>\n";
?>
<a href="index.php">トップへ戻る</a>
</body>
</html>
