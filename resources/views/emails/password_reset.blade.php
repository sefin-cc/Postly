<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color:#151515;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Password Reset Confirmation</h2>
        <br>
        <p>Hello {{ $user->username }},</p>
        <p>Your password has been successfully reset!</p>
        <p>If you didn't request this reset, please contact our support team immediately.</p>
        <br>
        <p style="font-size: 12px; color: #2b2b2b;">Thank you,<br>The Support Team</p>
    </div>
</body>
</html>
