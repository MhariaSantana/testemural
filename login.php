<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mural");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou usuário com o email
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verifica se a senha está correta
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: postagens.php");
        exit;
    } else {
        echo "❌ Senha incorreta.";
    }

} else {
    echo "⚠️ Usuário não encontrado. Faça seu cadastro.";
}
?>