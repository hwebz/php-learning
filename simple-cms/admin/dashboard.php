<?php 
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header('Location: index.php');
        exit();
    }

    include_once '../utils/constants.php';
    include_once '../includes/connection.php';
    include_once '../includes/article.php';
    
    $article = new Article;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : null;
    $num_posts = isset($_GET['num_posts']) ? (int)$_GET['num_posts'] : NUM_POSTS;
    $total_articles = (int)$article->count();
    $page = ($page != null) ? $page - 1 : $page;
    // $articles = ($start != null && $num_posts != null) ? $article->fetch_limited((int)$start, (int)$num_posts) : $article->fetch_all();
    $articles = $article->fetch_limited($page * $num_posts, $num_posts);
    $errors = [];

    // Display deleted messages
    if (isset($_GET['deletedId'])) {
        $errors['success'][] = "Article id: {$_GET['deletedId']} has been successfully deleted!!";
    }

    // Delete article    
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $action = $_GET['action'];
        $id = $_GET['id'];

        if (empty($action) || empty($id)) {
            header('location: dashboard.php');
            exit();
        } else {
            if ($action == 'delete') {
                $isDeleted = $article->delete_data($id);
                if ($isDeleted) {
                    // $errors['success'][] = "Article id: {$id} has been successfully deleted!!";
                    // $articles = $article->fetch_all(); // Re-load data after deleting
                    header("Location: dashboard.php?deletedId={$id}");
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
                    <li><a href="add.php">Add article</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Article List</h1>
                </div>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($articles as $article) {
                                ?>
                                <tr>
                                    <td><?php echo $article['article_id'] ?></td>
                                    <td><?php echo $article['article_title'] ?></td>
                                    <td><?php echo substr($article['article_content'], 0, 60) ?>...</td>
                                    <td><?php echo date('m/d/Y h:m:s', $article['article_timestamp']) ?></td>
                                    <td>
                                        <a href="add.php?id=<?php echo $article['article_id'] ?>" class="btn btn-xs btn-default "><span class="glyphicon glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="dashboard.php?action=delete&id=<?php echo $article['article_id'] ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon glyphicon-remove-circle"></span>Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>

                <?php 
                    if ($total_articles > $num_posts) {
                        ?>
                        <div class="text-center">
                            <ul class="pagination">
                                <li class="<?php echo $page == null ? 'active' : '' ?>"><a href="dashboard.php">1</a></li>
                                <?php 
                                    for($i = 2; $i <= round($total_articles / $num_posts); $i++) {
                                        ?>
                                            <li class="<?php echo ($i == ($page + 1)) ? 'active' : '' ?>"><a href="dashboard.php?page=<?php echo $i ?>&num_posts=<?php echo $num_posts ?>"><?php echo $i ?></a></li>
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