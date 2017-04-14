<?php 
    function php_net_feed($limit) {
        $feed_url = 'http://php.net/feed.atom';
        $feed = simplexml_load_file($feed_url);

        $articles = array(
            'icon' => $feed->icon,
            'title' => $feed->title,
            'author' => $feed->author
        );

        $x = 1;

         foreach($feed->entry as $article) {
            if ($x <= $limit) {
                $ar = array(
                    'article-title' => (string)$article->title,
                    'article-url' => (string)$article->id,
                    'article-published' => (string)$article->published,
                    'article-content' => $article->content->div->p,
                    'article-categories' => $article->category
                );
                $articles['articles'][] = $ar;
            } else {
                break;
            }
            $x++;
         }
        //  echo $articles['articles'][0]['article-title'];
        //  die();
         return $articles;
    }

?>