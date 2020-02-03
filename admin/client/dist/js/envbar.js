var envType = '$EnvType';
(function ($) {
  $(document).ready(function () {
    $('.cms-menu').prepend('<div class="cms__envbar cms__envbar--' + envType.toLowerCase() + '">' + envType.toUpperCase() + '</div>');
  })
})(jQuery);