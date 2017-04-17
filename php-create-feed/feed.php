<?php
    // AddType application/x-httpd-php .rss
    // in apache/conf/httpd.conf To enable feed.rss extension

    $db = new mysqli('localhost', 'root', '', 'codeigniter-intro');

    $limit = (isset($_GET['limit'])) && (int) $_GET['limit'] <= 30 ? (int) $_GET['limit'] : 10;

    $query = $db->query("SELECT id, title, content, date FROM entries ORDER BY date DESC LIMIT 0,".$limit);

    if ($db->affected_rows > 0) {
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
    <rss version="2.0">
        <channel>
            <title>phpacademy</title>
            <description>RSS Feed</description>
            <link>http://phpacademy.org</link>

            <?php while($row = $query->fetch_assoc()) : ?>
                <item>
                    <title><?php echo $row['title'] ?></title>
                    <description><?php echo $row['content'] ?></description>
                    <link>http://phpacademy.org/article/<?php echo $row['id'] ?></link>
                    <pubDate><?php echo date('r', $row['date']) ?></pubDate>
                </item>
            <?php endwhile; ?>
        </channel>
    </rss>
<?php
    }
?>

