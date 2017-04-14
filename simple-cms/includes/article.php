<?php 

    class Article {
        public function fetch_all() {
            global $pdo;

            $query = $pdo->prepare("SELECT * FROM articles");
            $query->execute();

            return $query->fetchAll();
        }

        public function fetch_limited($start, $num_posts) {
            global $pdo;

            $pagination = array(
                'start' => $start != null ? $start : 0, 
                'num_posts' => $num_posts != null ? $num_posts : 5
            );

            $query = $pdo->prepare("SELECT * FROM articles LIMIT ?,?");
            $query->bindValue(1, $pagination['start'], PDO::PARAM_INT);
            $query->bindValue(2, $pagination['num_posts'], PDO::PARAM_INT);
            $query->execute();

            return $query->fetchAll();
        }

        public function count() {
            global $pdo;

            $query = $pdo->prepare("SELECT * FROM articles");
            $query->execute();

            return $query->rowCount();
        }

        public function fetch_data($article_id) {
            global $pdo;

            $query = $pdo->prepare("SELECT * FROM articles WHERE article_id = ?");
            $query->bindValue(1, $article_id);
            $query->execute();

            return $query->fetch();
        }

        public function insert_data($article_title, $article_content, $article_timestamp) {
            global $pdo;
            $values = array($article_title, 
                            $article_content, 
                            $article_timestamp);

            $query = $pdo->prepare("INSERT INTO articles(article_title, article_content, article_timestamp) VALUES(?, ?, ?)");
            for($i = 1; $i <= 3; $i++) {
                $query->bindValue($i, $values[$i - 1]);
            }

            return $query->execute() ? true : false;
        }

        public function update_data($article_id, $article_title, $article_content) {
            global $pdo;
            $values = array($article_title,
                            $article_content,
                            $article_id);

            $query = $pdo->prepare("UPDATE articles SET article_title = ?, article_content = ? WHERE article_id = ?");
            for($i = 1; $i <= count($values); $i++) {
                $query->bindValue($i, $values[$i - 1]);
            }

            return $query->execute() ? true : false;
        }

        public function delete_data($article_id) {
            global $pdo;
            
            $query = $pdo->prepare("DELETE FROM articles WHERE article_id = ?");
            $query->bindValue(1, $article_id);

            return $query->execute() ? true : false;
        }
    }

?>