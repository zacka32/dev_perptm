(function($){
    "use strict";

    // page-progress
    var progressPath = document.querySelector(".progress-wrap path");
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "stroke-dashoffset 10ms linear";
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength) / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    jQuery(window).on("scroll", function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery(".progress-wrap").addClass("active-progress");
      } else {
        jQuery(".progress-wrap").removeClass("active-progress");
      }
    });
    jQuery(".progress-wrap").on("click", function (event) {
      event.preventDefault();
      jQuery("html, body").animate({ scrollTop: 0 }, duration);
      return false;
    });


     // mobile menu 
     var vlMenuWrap = $('.vl-preview-menu-active > ul').clone();
     var vlSideMenu = $('.vl-offcanvas-menu nav');
     vlSideMenu.append(vlMenuWrap);
     if ($(vlSideMenu).find('.sub-menu, .vl-mega-menu').length != 0) {
       $(vlSideMenu).find('.sub-menu, .vl-mega-menu').parent().append('<button class="vl-menu-close"><i class="fas fa-chevron-right"></i></button>');
     }
 
     var sideMenuList = $('.vl-offcanvas-menu nav > ul > li button.vl-menu-close, .vl-offcanvas-menu nav > ul li.has-dropdown > a');
     $(sideMenuList).on('click', function (e) {
       console.log(e);
       e.preventDefault();
       if (!($(this).parent().hasClass('active'))) {
         $(this).parent().addClass('active');
         $(this).siblings('.sub-menu, .vl-mega-menu').slideDown();
       } else {
         $(this).siblings('.sub-menu, .vl-mega-menu').slideUp();
         $(this).parent().removeClass('active');
       }
     });


 $(".vl-offcanvas-toggle").on('click',function(){
     $(".vl-offcanvas").addClass("vl-offcanvas-open");
     $(".vl-offcanvas-overlay").addClass("vl-offcanvas-overlay-open");
 });

 $(".vl-offcanvas-close-toggle,.vl-offcanvas-overlay").on('click', function(){
     $(".vl-offcanvas").removeClass("vl-offcanvas-open");
     $(".vl-offcanvas-overlay").removeClass("vl-offcanvas-overlay-open");
 });
    
    // stiky js
    var windowOn = $(window);
    windowOn.on('scroll', function () {
      var scroll = windowOn.scrollTop();
      if (scroll < 100) {
        $("#vl-header-sticky").removeClass("header-sticky");
      } else {
        $("#vl-header-sticky").addClass("header-sticky");
      }
    });

})(jQuery);