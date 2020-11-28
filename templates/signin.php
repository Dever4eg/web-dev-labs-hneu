<?php
/**
 * @var string $username
 * @var string $password
 * @var string $error
 */
?>

<p>Sign in</p>

<?php if ($error): ?>
  <p style="color: red;"><?php echo $error?></p>
<?php endif; ?>

<form method="POST" action="/signin">
  <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" name="username" id="username" value="<?php echo $username ?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" value="<?php echo $password ?>">
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
