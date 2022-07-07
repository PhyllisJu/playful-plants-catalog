<!-- Source: (original work) Phyllis Ju -->

<?php
$home_class = "";
$catalog_class = "current-page";

// feedback message css class
$filter_feedback_class = 'hidden';

// values
if (is_user_logged_in()) {
  $constructive = '';
  $sensory = '';
  $physical = '';
  $imaginative = '';
  $restorative = '';
  $expressive = '';
  $rules = '';
  $bio = '';
} else {
  $shrub = '';
  $grass = '';
  $vine = '';
  $tree = '';
  $flower = '';
  $groundcovers = '';
  $other = '';
}
$sort = '';

// sticky values
if (is_user_logged_in()) {
  $sticky_constr = '';
  $sticky_sensory = '';
  $sticky_physical = '';
  $sticky_imag = '';
  $sticky_rest = '';
  $sticky_exp = '';
  $sticky_rules = '';
  $sticky_bio = '';
  $sticky_id_asc = '';
  $sticky_id_desc = '';
} else {
  $sticky_shrub = '';
  $sticky_grass = '';
  $sticky_vine = '';
  $sticky_tree = '';
  $sticky_flower = '';
  $sticky_groundcovers = '';
  $sticky_other = '';
}
$sticky_name_asc = '';
$sticky_name_desc = '';

if (isset($_GET['filtered'])) {
  // get user data
  // get admin user data
  if (is_user_logged_in()) {
    $constructive = $_GET['constructive']; //untrusted
    $sensory = $_GET['sensory']; //untrusted
    $physical = $_GET['physical']; //untrusted
    $imaginative = $_GET['imaginative']; //untrusted
    $restorative = $_GET['restorative']; //untrusted
    $expressive = $_GET['expressive']; //untrusted
    $rules = $_GET['rules']; //untrusted
    $bio = $_GET['bio']; //untrusted
  } else {
    // get consumer user data
    $shrub = $_GET['shrub']; //untrusted
    $grass = $_GET['grass']; //untrusted
    $vine = $_GET['vine']; //untrusted
    $tree = $_GET['tree']; //untrusted
    $flower = $_GET['flower']; //untrusted
    $groundcovers = $_GET['groundcovers']; //untrusted
    $other = $_GET['other']; //untrusted
  }
  // get both user data
  $sort = $_GET['sort']; //untrusted

  //assume form is valid
  $form_valid = true;

  //check filter options
  if (empty($constructive) && empty($sensory) && empty($physical) && empty($imaginative) && empty($restorative) && empty($expressive) && empty($rules) && empty($bio) && empty($shrub) && empty($grass) && empty($vine) && empty($tree) && empty($flower) && empty($groundcovers) && empty($other) && empty($sort)) {
    $form_valid = false;
    $filter_feedback_class = '';
  }

  if ($form_valid) {
    //set sticky values
    // admins sticky values
    if (is_user_logged_in()) {
      $sticky_constr = (empty($constructive) ? '' : 'checked'); //tainted
      $sticky_sensory = (empty($sensory) ? '' : 'checked'); //tainted
      $sticky_physical = (empty($physical) ? '' : 'checked'); //tainted
      $sticky_imag = (empty($imaginative) ? '' : 'checked'); //tainted
      $sticky_rest = (empty($restorative) ? '' : 'checked'); //tainted
      $sticky_exp = (empty($expressive) ? '' : 'checked'); //tainted
      $sticky_rules = (empty($rules) ? '' : 'checked'); //tainted
      $sticky_bio = (empty($bio) ? '' : 'checked'); //tainted
      $sticky_id_asc = ($sort == 'id_asc' ? 'checked' : ''); //tainted
      $sticky_id_desc = ($sort == 'id_desc' ? 'checked' : ''); //tainted
    } else {
      // consumer sticky values
      $sticky_shrub = (empty($shrub) ? '' : 'checked'); //tainted
      $sticky_grass = (empty($grass) ? '' : 'checked'); //tainted
      $sticky_vine = (empty($vine) ? '' : 'checked'); //tainted
      $sticky_tree = (empty($tree) ? '' : 'checked'); //tainted
      $sticky_flower = (empty($flower) ? '' : 'checked'); //tainted
      $sticky_groundcovers = (empty($groundcovers) ? '' : 'checked'); //tainted
      $sticky_other = (empty($other) ? '' : 'checked'); //tainted
    }
    // both sticky values
    $sticky_name_asc = ($sort == 'name_asc' ? 'checked' : ''); //tainted
    $sticky_name_desc = ($sort == 'name_desc' ? 'checked' : ''); //tainted
  }
}

