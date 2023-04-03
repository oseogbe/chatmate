<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.4;
            padding: 2rem 1rem;
        }

        @media only screen and (min-width: 600px) {
            body {
                padding: 4rem 0;
                display: flex;
                flex-direction: column;
            }
        }

        .email-heading {
            color: #b44b81;
            text-align: center;
            font-size: 1.6rem;
            margin-bottom: 2em;
        }

        @media only screen and (min-width: 600px) {
            .email-content {
                text-align: center;
            }
        }

        .email-button {
            display: block;
            padding: 1rem;
            background: transparent;
            color: #b44b81;
            font-size: 16px;
            text-decoration: none;
            border: 1px solid #b44b81;
            border-radius: 8px;
        }

        @media only screen and (min-width: 600px) {
            .email-button {
                display: inline-block;
                padding: 1rem 4rem;
            }
        }
    </style>
</head>
<body>
    <h1 class="email-heading">{{ config('app.name') }}</h1>

    <div class="email-content">
        @yield('content')
    </div>
</body>
</html>
