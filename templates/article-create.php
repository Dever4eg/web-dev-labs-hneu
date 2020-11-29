<?php
use src\Repository\Dto\ArticleCreateDto;

/**
 * @var string $error
 * @var ArticleCreateDto $articleDto
 */
?>

<?php if ($error): ?>
  <p style="color: red;"><?php echo $error?></p>
<?php endif; ?>

<form method="POST" action="/articles">
  <div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" name="title" id="title" value="<?php echo $articleDto->getTitle() ?>">
  </div>
  <div class="form-group">
    <label for="text">Text</label>
    <textarea class="form-control" name="text" id="text" rows="5"></textarea>
  </div>
  <div class="form-group">
    <label for="image_url">Image Url</label>
    <input class="form-control" name="image_url" id="image_url" value="<?php echo $articleDto->getImageUrl() ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
