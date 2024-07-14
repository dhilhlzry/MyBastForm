<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Code</title>
    <style>
        /* Style untuk memperbaiki tampilan di berbagai client email */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        h2 {
            color: #555;
        }
        p {
            color: #666;
        }
        .auth-code {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Authentication Code</h1>
        <p>Berikut adalah Password Anda:</p>
        <div class="auth-code">{{ $password }}</div>
        <p>Silakan gunakan Password ini untuk proses otentikasi di aplikasi kami.</p>
        <a href="/login" class="btn">Login</a>
    </div>
</body>
</html>
