<?php 
    include_once 'functions.php';

    $feed = php_net_feed(10);
    // echo '<pre>'.print_r($feed['articles'][0], true).'</pre>';
    // die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PHP Feeds</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">PHP Feeds</a>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    
                </div>
                <div class="page-header">
                    <h1>
                        <img src="<?php echo $feed['icon']; ?>" class="img-thumbnail" alt="<?php echo $feed['title'] ?>"> 
                        <?php echo $feed['title'] ?> 
                        <small>
                            <a href="<?php echo $feed['author']->uri ?>">
                                <?php echo $feed['author']->name ?>
                            </a>
                        </small>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row flex">
            <?php 
                foreach($feed['articles'] as $article) {
                    $url = $article['article-url'];
                    $title = $article['article-title'];
                    $published = $article['article-published'];
                    $content = $article['article-content'];
                    $categories =  $article['article-categories'];
                    ?>
                        <div class="col-sm-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a href="<?php echo $url ?>">
                                            <?php echo $title ?>
                                        </a> 
                                        - 
                                        <small>Published: <?php echo $published ?></small>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        foreach($categories as $cat) {
                                            ?>
                                            <a href="" class="btn btn-xs btn-info"><?php echo $cat['label'] ?></a>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        <?php
                                        foreach($content as $p) {
                                            ?>
                                            <p><?php echo $p ?></p>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
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