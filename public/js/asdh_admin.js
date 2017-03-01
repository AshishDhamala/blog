$(document).ready(function () {
  var $asdhDeleteConfirmationDialogue     = $('.asdh-delete_confirmation_dialogue');
  var $asdhFormDeleteConfirmationDialogue = $('form.asdh-delete_confirmation_dialogue');

  $('.asdh-delete_confirmation_dialogue_toggle').click(function (event) {
    event.preventDefault();
    $(this).siblings('.asdh-delete_confirmation_dialogue').fadeIn();
    // this helps to make background slightly black
    add_black_background();
  });

  $asdhDeleteConfirmationDialogue.children('a').click(function (event) {
    event.preventDefault();
    $asdhDeleteConfirmationDialogue.slideUp();
    remove_black_background();
  });

  var $asdhMessage = $('.asdh-message');
  $asdhFormDeleteConfirmationDialogue.submit(function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    var id  = $(this).attr('data-id');
    $.ajax({
      url    : url,
      type   : 'DELETE',
      success: function (data) {
        if (data == "no") {
          data = "Sorry!!!  It could not be deleted."
        }
        $('#asdh-' + id).fadeOut(function () {
          $asdhMessage.children('h3').html(data);
          $asdhMessage.fadeIn();
        });
        setTimeout(function () {
          $asdhMessage.fadeOut();
          remove_black_background();
        }, 2500);
      },
      error  : function (data) {
        console.log('Error:', data);
      }
    });
  });

  var $asdhEditAndDelete  = $('.asdh-edit_and_delete');
  var $create             = $('#create');
  var $show               = $('#show');
  var $deleteMultiple     = $('#delete_multiple');
  var $asdhActiveNavAdmin = $('.asdh-active_nav_admin');

  $asdhEditAndDelete.children('a').makeUpperHalfGlossy();
  $create.makeUpperHalfGlossy();
  $show.makeUpperHalfGlossy();
  $deleteMultiple.makeUpperHalfGlossy({
    'borderRadius': '4px 4px 50% 50%',
    'bottom'      : '20%'
  });
  $asdhActiveNavAdmin.children('a').makeUpperHalfGlossy({
    'background'  : 'rgba(255,255,255,0.3)',
    'borderRadius': '0 0 4px 4px'
  });
});