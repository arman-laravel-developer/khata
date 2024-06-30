<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Marketing Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Email Marketing</a>
    <!-- You can add more navigation elements or buttons here -->
</nav>

<!-- Hero Section -->
<section class="jumbotron text-center">
    <div class="container">
        <h1>Welcome to Our Email Marketing Service</h1>
        <p class="lead">Create engaging email campaigns easily!</p>
        <a href="#signup" class="btn btn-primary btn-lg">Sign Up Now</a>
    </div>
</section>

<!-- Features Section -->
<section class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>Feature 1</h2>
            <p>Explanation or details about the feature.</p>
        </div>
        <div class="col-md-4">
            <h2>Feature 2</h2>
            <p>Explanation or details about the feature.</p>
        </div>
        <div class="col-md-4">
            <h2>Feature 3</h2>
            <p>Explanation or details about the feature.</p>
        </div>
    </div>
</section>

<!-- Sign Up Section -->
<section id="signup" class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Sign Up for Our Services</h2>
            <!-- Your sign-up form can go here -->
            <form>
                <!-- Form fields -->
                <div class="form-group">
                    <label for="emailInput">Email address</label>
                    <input type="email" class="form-control" id="emailInput" placeholder="name@example.com">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center py-4">
    <p>&copy; 2023 Your Email Marketing Company</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
