<?php 
    session_start();

    include_once '../utils/constants.php';
    include_once '../includes/connection.php';
    include_once '../includes/article.php';

    if (!isset($_SESSION['logged_in'])) {
        header('Location: index.php');
        exit();
    } else {
        $article = new Article;
        $errors = [];
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $articleUpdated = isset($id) ? $article->fetch_data($id) : [];
        $isError = false;

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['article-title'], $_POST['article-content'])) {
                $article_title = $_POST['article-title'];
                $article_content = $_POST['article-content'];

                if (empty($article_title)) {
                    $errors['danger'][] = "Article title is required field.";
                    $isError = true;
                }

                if (empty($article_content)) {
                    $errors['danger'][] ="Article content is required field.";
                    $isError = true;
                }

                if (!$isError) {
                    $article = new Article;
                    print(isset($id));
                    if (isset($id)) {
                        $updateId = $article->update_data($id, $article_title, $article_content);
                        if ($updateId) {
                            $errors['success'][] = "Article successfully updated!";
                        }
                    } else {
                        $id = $article->insert_data($article_title, $article_content, time());
                        if ($id) {
                            $errors['success'][] = "Article successfully added!";
                        }
                    }
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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            </div>
            <!--/.nav-collapse -->
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="add.php">Add article</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-circle-arrow-left"></span> Back to article list</a>
                <div class="page-header">
                    <h1>Add article</h1>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <?php 
                    if (!empty($errors)) {
                        foreach($errors as $key => $error) {
                            ?>
                            <div class="alert alert-<?php echo $key ?>" role="alert">
                                <ul>
                                    <?php
                                        foreach($error as $err) {
                                            ?>
                                            <li><?php echo $err ?></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                    }
                ?>

                <form action="" class="form-addarticle" method="post">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="article-title" placeholder="Article title" class="form-control" value="<?php echo (!empty($articleUpdated) ? $articleUpdated['article_title'] : '') ?>" />
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea rows="8" name="article-content" placeholder="Article title" class="form-control"><?php echo (!empty($articleUpdated) ? $articleUpdated['article_content'] : '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><?php echo $id != null ? 'Save' : 'Add' ?></button>
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