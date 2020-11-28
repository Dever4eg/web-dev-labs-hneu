<?php
use src\Entities\Article;

/**
 * @var Article $article;
 */
?>

<div class="card mt-4">
  <div class="card-header">
    <?php echo $article->getTitle() ?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <img class="figure-img img-fluid rounded" src="<?php echo $article->getImage() ?>">
      </div>
      <div class="col-md-8">
        <p class="card-text">
            <?php echo $article->getText() ?>
        </p>
      </div>
    </div>
  </div>
</div>
