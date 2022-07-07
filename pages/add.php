<!-- Source: (original work) Phyllis Ju -->
<?php
$home_class = "";
$catalog_class = "current-page";

define("MAX_FILE_SIZE", 1000000);

// feedback message css class
$id_feedback_class = 'hidden';
$collo_feedback_class = 'hidden';
$genus_feedback_class = 'hidden';
$upload_feedback_class = "hidden";
$confirmation_class = 'hidden';

// values
$plant_id = '';
$collo_name = '';
$genus_name = '';
$upload_filename = NULL;
$upload_ext = NULL;
$constructive = '';
$sensory = '';
$physical = '';
$imaginative = '';
$restorative = '';
$expressive = '';
$rules = '';
$bio = '';
$nooks = '';
$loose = '';
$climb = '';
$maze = '';
$evocative = '';
$class = '';

//sticky values
$sticky_plant_id = '';
$sticky_collo_name = '';
$sticky_genus_name = '';
$sticky_constr = '';
$sticky_sensory = '';
$sticky_physical = '';
$sticky_imag = '';
$sticky_rest = '';
$sticky_exp = '';
$sticky_rules = '';
$sticky_bio = '';
$sticky_nooks = '';
$sticky_loose = '';
$sticky_climb = '';
$sticky_maze = '';
$sticky_evocative = '';
$sticky_shrub = '';
$sticky_grass = '';
$sticky_vine = '';
$sticky_tree = '';
$sticky_flower = '';
$sticky_groundcovers = '';
$sticky_other = '';

