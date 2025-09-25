<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Student CRUD</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #2c3e50, #4ca1af);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            width: 350px;
            text-align: center;
            color: #fff;
            animation: fadeIn 0.8s ease-in-out;
        }
        .login-container h2 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 25px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 12px 0;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .login-container input::placeholder {
            color: #ddd;
        }
        .login-container button {
            width: 100%;
            padding: 12px 15px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
        }
        .login-container button:hover {
            background-color: #1e7e34;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }
        .error {
            color: #ff6b6b;
            margin-bottom: 15px;
            font-size: 14px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
