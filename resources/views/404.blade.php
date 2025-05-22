<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional styles if needed */
        .text {
            flex: 1 0 0%;
            margin-left: 12%;
            margin-top: 5%;

        }
        #color {
            font-weight: bold;
            color: rgb(135, 50, 131);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="text">
                    <h1>Page Not <span style="color: #fd7e14;">Found</span></h1>
                    <p>We can't seem to find the page you're looking for. Please check the URL for any typos.</p>
                    <ul class="menu">
                        <li><a href="/" id='color'>Go to Homepage</a></li>
                        <li><a href="/about" id='color'>Visit our Blog</a></li>
                        <li><a href="/contact" id='color'>Contact support</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <img class="image img-fluid" src="https://omjsblog.files.wordpress.com/2023/07/errorimg.png" alt="404" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