// initialize the base query
$base_plants_query = "SELECT entries.id AS 'entries.id', entries.plant_id AS 'entries.plant_id', entries.file_ext AS 'entries.file_ext', entries.collo_name AS 'entries.collo_name' FROM entries INNER JOIN entry_tags ON entries.id = entry_tags.entry_id";

// get the user data and store them as true or false
if (is_user_logged_in()) {
  // admins user data
  $filter_constr = (bool)($constructive ?? NULL); // untrusted
  $filter_sensory = (bool)($sensory ?? NULL); // untrusted
  $filter_physical = (bool)($physical ?? NULL); // untrusted
  $filter_imag = (bool)($imaginative ?? NULL); // untrusted
  $filter_rest = (bool)($restorative ?? NULL); // untrusted
  $filter_exp = (bool)($expressive ?? NULL); // untrusted
  $filter_rules = (bool)($rules ?? NULL); // untrusted
  $filter_bio = (bool)($bio ?? NULL); // untrusted
} else {
  // consumers user data
  $filter_shrub = (bool)($shrub ?? NULL); // untrusted
  $filter_grass = (bool)($grass ?? NULL); // untrusted
  $filter_vine = (bool)($vine ?? NULL); // untrusted
  $filter_tree = (bool)($tree ?? NULL); // untrusted
  $filter_flower = (bool)($flower ?? NULL); // untrusted
  $filter_groundcovers = (bool)($groundcovers ?? NULL); // untrusted
  $filter_other = (bool)($other ?? NULL); // untrusted
}
// both user data
$filter_sort = (bool)($sort ?? NULL); // untrusted

$filter_types_exprs = array();
$filter_class_exprs = array();
$order_expr = "";

// admins filter options
if (is_user_logged_in()) {
  if ($filter_constr) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 1)");
  }
  if ($filter_sensory) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 2)");
  }
  if ($filter_physical) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 3)");
  }
  if ($filter_imag) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 4)");
  }
  if ($filter_rest) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 5)");
  }
  if ($filter_exp) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 6)");
  }
  if ($filter_rules) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 7)");
  }
  if ($filter_bio) {
    array_push($filter_types_exprs, "(entry_tags.tag_id = 8)");
  }
} else {
  // consumers filter options
  if ($filter_shrub) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 9)");
  }
  if ($filter_grass) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 10)");
  }
  if ($filter_vine) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 11)");
  }
  if ($filter_tree) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 12)");
  }
  if ($filter_flower) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 13)");
  }
  if ($filter_groundcovers) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 14)");
  }
  if ($filter_other) {
    array_push($filter_class_exprs, "(entry_tags.tag_id = 15)");
  }
}
// both filter options
if ($filter_sort) {
  if (is_user_logged_in()) {
    if ($sort == 'name_asc') {
      $order_expr = " ORDER BY entries.collo_name ASC;";
    } else if ($sort == 'name_desc') {
      $order_expr = " ORDER BY entries.collo_name DESC;";
    } else if ($sort == 'id_asc') {
      $order_expr = " ORDER BY entries.plant_id ASC;";
    } else {
      $order_expr = " ORDER BY entries.plant_id DESC;";
    }
  } else {
    if ($sort == 'name_asc') {
      $order_expr = " ORDER BY entries.collo_name ASC;";
    }
    if ($sort == 'name_desc') {
      $order_expr = " ORDER BY entries.collo_name DESC;";
    }
  }
}

