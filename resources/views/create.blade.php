
<!DOCTYPE html>
<html>
<head>
    <title>New Task</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

    </style>
</head>
<body>
<div class="container">
    <form method="POST" action="/">
        {{csrf_field()}}
        <textarea name="task"></textarea><br>
        <button type="submit">Add Task</button>
    </form>
</div>
</body>
</html>
