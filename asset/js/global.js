var app = {
  init: function($) {
    app.headerScrollz($);
    app.toggler($);
    app.headerScroll($);
  },
  headerScrollz: function($){
    if ($('body').hasClass('post-template') && !$('body').hasClass('post-template-single-blog')) {
      var boxWrap = $('.box-wrap');
      var sideContact = $('.side-contact');

      $(window).scroll(function() {
          var scrollPos = $(this).scrollTop();
          var boxWrapBottom = boxWrap.offset().top + boxWrap.outerHeight();
          
          if (scrollPos > boxWrap.offset().top && scrollPos < boxWrapBottom) {
              sideContact.addClass('sticky');
          } else {
              sideContact.removeClass('sticky');
          }
      });
    }
  },
  toggler: function($){
    $('.navbar-toggler').on('click', function() {
        var isExpanded = $(this).attr('aria-expanded') === 'true';
        if (isExpanded) {
            $(this).removeClass('collapsed');
        } else {
            $(this).addClass('collapsed');
        }
    });
  },
  headerScroll: function($){
    $(document).ready(function() {
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 20) {
                $( "body .navbar" ).addClass('changeups');
            } else {
                $( "body .navbar").removeClass('changeups');
            }
        });
    });
  }

};
jQuery(document).ready(function($){
    app.init($);
})
