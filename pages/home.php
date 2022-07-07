<!-- Source: (original work) Phyllis Ju -->

<?php
$home_class = "current-page";
$catalog_class = "";
?>
<!-- Source: (original work) Phyllis Ju -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Playful Plants | About Us</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
</head>

<body>

  <?php include('includes/nav.php'); ?>

  <div class="home-main">
    <div class="intro">
      <h1>We are using plants to ...</h1>
      <ul>
        <li>support children's play and learning</li>
        <li>promote diverse types of nature play and engagement</li>
        <li>be combined to create unique nature play experiences</li>
        <li>withstand playful engagement</li>
      </ul>
      <form action="/plant-catalog" method="get" novalidate>
        <button id="home-btn">View the Catalog</button>
      </form>
    </div>

    <div class="home-img">
      <img alt="A green leaf held in a hand." src="/public/images/home.jpg" width=756 height=431 />
      Source: <cite><a href="https://cals.cornell.edu/cornell-cooperative-extension/join-us/cce-summer-internship-program/playful-plants-guide-effective-integration-nature-childrens-outdoor-play-spaces">Cornell Cooperative Extension</a></cite>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>
</body>

</html>
