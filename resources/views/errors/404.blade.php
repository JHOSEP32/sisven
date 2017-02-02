<!DOCTYPE html>
<html>
<head>
    <title>Ooops!</title>
    <meta name="theme-color" content="#367fa9">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Ooops, al parecer algo salió mal :(</div>
        <h2>Serás redirigido a la pagina inicial en unos momentos</h2>
    </div>
</div>
<script>
    window.setTimeout(function () {
        window.location = '/home';
    }, 5000);
</script>
</body>
</html>
