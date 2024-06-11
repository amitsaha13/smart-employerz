<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops! | {{ config('app.name') }}</title>

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 200px;
            height: auto;
        }

        .error-box {
            max-width: 400px;
            margin: auto;
        }

        .error-box h1 {
            font-size: 48px;
            color: #00756A;
        }

        .error-box p {
            font-size: 18px;
            color: #666;
            margin: 20px 0;
        }

        .home-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #00756A;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .home-button:hover {
            background-color: #00756A;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <a href="/"><img src="{{ asset('img/logo/logo.png') }}" alt="Logo"></a>
        </div>
        <div class="error-box">
            <h1>Oops!</h1>
            <p>Something went wrong. Please try again later.</p>
            <a href="/" class="home-button">Go to Homepage</a>
        </div>
    </div>
</body>

</html>
