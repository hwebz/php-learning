<?php 
    session_start();

    include_once '../utils/constants.php';
    include_once '../includes/connection.php';
    include_once 'user.php';

    $errors = [];

    if (isset($_SESSION['logged_in'])) {
        header('Location: dashboard.php');
        exit();
    } else {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username'], $_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (empty($username) || empty($password)) {
                    $errors[] = "Username and password are required!";
                } else {
                    $user = new User;

                    $isLoggedIn = $user->login($username, md5($password));
                    if ($isLoggedIn) {
                        $_SESSION['logged_in'] = true;
                        header('Location: dashboard.php');
                        exit();
                    }
                    $errors[] = "Username (and/or) password (are/is) invalid!";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple CMS - Dashboard</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="assets/style.css" rel="stylesheet">
</head>

<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Dashboard</a>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <a href="../" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-circle-arrow-left"></span> Back to front-page</a><br><br>

                <?php 
                    if (!empty($errors)) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                <?php 
                                    foreach($errors as $error) {
                                        ?>
                                        <li><?php echo $error ?></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                ?>
                

                <form action="" class="form-signin" method="post">
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <label for="inputEmail" class="sr-only">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" autofocus><br>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password"><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="http://getbootstrap.com/assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>