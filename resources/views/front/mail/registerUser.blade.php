<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registered User Details</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .user-details {
            margin-top: 20px;
        }

        .user-details p {
            margin: 10px 0;
        }

        .user-details p strong {
            font-weight: bold;
            margin-right: 10px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-message">
            <p>A new user with the email <strong>{{ $member->email }}</strong> has been successfully registered.</p>
        </div>
        <h1>Registered User Details</h1>
        <div class="user-details">
            <p><strong>Name:</strong> {{ $member->name }}</p>
            <p><strong>Email:</strong> {{ $member->email }}</p>
            <p><strong>Phone:</strong> {{ $member->mobileno }}</p>
            <p><strong>Address:</strong> {{ $member->address }}</p>
        </div>
    </div>
</body>

</html>
