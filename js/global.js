// Mobile Menu
jQuery(function(){
  jQuery('#mobinav ul.top-nav li').each(function() {
    if(jQuery('.sub-menu',this).length) {
      jQuery('> a',this).addClass('toggle-submenu');
      jQuery('.sub-menu',this).each(function() {
        jQuery(this).addClass('level-'+jQuery(this).parents('#mobinav .sub-menu').length);
      });
    }
  });
  jQuery('#mobinav ul.monav li.has-submenu',this).append('<i class="fa fa-angle-down"></i>');

  //subnav toggle
  jQuery('ul.monav i').on('click', function(e){
    e.preventDefault();
    jQuery('#mobinav li').not(jQuery(this).parents('li')).removeClass('shrink');
    jQuery(this).closest('li').toggleClass('shrink');
  });
});
function openNav() {
  document.getElementById("mobinav").style.width = "100%";
}
function closeNav() {
  document.getElementById("mobinav").style.width = "0";
}

var app = {
  init: function() {
    app.headerScroll();
    app.sliderDeals()
    app.sliderMain();
    app.contactMap();
    app.clientSlider();
    //app.introPopup();
  },
  headerScroll: function(){
    var header = jQuery("#section-top");
  	jQuery(window).on('load ready resize scroll',function(){
  		var scroll = jQuery(window).scrollTop();
  		if (scroll >= 140) {
  			header.removeClass('navbar-default').addClass("scrolled");
  		} else {
  			header.removeClass("scrolled").addClass('navbar-default');
  		}
  	});
  },
  sliderDeals: function(){
    jQuery('.product-slide').owlCarousel({
        loop:true,
        lazyLoad:true,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                loop: true,
            },
            480:{
                items:1,
                nav:false,
                loop: true
            },
            768:{
                items:1,
                nav:false,
                loop:true
            }
        }
    })
  },
  sliderMain: function(){
    jQuery('#slider-main').owlCarousel({
      loop:true,
      nav:true,
      autoplay:true,
      autoplayTimeout:6000,
      autoplayHoverPause:true,
      smartSpeed: 2500,
      navText : ["<i class='icon-left-open-big'></i>","<i class='icon-right-open-big'></i>"],
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
    })
  },
  clientSlider: function(){
      jQuery('.slider-clients .owl-carousel').owlCarousel({
        loop:true,
        nav:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        //animateOut: 'fadeOut',
        navText : ["<i class='ti-angle-left'></i>","<i class='ti-angle-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
      })
  },
  contactMap: function(){
    if(jQuery('#map-canvas').length){
      function initialise() {
        var myLatlng = new google.maps.LatLng(-7.781704, 110.408405); // Add the coordinates
        var mapOptions = {
            zoom: 16, // The initial zoom level when your map loads (0-20)
            minZoom: 6, // Minimum zoom level allowed (0-20)
            maxZoom: 17, // Maximum soom level allowed (0-20)
            zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
            zoomControlOptions: {
                    style:google.maps.ZoomControlStyle.DEFAULT // Change to SMALL to force just the + and - buttons.
            },
            center: myLatlng, // Centre the Map to our coordinates variable
            mapTypeId: google.maps.MapTypeId.ROADMAP, // Set the type of Map
            scrollwheel: false, // Disable Mouse Scroll zooming (Essential for responsive sites!)
            // All of the below are set to true by default, so simply remove if set to true:
            panControl:false, // Set to false to disable
            mapTypeControl:false, // Disable Map/Satellite switch
            scaleControl:false, // Set to false to hide scale
            streetViewControl:false, // Set to disable to hide street view
            overviewMapControl:false, // Set to false to remove overview control
            rotateControl:false // Set to false to disable rotate control
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions); // Render our map within the empty div
        var image = new google.maps.MarkerImage("https://image.flaticon.com/icons/svg/787/787535.svg", null, null, null, new google.maps.Size(40,40)); // Create a variable for our marker image.
        var marker = new google.maps.Marker({ // Set the marker
            position: myLatlng, // Position marker to coordinates
            icon:image, //use our image as the marker
            map: map, // assign the market to our map variable
            title: 'Click here for more details' // Marker ALT Text
        });
        //  google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
        //      window.location='http://www.snowdonrailway.co.uk/shop_and_cafe.php'; // URL to Link Marker to (i.e Google Places Listing)
        //  });
        var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
                content:"<strong>Eastparc Hotel Yogyakarta</strong>, best price guarantee!!" // HTML contents of the InfoWindow
            });
        google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
                infowindow.open(map,marker); // Open our InfoWindow
            });
        google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(myLatlng); }); // Keeps the Pin Central when resizing the browser on responsive sites
    }
      google.maps.event.addDomListener(window, 'load', initialise); // Execute our 'initialise' function once the page has loaded.
    }
  },
};
jQuery(document).ready(function($){
app.init();
})
