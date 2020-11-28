<?php
use src\Entities\User;

/**
 * @var User $user
 */
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/articles">HNEU Web Babs</a>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/articles">Articles</a>
      </li>
    </ul>
    <ul class="navbar-nav my-lg-0">
      <?php if(null != $user): ?>
        <li class="nav-item">
          <a class="nav-link" href="/me"><?php echo $user->getUsername() ?></a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="/signin">Sign in</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
