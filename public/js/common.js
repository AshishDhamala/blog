$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.asdh-center_image_inside_me').each(function () {
    asdhCenterImageInsideMe($(this));
  });

  var $alert                          = $('.alert');
  var $asdhDeleteConfirmationDialogue = $('.asdh-delete_confirmation_dialogue');

  setTimeout(function () {
    if (!$alert.hasClass('stay')) {
      $alert.slideUp();
      remove_black_background();
    }
  }, 2500);

  $(document).mouseup(function (e) {
    if (!$alert.is(e.target) && $alert.has(e.target).length == 0) {
      $alert.slideUp();
    }
    if (!$asdhDeleteConfirmationDialogue.is(e.target) && $asdhDeleteConfirmationDialogue.has(e.target).length == 0) {
      $asdhDeleteConfirmationDialogue.slideUp();
      remove_black_background();
    }
  });

  $(document).keyup(function (e) {
    // thi key code is for esc
    if (e.keyCode == 27) {
      $alert.slideUp("fast");
      $asdhDeleteConfirmationDialogue.slideUp();
      remove_black_background();
    }
  });

});

function asdhCenterImageInsideMe($imageContainer) {
  var $image                  = $imageContainer.children('img');
  var containerHeight         = $imageContainer.height();
  var imageHeight             = $image.height();
  var imageWidth              = $image.width();
  var heightDifference        = containerHeight - imageHeight;
  var newImageWidthPercentage = 100;

  if (containerHeight > imageHeight) {
    var fractionalChange    = heightDifference / imageHeight;
    newImageWidthPercentage = 100 + fractionalChange * 100;
    $image.css({
      width: newImageWidthPercentage + '%',
      left : -( fractionalChange * imageWidth / 2 )
    });
  } else if (containerHeight < imageHeight) {
    $image.css({
      top : heightDifference / 2,
      left: 0
    });
  } else {
    $image.css({
      top : 0,
      left: 0
    });
  }
}

function add_black_background() {
  $('body').after('<div id="make_bg_black" style="position: fixed; top: 0; right: 0; bottom: 0; left: 0; background: rgba(0,0,0,0.8);"></div>');
}
function remove_black_background() {
  $('#make_bg_black').fadeOut(function () {
    $(this).remove();
  });
}
function seconds_to_time(totalSeconds) {
  var years            = Math.floor(totalSeconds / (60 * 60 * 24 * 30 * 12));
  var remainingSeconds = totalSeconds - years * (60 * 60 * 24 * 30 * 12);

  var months       = Math.floor(remainingSeconds / (60 * 60 * 24 * 30));
  remainingSeconds = remainingSeconds - months * (60 * 60 * 24 * 30);

  var days         = Math.floor(remainingSeconds / (60 * 60 * 24));
  remainingSeconds = remainingSeconds - days * (60 * 60 * 24);

  var hours        = Math.floor(remainingSeconds / (60 * 60));
  remainingSeconds = remainingSeconds - hours * (60 * 60);

  var minutes = Math.floor(remainingSeconds / 60);
  var seconds = remainingSeconds % 60;

  // $('#contribution_time').text(years + "years " + months + "months " + days + "days " + hours + "hours " + minutes + "minutes " + seconds + "seconds");
  $('#contribution_time').text(years + "y " + months + "m " + days + "d " + hours + "h " + minutes + "m " + seconds + "s");
}
/*function makeUpperHalfGlossy($element, color) {
 color = '#FFFFFF' || color;
 $element.css({'position': 'relative', 'color': color}).append('<div class="asdh-title_awesome"></div>');
 $element.children('.asdh-title_awesome').css({
 'position'     : 'absolute',
 'top'          : '2px',
 'left'         : '2px',
 'right'        : '2px',
 'bottom'       : '50%',
 'border-radius': '4px',
 'background'   : 'rgba(255,255,255,0.2)'
 });
 }*/
$.fn.makeUpperHalfGlossy = function (specs) {
  specs              = specs || {};
  specs.color        = specs.color || '#FFFFFF';
  specs.top          = specs.top || '1px';
  specs.left         = specs.left || '1px';
  specs.right        = specs.right || '1px';
  specs.bottom       = specs.bottom || '40%';
  specs.borderRadius = specs.borderRadius || '4px';
  specs.background   = specs.background || 'rgba(255,255,255,0.3)';
  $(this).css({'position': 'relative', 'color': specs.color}).append('<div class="asdh-title_awesome"></div>');
  $(this).children('.asdh-title_awesome').css({
    'position'    : 'absolute',
    'top'         : specs.top,
    'left'        : specs.left,
    'right'       : specs.right,
    'bottom'      : specs.bottom,
    'borderRadius': specs.borderRadius,
    'background'  : specs.background
  });
};
