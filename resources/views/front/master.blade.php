<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hisab Khata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .card {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem 0;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome to Hisab Khata</h1>
    <p>Your Personal Finance Manager</p>
</header>

<nav>
    <a href="{{route('home')}}">Home</a>
    <a href="{{route('login')}}">Login</a>
    <a href="javascript:void (0)">About</a>
    <a href="javascript:void (0)">Contact</a>
</nav>

<div class="container">
    <div class="card">
        <h2>Track Your Expenses</h2>
        <p>Hisab Khata helps you keep track of your daily expenses with ease. Simply input your expenses and let us do the rest.</p>
    </div>

    <div class="card">
        <h2>Manage Your Budget</h2>
        <p>Set a budget and monitor your spending to ensure you stay within your limits. Hisab Khata provides insights to help you manage your finances better.</p>
    </div>

    <div class="card">
        <h2>Generate Reports</h2>
        <p>Generate detailed reports to understand your spending habits and make informed decisions about your finances.</p>
    </div>
</div>

<footer>
    <p>&copy; 2024 Hisab Khata. All rights reserved.</p>
</footer>
</body>
</html>
