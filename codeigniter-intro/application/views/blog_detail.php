<section>
    <?php echo anchor('blog/', "Back to articles list") ?>
    <hr>
    <h3><?php echo $query->title ?> <small><?php echo date('l jS', $query->date) ?></small></h3>
    <p><?php echo $query->content ?></p>
</section>