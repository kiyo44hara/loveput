$(function() {
  $('.hamburger').on('click', function() {
    $(this).toggleClass('active');

    if ($(this).hasClass('active')) {
      $('.hamburger-menu').addClass('active');
    } else {
      $('.hamburger-menu').removeClass('active');
    }
  });
});
