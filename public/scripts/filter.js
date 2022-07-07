// $("#const-play").on("click", function () {
//   $("#filter-form").requestSubmit();
// });

// $("#sense-play").on("click", function () {
//   $("#filter-form").requestSubmit();
// });

// Source: (original work) Phyllis Ju
if ($(window).width() > 800) {
  $("#show-filter-btn").addClass("hidden");
  $("#hide-filter-btn").addClass("hidden");
  $("#show-sort-btn").addClass("hidden");
  $("#hide-sort-btn").addClass("hidden");
  $(".show-filter-option").removeClass("hidden");
  $(".show-sort-option").removeClass("hidden");
}
if ($(window).width() <= 800) {
  $("#show-filter-btn").removeClass("hidden");
  $("#show-sort-btn").removeClass("hidden");
  $(".show-filter-option").addClass("hidden");
  $(".show-sort-option").addClass("hidden");

  $("#show-filter-btn").click(function () {
    $(".show-filter-option").removeClass("hidden");
    $("#hide-filter-btn").removeClass("hidden");
    $("#show-filter-btn").addClass("hidden");
  });

  $("#hide-filter-btn").click(function () {
    $(".show-filter-option").addClass("hidden");
    $("#hide-filter-btn").addClass("hidden");
    $("#show-filter-btn").removeClass("hidden");
  });

  $("#show-sort-btn").click(function () {
    $(".show-sort-option").removeClass("hidden");
    $("#show-sort-btn").addClass("hidden");
    $("#hide-sort-btn").removeClass("hidden");
  });

  $("#hide-sort-btn").click(function () {
    $(".show-sort-option").addClass("hidden");
    $("#hide-sort-btn").addClass("hidden");
    $("#show-sort-btn").removeClass("hidden");
  });
}

$(window).resize(function () {
  if ($(window).width() > 800) {
    $("#show-filter-btn").addClass("hidden");
    $("#hide-filter-btn").addClass("hidden");
    $("#show-sort-btn").addClass("hidden");
    $("#hide-sort-btn").addClass("hidden");
    $(".show-filter-option").removeClass("hidden");
    $(".show-sort-option").removeClass("hidden");
  }
  if ($(window).width() <= 800) {
    $("#show-filter-btn").removeClass("hidden");
    $("#show-sort-btn").removeClass("hidden");
    $(".show-filter-option").addClass("hidden");
    $(".show-sort-option").addClass("hidden");

    $("#show-filter-btn").click(function () {
      $(".show-filter-option").removeClass("hidden");
      $("#hide-filter-btn").removeClass("hidden");
      $("#show-filter-btn").addClass("hidden");
    });

    $("#hide-filter-btn").click(function () {
      $(".show-filter-option").addClass("hidden");
      $("#hide-filter-btn").addClass("hidden");
      $("#show-filter-btn").removeClass("hidden");
    });

    $("#show-sort-btn").click(function () {
      $(".show-sort-option").removeClass("hidden");
      $("#show-sort-btn").addClass("hidden");
      $("#hide-sort-btn").removeClass("hidden");
    });

    $("#hide-sort-btn").click(function () {
      $(".show-sort-option").addClass("hidden");
      $("#hide-sort-btn").addClass("hidden");
      $("#show-sort-btn").removeClass("hidden");
    });
  }
});
