<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'];
$password = $_POST['password'];
// Vérifiez les informations d'identification (utilisation de
// valeurs en dur pour les tests
if ($username === 'admin' && $password === 'password') {
$_SESSION['username'] = $username;
header('Location: dashboard.php');
exit();
} else {
$error_message = 'Identifiants incorrects';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
initial-scale=1.0">
<title>Login</title>

</head>
<body>

<h2>Login</h2>

<?php if (isset($error_message)) : ?>
<p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<form method="post" action="">
<label for="username">Username:</label>
<input type="text" name="username" required><br>
<label for="password">Password:</label>
<input type="password" name="password" required><br>
<button type="submit">Login</button>
</form>

</body>
</html>