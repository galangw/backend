<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Storyku</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </script>
    <link href="/style.css" rel="stylesheet" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'ABeeZee', sans-serif;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-bold border-bottom bg-light">
                <h3>Storyku</h3>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/">Home</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/stories">Management
                    Story</a>

            </div>
        </div>
        <div id="page-content-wrapper">

            <div class="container m-5">
                @yield('content')

            </div>
        </div>
    </div>


</body>

</html>
