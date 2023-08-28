<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f1f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px;
        }

        .logo {
            width: 150px;
            height: auto;
        }

        .content {
            padding: 30px 40px;
            color: #333333;
        }

        .button {
            display: inline-block;
            background-color: #845adf;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 3px;
        }

        .footer {
            text-align: center;
            color: #666666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="http://localhost:8000/assets/images/global/desktop-logo.png"
                alt="logo"
                class="logo">
        </div>
        <div class="content">
            <h2>Email Verification</h2>
            <p>Hello, {{ $datas['name'] }}!</p>
            <p>Thank you for signing up. To activate your account, please click the button below:</p>
            <a href="#"
                class="button">Verify Email</a>
            <p>If you didn't request this verification, you can ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; 2023 Ynex. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
