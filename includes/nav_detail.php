<nav>
  <div class="nav_title">
    <a href="/">DECA Lab <span>Playful Plants</span></a>
    <ul>
      <li><a class="<?php echo $home_class; ?>" href="/">About Us</a></li>
      <li><a class="<?php echo $catalog_class; ?>" href="/plant-catalog">Plant Catalog</a></li>
    </ul>
  </div>
  <?php if (!is_user_logged_in()) { ?>
    <div class="login">
      <p>Administrator?</p>
      <a id="login" href="/login">
        <p>Log In</p>
      </a>
    </div>
  <?php } else { ?>
    <div class="login">
      <p>Welcome, <?php echo htmlspecialchars($current_user['name']); ?>!</p>
      <a id="login" href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) . '&logout='; ?>">
        <p>Sign Out</p>
      </a>
    </div>
  <?php } ?>
</nav>
