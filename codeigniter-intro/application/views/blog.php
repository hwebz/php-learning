<section>
    <?php foreach($query as $item): ?>
        <article>
            <h3><?php echo anchor('blog/'.$item->id, $item->title) ?> <small><?php echo date('l jS', $item->date) ?></small></h3>
            <p><?php echo $item->content ?></p>
        </article>
    <?php endforeach; ?>
</section>