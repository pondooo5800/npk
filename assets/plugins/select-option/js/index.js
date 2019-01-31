$(function () {
  $('#colorselector').change(function () {
    $('.type-value').hide();
    $('#' + $(this).val()).show();
  });
});