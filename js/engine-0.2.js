jQuery.fn.extend({
    greedyScroll: function(sensitivity) {
        return this.each(function() {
            jQuery(this).bind('mousewheel DOMMouseScroll', function(evt) {
               var delta;
               if (evt.originalEvent) {
                  delta = -evt.originalEvent.wheelDelta || evt.originalEvent.detail;
               }
               if (delta !== null) {
                  evt.preventDefault();
                  if (evt.type === 'DOMMouseScroll') {
                     delta = delta * (sensitivity ? sensitivity : 20);
                  }
                  return jQuery(this).scrollTop(delta + jQuery(this).scrollTop());
               }
            });
        });
    }
});



jQuery(document).ready(function(){
    var slideout = new Slideout({
        'panel': document.getElementById('panel'),
        'menu': document.getElementById('menu'),
        'padding': 256,
        'tolerance': 70,
        'easing': 'ease-in-out',
    });
    document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
        slideout.toggle();
        var text = jQuery('.js-slideout-toggle i').text() == 'close' ? 'menu' : 'close';
        jQuery('.js-slideout-toggle i').text(text);
    });
    document.querySelector('.menu').addEventListener('click', function(eve) {
        if (eve.target.nodeName === 'A') {
            slideout.close();
        }
    });
    slideout.on('open', function() {
        jQuery('.js-slideout-toggle i').text('close');
    });
    slideout.on('close', function() {
        jQuery('.js-slideout-toggle i').text('menu');
    });


    jQuery('.dropdown-toggle').click(function() {
        jQuery(this).siblings('.dropdown-menu').toggleClass('collapsed expanded');
    });




	// show first content by default
    jQuery('#tabs-nav li:first-child').addClass('active');
    jQuery('#tabs .content').hide();
    jQuery('#tabs .content:first').show();

    // click function
    jQuery('#tabs-nav li').click(function(){
      jQuery('#tabs-nav li').removeClass('active');
      jQuery(this).addClass('active');
      jQuery('#tabs .content').hide();

      var activeTab = jQuery(this).find('a').attr('href');
      jQuery(activeTab).fadeIn();
      return false;

    });

    jQuery('<div class="background-gradient"></div>').appendTo('.item');
    jQuery('<div class="background-gradient"></div>').appendTo('.sales li');
});
