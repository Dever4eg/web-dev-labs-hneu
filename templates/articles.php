<?php
use src\Entities\Article;

/**
 * @var Article[] $articles;
 */
?>

<p class="mt-4">Find new articles here</p>

<div class="row">
    <?php foreach ($articles as $article): ?>
      <div class="card mt-4 md-4 mx-2" style="width: 18rem;">
        <img src="<?php echo $article->getImage() ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $article->getTitle() ?></h5>
          <p class="card-text"><?php echo mb_substr($article->getText(), 0, 100) ?></p>
          <a href="<?php echo sprintf('/articles/%d', $article->getId()) ?>" class="btn btn-primary">Read</a>
        </div>
      </div>
    <?php endforeach; ?>

</div>
