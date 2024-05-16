$(function () {
  /**
   * Mobile nav toggle
   */
  $(".mobile-nav-toggle").on("click", function () {
    $(".site-nav").toggleClass("site-nav-mobile");
    $(this).toggleClass("bi-list");
    $(this).toggleClass("bi-x");
  });

  /**
   * Nav dropdown toggle
   */

  $(".dropdown-toggle").on("click", function () {
    $(".dropdown-menu").toggleClass("show");
  });

  /**
   * Close the dropdown if the user clicks outside of it
   */

  $(document).on("click", function (e) {
    if (
      !e.target.matches(".dropdown-menu") &&
      !e.target.matches(".dropdown-toggle")
    ) {
      $(".dropdown-menu").removeClass("show");
    }
  });

  /**
   * Sidebar dropdown toggle
   */
  $(".dropdown-link").on("click", function () {
    if ($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
    } else {
      $(".dropdown-item.open")?.removeClass("open");
      $(this).parent().addClass("open");
    }
  });

  /**
   *  Modal open functionality
   */
  $(".delete-btn").on("click", function () {
    let modal = "#" + $(this).attr("modal-target");
    let modalInput = "#" + $(this).attr("modal-target") + "-input";
    let id = $(this).attr("delete-id");
    $(modalInput).val(id);
    $(modal).addClass("show");
  });

  /**
   *  Modal close functionality
   */
  $(".modal-close, .delete-modal, .btn-cancel").on("click", function (e) {
    if (
      e.target.matches(".modal-close") ||
      e.target.matches(".delete-modal") ||
      e.target.matches(".btn-cancel")
    ) {
      let modalInput = "#" + $(".delete-modal").attr("id") + "-input";
      $(modalInput).val(null);
      $(".delete-modal").removeClass("show");
    }
  });
});

/**
 *  Print functionality
 */
$("#printButton").on("click", function () {
  $(".return-home").remove();
  window.print();
});
