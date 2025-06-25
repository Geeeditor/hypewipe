<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #555555;
            line-height: 1.6;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{$name}}!</h1>
        <p>We wanted to inform you that your account was accessed, find attached the details of the login activitiy.</p>
        <p><strong>Details of the login:</strong></p>
        <ul>
            <li><strong>IP Address:</strong> {{$ipAddress}}</li>
            <li><strong>City:</strong> {{$city}}</li>
            <li><strong>Country:</strong> {{$country}}</li>
        </ul>
        <p>If this was you, no action is needed. If you did not log in, please secure your account immediately.</p>
        <footer>
            <p>Regards,<br>HypeWipe Team</p>
        </footer>
    </div>
</body>
</html>
