<!-- File: /app/View/Phones/view.ctp -->

<h1><?php echo h($phone['Phone']['name']); ?></h1>

<p><small>Manufacturer: <?php echo $phone['Phone']['manufacturer']; ?></small></p>

<p><?php echo h($phone['Phone']['description']); ?></p>