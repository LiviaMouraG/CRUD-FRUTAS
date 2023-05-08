<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header('location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM cliente WHERE id * ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $stmt = $pdo->prepare('DELETE FROM cliente WHERE id = ?');
    $stmt->execute([$id]);

    header('location: listar.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Compromisso</title>
</head>
<body>
    <h1>Deletar Compromisso</h1>
    <p>Tem certeza que deseja deletar o compromisso de <?php echo $appointment['nome']; ?> em <?php echo date('d/m/Y', strtotime($appointment['data'])); ?> às <?php echo date('H:i', strtotime($appointment['hora'])); ?>?</p>
    <form method="post">
        <button type="submit">Sim</button>
        <a href="listar.php">Não</a>
</form>
</body>
</html>