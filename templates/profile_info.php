<div class="profile_info">
    <?php if (isAdmin() === true) : ?>
		<img src="../images/admin_profile.jpg">
    <?php else : ?>
        <img src="../images/user_profile.webp">
    <?php endif; ?>
    

    <div>
        <?php if (isset($_SESSION['user'])) : ?>
            <strong><?php echo $_SESSION['user']['username']; ?></strong>

            <small>
                <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
                <br>
                <a href="cart.php?logout='1'" style="color: red;">logout</a>
            </small>

        <?php endif ?>
    </div>
</div>
