<?php 
    include_once 'utils/constants.php';
    include_once 'includes/connection.php';
    include_once 'includes/article.php';

    $article = new Article;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : null;
    $num_posts = isset($_GET['num_posts']) ? (int)$_GET['num_posts'] : NUM_POSTS;
    $total_articles = (int)$article->count();
    $page = $page != null ? $page - 1 : $page;
    $articles = $article->fetch_limited($page * $num_posts, $num_posts);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple CMS</title>

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
                <a class="navbar-brand" href="#">Simple CMS</a>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="admin/" class="btn btn-primary">Go to dashboard <span class="glyphicon glyphicon glyphicon-circle-arrow-right"></span></a><br><br>
            </div>
            <?php
                foreach($articles as $article) {
                    ?>
                    <div class="col-sm-4">
                        <a href="article.php?id=<?php echo $article['article_id'] ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $article['article_title'] ?> - <small>posted <?php echo date('l jS', $article['article_timestamp']) ?></small></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            ?>

            <?php 
                if ($total_articles > $num_posts) {
                    ?>
                    <div class="col-sm-12 text-center">
                        <ul class="pagination">
                            <li class="<?php echo $page == null ? 'active' : '' ?>"><a href="index.php">1</a></li>
                            <?php 
                                for($i = 2; $i <= round($total_articles / $num_posts); $i++) {
                                    ?>
                                        <li class="<?php echo ($i == ($page + 1)) ? 'active' : '' ?>"><a href="index.php?page=<?php echo $i ?>&num_posts=<?php echo $num_posts ?>"><?php echo $i ?></a></li>
                                    <?php
                                }
                            ?>
                        </ul>
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