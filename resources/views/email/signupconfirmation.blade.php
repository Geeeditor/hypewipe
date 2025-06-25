<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HypeWipe Onboarding</title>
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
        .button {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #218838;
        }
        footer {
            margin-top: 30px;
            text-align: start;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to HypeWipe!</h1>
        <p>Hello <strong>{{$name}}</strong>,</p>
        <p>Congratulations! Your profile has been successfully created. As a token of our appreciation, your wallet has been topped up with <strong>$100</strong>. This allows you to explore our features while we prepare additional rewards just for you.</p>
        <p>Your referral code is: <strong>{{$referral_code}}</strong></p>
        <p>If you did not create this account, please reply to this email so we can terminate your profile.</p>
        <a href="{{ route('login') }}" class="button">Explore Now</a>
        <footer>
            <p>Regards,<br>HypeWipe Team</p>
        </footer>
    </div>
</body>
</html>
