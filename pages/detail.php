<!-- Source: (original work) Phyllis Ju -->

<?php
$home_class = "";
$catalog_class = "current-page";

// feedback classes
$confirmation_class = 'hidden';
$content_class = '';
$reject_class = 'hidden';

// get 'id' parameter for GET requests
$id = $_GET['id'] ?? NULL; // untrusted
$delete_id = $_GET['delete-id']; //untrusted

$record_arr = exec_sql_query(
  $db,
  "SELECT id, plant_id, file_ext, collo_name, genus_name, nooks, loose, climb, maze, evocative FROM entries WHERE (entries.id = :id);",
  array(':id' => $id)
)->fetchAll();
$entry = $record_arr[0];

$entry_play_types = exec_sql_query(
  $db,
  "SELECT tag_id FROM entry_tags WHERE (entry_id = :entry_id) AND (tag_id < 9);",
  array(':entry_id' => $id)
)->fetchAll();

$entry_class_arr = exec_sql_query(
  $db,
  "SELECT tags.tag_name AS 'tags.tag_name' FROM entry_tags INNER JOIN tags ON tags.id = entry_tags.tag_id WHERE (entry_tags.entry_id = :entry_id) AND (entry_tags.tag_id > 8);",
  array(':entry_id' => $id)
)->fetchAll();
$entry_class = $entry_class_arr[0];

// -- Handle deletion --
if (is_user_logged_in()) {
  if ($delete_id) {
    $record_arr = exec_sql_query(
      $db,
      "SELECT file_ext FROM entries WHERE (id = :id);",
      array(':id' => $delete_id)
    )->fetchAll();
    $entry = $record_arr[0];

    $result1 = exec_sql_query(
      $db,
      "DELETE FROM entries WHERE (id = :id);",
      array(
        ':id' => $delete_id
      )
    );
    $result2 = exec_sql_query(
      $db,
      "DELETE FROM entry_tags WHERE (entry_id = :id);",
      array(
        ':id' => $delete_id
      )
    );

    $filename = 'public/uploads/images/' . htmlspecialchars($delete_id) . '.' . htmlspecialchars($entry['file_ext']);
    unlink($filename);

    if ($result1 && $result2) {
      $confirmation_class = '';
      $content_class = 'hidden';
    }
  }
} else {
  if ($delete_id) {
    $reject_class = '';
    $content_class = 'hidden';
  }
}
?>
<!-- Source: (original work) Phyllis Ju -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Playful Plants | Plant Details</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
</head>

<body>

  <?php include('includes/nav_detail.php'); ?>

  <section class="details_main details_feedback <?php echo $confirmation_class; ?>">
    <h1>Plant Details</h1>
    <p class="confirmation">You have successfully deleted this plant.</p>
    <p class="confirmation">Go back to <a href="/plant-catalog">Plant Catalog</a>.</p>
  </section>

  <section class="details_main details_feedback <?php echo $reject_class; ?>">
    <h1>Plant Details</h1>
    <p class="confirmation">Sorry, you don't have the authority to delete a plant.</p>
  </section>

  <main class="details_main <?php echo $content_class; ?>">

    <div class="details_head">
      <h1>Plant Details</h1>
      <?php if (is_user_logged_in()) { ?>
        <div class="details_btn">
          <span id="edit"><a href="<?php echo "/edit-plants?plant=" . strtolower(htmlspecialchars($entry['plant_id'])); ?>">Edit</a></span>
          <span id="delete"><a href="<?php echo "/plant-detail?delete-id=" . $id; ?>">Delete</a></span>
        </div>
      <?php } ?>
    </div>

    <div class="details_img">
      <div><img src="<?php echo "/public/uploads/images/" . htmlspecialchars($entry['id']) . "." . htmlspecialchars($entry['file_ext']); ?>" alt="a plant image" /></div>
      <ul>
        <?php if (is_user_logged_in()) { ?>
          <li><strong>Plant ID:</strong> <?php echo htmlspecialchars($entry['plant_id']); ?></li>
        <?php } ?>
        <li><strong>Colloquial Name:</strong> <?php echo htmlspecialchars($entry['collo_name']); ?></li>
        <li><strong>Genus/Species:</strong> <?php echo htmlspecialchars($entry['genus_name']); ?></li>
        <li><strong>General Classification:</strong> <?php
                                                      if ($entry_class != null) {
                                                        echo htmlspecialchars($entry_class['tags.tag_name']);
                                                      } else {
                                                        echo "No classification assigned";
                                                      }
                                                      ?></li>
      </ul>
    </div>

    <h4><strong>Play Types:</strong></h4>
    <ul>
      <?php
      $no_play_types = true;
      foreach ($entry_play_types as $entry_play_type) {
        $no_play_types = false;
        if ($entry_play_type['tag_id'] == 1) {
      ?>
          <li>Supports Exploratory Constructive Play</li>
        <?php } else if ($entry_play_type['tag_id'] == 2) { ?>
          <li>Supports Exploratory Sensory Play</li>
        <?php } else if ($entry_play_type['tag_id'] == 3) { ?>
          <li>Supports Physical Play</li>
        <?php } else if ($entry_play_type['tag_id'] == 4) { ?>
          <li>Supports Imaginative Play</li>
        <?php } else if ($entry_play_type['tag_id'] == 5) { ?>
          <li>Supports Restorative Play</li>
        <?php } else if ($entry_play_type['tag_id'] == 6) { ?>
          <li>Supports Expressive Play</li>
        <?php } else if ($entry_play_type['tag_id'] == 7) { ?>
          <li>Supports Play with Rules</li>
        <?php } else { ?>
          <li>Supports Bio Play</li>
        <?php } ?>
      <?php }
      if ($no_play_types) { ?>
        <li>This plant doesn't have play types assigned to it.</li>
      <?php } ?>
    </ul>
    <h4><strong>Play Opportunities:</strong></h4>
    <ul>
      <?php
      $no_play_oppos = true;
      if ($entry['nooks'] == 1) {
        $no_play_oppos = false; ?>
        <li>Creates Nooks or Secret Spaces</li>
      <?php }
      if ($entry['loose'] == 1) {
        $no_play_oppos = false; ?>
        <li>Provides Loose Parts/Play Props</li>
      <?php }
      if ($entry['climb'] == 1) {
        $no_play_oppos = false; ?>
        <li>Provides Opportunities for Climbing & Swinging</li>
      <?php }
      if ($entry['maze'] == 1) {
        $no_play_oppos = false; ?>
        <li>Can be used to create Mazes/Labyrinths/Spirals</li>
      <?php }
      if ($entry['evocative'] == 1) {
        $no_play_oppos = false; ?>
        <li>Includes Evocative or Unique Elements</li>
      <?php }
      if ($no_play_oppos) { ?>
        <li>This plant doesn't have play opportunities discovered.</li>
      <?php } ?>
    </ul>
  </main>

  <?php include('includes/footer.php'); ?>
</body>

</html>
