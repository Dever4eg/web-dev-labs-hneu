<?php
use src\Entities\User;

/**
 * @var User $user
 */
?>

<p class="mt-4">Profile</p>
<p>Username: <?php echo $user->getUsername() ?></p>
