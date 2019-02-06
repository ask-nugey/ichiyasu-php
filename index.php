<?php

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
  <h1>レシピの一覧</h1>
  <a href="form.php">レシピの新規登録</a>
  <table>
    <tr>
      <th>料理名</th>
      <th>予算</th>
      <th>難易度</th>
    </tr>
<?php foreach ($result as $row): ?>
    <tr>
      <td><?php echo htmlspecialchars($row['recipe_name']); ?></td>
      <td><?php echo htmlspecialchars($row['budget']); ?></td>
      <td><?php echo htmlspecialchars($row['difficulty']); ?></td>
      <td><a href="detail.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">詳細</a></td>
      <td>| <a href="edit.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">変更</a></td>
      <td>| <a href="delete.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">削除</a></td>
    </tr>
<?php endforeach; ?>
  </table>
<?php

?>
</body>
</html>
