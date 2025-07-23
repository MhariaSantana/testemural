<?php
$conn = new mysqli("localhost", "root", "", "mural");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // senha segura

$sql = "INSERT INTO usuarios (nome, email, senha, primeiro_acesso) VALUES (?, ?, ?, TRUE)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha);
$stmt->execute();

// Retorna para tela de login
header("Location: index.php"); // index.php seria sua tela de login principal
?>