// build admin final query
if (count($filter_types_exprs) > 0) {
  $final_plants_query = "SELECT COUNT(*), entries.id AS 'entries.id', entries.plant_id AS 'entries.plant_id', entries.file_ext AS 'entries.file_ext', entries.collo_name AS 'entries.collo_name' FROM entries INNER JOIN entry_tags ON entries.id = entry_tags.entry_id WHERE " . implode(' OR ', $filter_types_exprs) . " GROUP BY entries.id HAVING COUNT(*) = " . count($filter_types_exprs) . $order_expr;
} else if ($filter_sort) {
  $final_plants_query = "SELECT entries.id AS 'entries.id', entries.plant_id AS 'entries.plant_id', entries.file_ext AS 'entries.file_ext', entries.collo_name AS 'entries.collo_name' FROM entries" . $order_expr;
} else {
  $final_plants_query = "SELECT entries.id AS 'entries.id', entries.plant_id AS 'entries.plant_id', entries.file_ext AS 'entries.file_ext', entries.collo_name AS 'entries.collo_name' FROM entries;";
}
// build consumer final query
if (count($filter_class_exprs) > 0) {
  $final_plants_query = $base_plants_query . ' WHERE ' . implode(' OR ', $filter_class_exprs) . $order_expr;
} else if ($filter_sort && count($filter_types_exprs) == 0) {
  $final_plants_query = "SELECT entries.id AS 'entries.id', entries.plant_id AS 'entries.plant_id', entries.file_ext AS 'entries.file_ext', entries.collo_name AS 'entries.collo_name' FROM entries" . $order_expr;
} else if (count($filter_types_exprs) == 0) {
  $final_plants_query = "SELECT entries.id AS 'entries.id', entries.plant_id AS 'entries.plant_id', entries.file_ext AS 'entries.file_ext', entries.collo_name AS 'entries.collo_name' FROM entries;";
}

$plants = exec_sql_query($db, $final_plants_query)->fetchAll();

// join entries, entry_tags, and tags table to get tag names for all plants
$tags_query = "SELECT tags.tag_name AS 'tags.tag_name', entry_tags.entry_id AS 'entry_tags.entry_id', entry_tags.tag_id AS 'entry_tags.tag_id' FROM entries INNER JOIN entry_tags ON entry_tags.entry_id = entries.id INNER JOIN tags ON tags.id = entry_tags.tag_id;";
$tags = exec_sql_query($db, $tags_query)->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Playful Plants | Plant Catalog</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
</head>

