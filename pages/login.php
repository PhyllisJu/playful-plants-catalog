<!-- Source: (original work) Phyllis Ju -->

<?php
$home_class = "";
$catalog_class = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Playful Plants | Login</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
</head>

<body>

  <?php
  include('includes/nav.php');
  if (!is_user_logged_in()) {
    echo_login_form('/login', $session_messages);
  } else { ?>
    <main class="add-plants-form">
      <h1>You have successfully logged in.</h1>
    </main>
  <?php } ?>
  <?php include('includes/footer.php'); ?>

</body>

</html>
