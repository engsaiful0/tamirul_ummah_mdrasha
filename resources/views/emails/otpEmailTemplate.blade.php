

<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body>
    <p>Hello, {{ $data['receiver_name'] }}</p>
    <p>OTP: {{ $data['otp'] }}</p>
    <p>User Name: {{ $data['user_name'] }}</p>
    <p>Email: {{ $data['user_email'] }}</p>
    <p>This OTP is valid for 5 minutes.</p>
    <!-- You can include more content here -->
</body>
</html>
