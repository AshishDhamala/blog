$(document).ready(function () {
  var $asdhTopBar          = $('.asdh-top_bar');
  var $asdhNavigationItems = $('.asdh-navigation_items');
  $asdhTopBar.children('i').click(function () {
    $asdhNavigationItems.fadeToggle();
  });
  $(window).resize(function () {
    if ($asdhNavigationItems.css("display") == "none") {
      $asdhNavigationItems.show();
    }
    if ($(window).width() <= 768) {
      $asdhNavigationItems.hide();
    }
  });
  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $('#asdh-navigation').css({
        'position': 'fixed',
        'top'     : 0,
        'left'    : 0
      });
    } else {
      $('#asdh-navigation').css({
        'position': 'relative'
      });
    }
  });
});