<body>

  <?php include('includes/nav.php'); ?>
  <div class="catalog">
    <!-- Filtering form -->
    <aside>
      <p class="feedback <?php echo $filter_feedback_class; ?>">Please select at least 1 option</p>
      <h2>Filter by Types</h2>
      <div id="show-filter-btn">
        <p>Show all filtering options &#8595;</p>
      </div>
      <div id="hide-filter-btn" class="hidden">
        <p>Hide all filtering options &#8593;</p>
      </div>

      <form id="filter-form" method="get" action="/plant-catalog" novalidate>
        <?php if (is_user_logged_in()) { ?>
          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="const-play" name="constructive" <?php echo htmlspecialchars($sticky_constr); ?> />
            <label for="const-play">Supports Exploratory Constructive Play</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="sense-play" name="sensory" <?php echo htmlspecialchars($sticky_sensory); ?> />
            <label for="sense-play">Supports Exploratory Sensory Play</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="phys-play" name="physical" <?php echo htmlspecialchars($sticky_physical); ?> />
            <label for="phys-play">Supports Physical Play</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="imag-play" name="imaginative" <?php echo htmlspecialchars($sticky_imag); ?> />
            <label for="imag-play">Supports Imaginative Play</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="rest-play" name="restorative" <?php echo htmlspecialchars($sticky_rest); ?> />
            <label for="rest-play">Supports Restorative Play</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="exp-play" name="expressive" <?php echo htmlspecialchars($sticky_exp); ?> />
            <label for="exp-play">Supports Expressive Play</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="rules-play" name="rules" <?php echo htmlspecialchars($sticky_rules); ?> />
            <label for="rules-play">Supports Play with Rules</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="bio-play" name="bio" <?php echo htmlspecialchars($sticky_bio); ?> />
            <label for="bio-play">Supports Bio Play</label>
          </div>
        <?php } ?>

        <?php if (!is_user_logged_in()) { ?>
          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="shrub" name="shrub" <?php echo htmlspecialchars($sticky_shrub); ?> />
            <label for="shrub">Shrub</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="grass" name="grass" <?php echo htmlspecialchars($sticky_grass); ?> />
            <label for="grass">Grass</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="vine" name="vine" <?php echo htmlspecialchars($sticky_vine); ?> />
            <label for="vine">Vine</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="tree" name="tree" <?php echo htmlspecialchars($sticky_tree); ?> />
            <label for="tree">Tree</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="flower" name="flower" <?php echo htmlspecialchars($sticky_flower); ?> />
            <label for="flower">Flower</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="groundcovers" name="groundcovers" <?php echo htmlspecialchars($sticky_groundcovers); ?> />
            <label for="groundcovers">Groundcovers</label>
          </div>

          <div class="filter-option show-filter-option hidden">
            <input type="checkbox" id="other" name="other" <?php echo htmlspecialchars($sticky_other); ?> />
            <label for="other">Other (Mosses, Ferns, Vegetables, etc.)</label>
          </div>
        <?php } ?>

        <!-- Sorting part -->
        <h2>Sort the Plants</h2>
        <div id="show-sort-btn">
          <p>Show all sorting options &#8595;</p>
        </div>
        <div id="hide-sort-btn" class="hidden">
          <p>Hide all sorting options &#8593;</p>
        </div>

        <div role="group">

          <div class="filter-option show-sort-option hidden">
            <input type="radio" id="name_asc" name="sort" value="name_asc" <?php echo htmlspecialchars($sticky_name_asc); ?> />
            <label for="name_asc">Plant Colloquial Name <strong>A-Z</strong></label>
          </div>

          <div class="filter-option show-sort-option hidden">
            <input type="radio" id="name_desc" name="sort" value="name_desc" <?php echo htmlspecialchars($sticky_name_desc); ?> />
            <label for="name_desc">Plant Colloquial Name <strong>Z-A</strong></label>
          </div>
          <?php if (is_user_logged_in()) { ?>
            <div class="filter-option show-sort-option hidden">
              <input type="radio" id="id_asc" name="sort" value="id_asc" <?php echo htmlspecialchars($sticky_id_asc); ?> />
              <label for="id_asc">Plant ID <strong>A-Z</strong></label>
            </div>

            <div class="filter-option show-sort-option hidden">
              <input type="radio" id="id_desc" name="sort" value="id_desc" <?php echo htmlspecialchars($sticky_id_desc); ?> />
              <label for="id_desc">Plant ID <strong>Z-A</strong></label>
            </div>
          <?php } ?>
        </div>

        <div class="align-right">
          <input id="filter-submit" type="submit" name="filtered" value="apply" />
        </div>
      </form>
    </aside>

    <main>
      <h1>Plant Catalog</h1>
      <?php if (is_user_logged_in()) { ?>
        <a class="align-right add-link" href="/add-plants">&#43; Add A Plant</a>
      <?php } ?>
      <div class="grid-catalog">
        <?php foreach ($plants as $record) {
        ?>
          <div class="grid">
            <a href="<?php echo "plant-detail?id=" . $record['entries.id']; ?>"><img src="<?php echo "/public/uploads/images/" . htmlspecialchars($record['entries.id']) . "." . htmlspecialchars($record['entries.file_ext']); ?>" alt="a plant image" /></a>
            <?php if (is_user_logged_in()) { ?><p class="plant-id"><?php echo htmlspecialchars($record['entries.plant_id']); ?></p><?php } ?>
            <h3><?php echo htmlspecialchars($record['entries.collo_name']); ?></h3>
            <div>
              <?php
              if (is_user_logged_in()) {
                foreach ($tags as $tag) {
                  if ($tag['entry_tags.entry_id'] == $record['entries.id'] && $tag['entry_tags.tag_id'] < 9) {
              ?>
                    <span class="tag"><?php echo htmlspecialchars($tag['tags.tag_name']) ?></span>
                  <?php }
                }
              } else {
                foreach ($tags as $tag) {
                  if ($tag['entry_tags.entry_id'] == $record['entries.id'] && $tag['entry_tags.tag_id'] > 8) { ?>
                    <span class="tag"><?php echo htmlspecialchars($tag['tags.tag_name']) ?></span>
              <?php }
                }
              } ?>
            </div>

          </div>
        <?php } ?>

      </div>
    </main>
  </div>
  <?php include('includes/footer.php'); ?>

  <script type="text/javascript" src="/public/scripts/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="/public/scripts/filter.js"></script>
</body>

</html>