if (isset($_POST["submitted"])) {
  //get user data
  $plant_id = trim($_POST["plant_id"]);
  $collo_name = trim($_POST["collo_name"]);
  $genus_name = trim($_POST["genus_name"]);
  $upload = $_FILES['img-file'];
  $constructive = $_POST["constructive"];
  $sensory = $_POST["sensory"];
  $physical = $_POST["physical"];
  $imaginative = $_POST["imaginative"];
  $restorative = $_POST["restorative"];
  $expressive = $_POST["expressive"];
  $rules = $_POST["rules"];
  $bio = $_POST["bio"];
  $nooks = $_POST["nooks"];
  $loose = $_POST["loose"];
  $climb = $_POST["climb"];
  $maze = $_POST["maze"];
  $evocative = $_POST["evocative"];
  $class = $_POST["class"];

  //assume form is valid
  $form_valid = true;

  //check uploaded file
  if ($upload['tmp_name'] != '') {
    if ($upload['error'] == UPLOAD_ERR_OK) {
      $upload_filename = basename($upload['name']);
      $upload_ext = strtolower(pathinfo($upload_filename, PATHINFO_EXTENSION));

      if (!in_array($upload_ext, array('jpg', 'jpeg', 'png'))) {
        $form_valid = false;
        $upload_feedback_class = '';
      }
    } else {
      $form_valid = false;
      $upload_feedback_class = '';
    }
  } else {
    $upload_ext = 'jpg';
    $upload_filename = NULL;
  }

  //check empty id
  if (empty($plant_id)) {
    $form_valid = false;
    $id_feedback_class = '';
  } else { // check if $plant_id is unique
    $plant_id = strtoupper($plant_id); // tainted
    $records = exec_sql_query(
      $db,
      "SELECT * FROM entries WHERE (plant_id = :plant_id);",
      array(
        ':plant_id' => $plant_id
      )
    )->fetchAll();
    if (count($records) > 0) {
      $form_valid = false;
      $plant_id_not_unique = true;
      $id_feedback_class = '';
    }
  }

  //check empty collo name
  if (empty($collo_name)) {
    $form_valid = false;
    $collo_feedback_class = '';
  }

  //check empty genus name
  if (empty($genus_name)) {
    $form_valid = false;
    $genus_feedback_class = '';
  }

  if ($form_valid) {
    // add new record to db
    $insert_query = "INSERT INTO entries (plant_id, collo_name, genus_name, nooks, loose, climb, maze, evocative, file_name, file_ext) VALUES (:plant_id, :collo_name, :genus_name, :nooks, :loose, :climb, :maze, :evocative, :file_name, :file_ext);";

    $result = exec_sql_query(
      $db,
      $insert_query,
      array(
        ':plant_id' => $plant_id,
        ':collo_name' => $collo_name,
        ':genus_name' => $genus_name,
        ':nooks' => (empty($nooks) ? 0 : 1),
        ':loose' => (empty($loose) ? 0 : 1),
        ':climb' => (empty($climb) ? 0 : 1),
        ':maze' => (empty($maze) ? 0 : 1),
        ':evocative' => (empty($evocative) ? 0 : 1),
        ':file_name' => $upload_filename,
        ':file_ext' => $upload_ext
      )
    );

    if ($result) {
      if ($upload['tmp_name'] != '') {
        $record_id = $db->lastInsertId('id');
        $id_filename = 'public/uploads/images/' . $record_id . '.' . $upload_ext;
        move_uploaded_file($upload["tmp_name"], $id_filename);
      } else {
        $record_id = $db->lastInsertId('id');
        $id_filename = 'public/uploads/images/' . $record_id . '.' . $upload_ext;
        copy('public/images/plant.jpg', $id_filename);
      }
      // Insert tags to entry_tags
      if (!empty($constructive)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 1
        ));
      }

      if (!empty($sensory)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 2
        ));
      }

      if (!empty($physical)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 3
        ));
      }

      if (!empty($imaginative)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 4
        ));
      }

      if (!empty($restorative)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 5
        ));
      }

      if (!empty($expressive)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 6
        ));
      }

      if (!empty($rules)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 7
        ));
      }

      if (!empty($bio)) {
        $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
        exec_sql_query($db, $insert_tag_query, array(
          ':entry_id' => $record_id,
          ':tag_id' => 8
        ));
      }

      if (!empty($class)) {
        if ($class == 'shrub') {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 9
          ));
        } else if ($class == 'grass') {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 10
          ));
        } else if ($class == 'vine') {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 11
          ));
        } else if ($class == 'tree') {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 12
          ));
        } else if ($class == 'flower') {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 13
          ));
        } else if ($class == 'groundcovers') {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 14
          ));
        } else {
          $insert_tag_query = "INSERT INTO entry_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);";
          exec_sql_query($db, $insert_tag_query, array(
            ':entry_id' => $record_id,
            ':tag_id' => 15
          ));
        }
      }
    }

    // show confirmation
    $confirmation_class = '';
  } else {
    // set sticky values
    $sticky_plant_id = $plant_id;
    $sticky_collo_name = $collo_name;
    $sticky_genus_name = $genus_name;
    $sticky_constr = (empty($constructive) ? '' : 'checked');
    $sticky_sensory = (empty($sensory) ? '' : 'checked');
    $sticky_physical = (empty($physical) ? '' : 'checked');
    $sticky_imag = (empty($imaginative) ? '' : 'checked');
    $sticky_rest = (empty($restorative) ? '' : 'checked');
    $sticky_exp = (empty($expressive) ? '' : 'checked');
    $sticky_rules = (empty($rules) ? '' : 'checked');
    $sticky_bio = (empty($bio) ? '' : 'checked');
    $sticky_nooks = (empty($nooks) ? '' : 'checked');
    $sticky_loose = (empty($loose) ? '' : 'checked');
    $sticky_climb = (empty($climb) ? '' : 'checked');
    $sticky_maze = (empty($maze) ? '' : 'checked');
    $sticky_evocative = (empty($evocative) ? '' : 'checked');
    $sticky_shrub = ($class == 'shrub' ? 'checked' : '');
    $sticky_grass = ($class == 'grass' ? 'checked' : '');
    $sticky_vine = ($class == 'vine' ? 'checked' : '');
    $sticky_tree = ($class == 'tree' ? 'checked' : '');
    $sticky_flower = ($class == 'flower' ? 'checked' : '');
    $sticky_groundcovers = ($class == 'groundcovers' ? 'checked' : '');
    $sticky_other = ($class == 'other' ? 'checked' : '');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Playful Plants | Add Plants</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
</head>

<body>

  <?php include('includes/nav.php'); ?>
  <?php if (is_user_logged_in()) { ?>
    <main class="add-plants-form">
      <h1>Add A New Plant</h1>
      <p class="confirmation <?php echo $confirmation_class; ?>">You have added a new plant to the catalog successfully!</p>

      <form action="/add-plants" method="post" enctype="multipart/form-data" novalidate>

        <p class="feedback <?php echo $id_feedback_class; ?>">Please enter a unique plant id</p>
        <div class="add-input">
          <label for="plant-id">&#42; Plant ID:</label>
          <input id="plant-id" name="plant_id" value="<?php echo htmlspecialchars($sticky_plant_id); ?>" />
        </div>

        <p class="feedback <?php echo $collo_feedback_class; ?>">Please enter the plant's colloquial name</p>
        <div class="add-input">
          <label for="collo-name">&#42; Plant Colloquial Name:</label>
          <input id="collo-name" name="collo_name" value="<?php echo htmlspecialchars($sticky_collo_name); ?>" />
        </div>

        <p class="feedback <?php echo $genus_feedback_class; ?>">Please enter the plant's genus name</p>
        <div class="add-input">
          <label for="genus-name">&#42; Plant Genus Name:</label>
          <input id="genus-name" name="genus_name" value="<?php echo htmlspecialchars($sticky_genus_name); ?>" />
        </div>

        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

        <p class="feedback <?php echo $upload_feedback_class; ?>">Please upload a JPG, JPEG, or PNG file (&#60; 1 MB).</p>
        <div class="add-input">
          <label for="upload_file">JPG/JPEG/PNG Plant Image (&#60; 1 MB):</label>
          <input id="upload_file" type="file" name="img-file" accept="image/jpg, image/jpeg, image/png" />
        </div>

        <div class="form-group add-input">
          <div>Choose play types:</div>

          <div>
            <div class="filter-option">
              <input type="checkbox" id="const-play" name="constructive" <?php echo htmlspecialchars($sticky_constr); ?> />
              <label for="const-play">Supports Exploratory Constructive Play</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="sense-play" name="sensory" <?php echo htmlspecialchars($sticky_sensory); ?> />
              <label for="sense-play">Supports Exploratory Sensory Play</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="phys-play" name="physical" <?php echo htmlspecialchars($sticky_physical); ?> />
              <label for="phys-play">Supports Physical Play</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="imag-play" name="imaginative" <?php echo htmlspecialchars($sticky_imag); ?> />
              <label for="imag-play">Supports Imaginative Play</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="rest-play" name="restorative" <?php echo htmlspecialchars($sticky_rest); ?> />
              <label for="rest-play">Supports Restorative Play</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="exp-play" name="expressive" <?php echo htmlspecialchars($sticky_exp); ?> />
              <label for="exp-play">Supports Expressive Play</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="rules-play" name="rules" <?php echo htmlspecialchars($sticky_rules); ?> />
              <label for="rules-play">Supports Play with Rules</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="bio-play" name="bio" <?php echo htmlspecialchars($sticky_bio); ?> />
              <label for="bio-play">Supports Bio Play</label>
            </div>
          </div>

        </div>

        <div class="form-group add-input">
          <div>Choose play opportunities:</div>

          <div>
            <div class="filter-option">
              <input type="checkbox" id="nooks" name="nooks" <?php echo htmlspecialchars($sticky_nooks); ?> />
              <label for="nooks">Creates Nooks or Secret Spaces</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="loose" name="loose" <?php echo htmlspecialchars($sticky_loose); ?> />
              <label for="loose">Provides Loose Parts/Play Props</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="climb" name="climb" <?php echo htmlspecialchars($sticky_climb); ?> />
              <label for="climb">Provides Opportunities for Climbing & Swinging</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="maze" name="maze" <?php echo htmlspecialchars($sticky_maze); ?> />
              <label for="maze">Can be used to create Mazes/Labyrinths/Spirals</label>
            </div>

            <div class="filter-option">
              <input type="checkbox" id="evocative" name="evocative" <?php echo htmlspecialchars($sticky_evocative); ?> />
              <label for="evocative">Includes Evocative or Unique Elements</label>
            </div>
          </div>

        </div>

        <div class="form-group add-input" role="group" aria-labelledby="class_head">
          <div id="class_head">Choose general classfication:</div>

          <div>
            <div class="filter-option">
              <input type="radio" id="shrub_input" name="class" value="shrub" <?php echo htmlspecialchars($sticky_shrub); ?> />
              <label for="shrub_input">Shrub</label>
            </div>

            <div class="filter-option">
              <input type="radio" id="grass_input" name="class" value="grass" <?php echo htmlspecialchars($sticky_grass); ?> />
              <label for="grass_input">Grass</label>
            </div>

            <div class="filter-option">
              <input type="radio" id="vine_input" name="class" value="vine" <?php echo htmlspecialchars($sticky_vine); ?> />
              <label for="vine_input">Vine</label>
            </div>

            <div class="filter-option">
              <input type="radio" id="tree_input" name="class" value="tree" <?php echo htmlspecialchars($sticky_tree); ?> />
              <label for="tree_input">Tree</label>
            </div>

            <div class="filter-option">
              <input type="radio" id="flower_input" name="class" value="flower" <?php echo htmlspecialchars($sticky_flower); ?> />
              <label for="flower_input">Flower</label>
            </div>

            <div class="filter-option">
              <input type="radio" id="groundcovers_input" name="class" value="groundcovers" <?php echo htmlspecialchars($sticky_groundcovers); ?> />
              <label for="groundcovers_input">Groundcovers</label>
            </div>

            <div class="filter-option">
              <input type="radio" id="other_input" name="class" value="other" <?php echo htmlspecialchars($sticky_other); ?> />
              <label for="other_input">Other (Mosses, Ferns, Vegetables, etc.)</label>
            </div>

          </div>
        </div>

        <div class="align-right">
          <input id="add-submit" type="submit" name="submitted" value="Add" />
        </div>
      </form>
    </main>
  <?php } else { ?>
    <main class="details_main">
      <h1>Sorry, only administrators can access this page.</h1>
      <h1>You need to log in first if you are an administrator.</h1>
    </main>
  <?php } ?>

  <?php include('includes/footer.php'); ?>

</body>

</html>
