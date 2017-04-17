<section>
    Content section: <?php echo $content ?>

    <ul>
        <?php foreach($todo_list as $item): ?>
            <li><?php echo $item ?></li>
        <?php endforeach; ?>
    </ul>
</section>