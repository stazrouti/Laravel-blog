<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        .code-container {
            background-color: #3490dc;
            color: #fff;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
        }
        .username{
            color:rgb(59 130 246);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verify Your Email Address</h2>
        <p>Welecom <span class="username">{{ $userEmail }}</span></p>
        <p>Welcome to our application. To complete your registration, please enter the following code:</p>
        
        <div class="code-container">
            {{ $verificationCode }}
        </div>

        <p>Note that unverified accounts are automatically deleted 30 days after signup.</p>

        <p>If you didn't request this, please ignore this email.</p>
        <p>Sincerely,</p>
        <p>Blog Team</p>
        <p><a href="mailto:support@blog.com">support@blog.com</a></p>
    </div>
</body>
</html>
