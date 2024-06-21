$(function() {

    // Define window variables

    var winScrollTop = $(window).scrollTop();
    var winHeight = window.innerHeight;
    var winWidth = window.innerWidth;

    // Define scene classes.
    var sceneClass = 'scene';
    var sceneActiveClass = sceneClass + '--active';
    var sceneEndedClass = sceneClass + '--ended';

    $(window).on('resize', function() {
        winHeight = window.innerHeight;
        winWidth = window.innerWidth;
    });

    // Scene classes function.
    function setScene($el) {

        // Get bounding values from section.
        var bounding = $el.data('elDom').getBoundingClientRect();

        if (bounding.top > winHeight) {

            // Section is below the viewport.
            // Section has not ended or started, therefore remove classes.
            $el.find('.scene').removeClass(sceneActiveClass);
            $el.find('.scene').removeClass(sceneEndedClass);

        } else if (bounding.bottom < 0) {

            // Section is above the viewport.
            // Section has ended, therefore remove classes.
            $el.find('.scene').addClass(sceneEndedClass);
            $el.find('.scene').removeClass(sceneActiveClass);

        } else {

            // We're now inside the section, not below or above.
            // If top of section is at top of viewport, add class active.
            if (bounding.top <= 0) {
                $el.find('.scene').addClass(sceneActiveClass);
            }

            // If top of section is below top of viewport, remove class active.
            if (bounding.top > 0) {
                $el.find('.scene').removeClass(sceneActiveClass);
            }

            // If bottom of section is at bottom of viewport, add class ended.
            if (bounding.bottom <= (winHeight)) {
                $el.find('.scene').addClass(sceneEndedClass);
            }

            // If bottom of section is not at bottom of viewport, remove class ended.
            if (bounding.bottom > (winHeight)) {
                $el.find('.scene').removeClass(sceneEndedClass);
            }
        }
    }

    // This function sets up the horizontal scroll. This applies data attributes to the section for later use.
    function setUpHorizontalScroll($el) {

        var sectionClass = $el.attr('class');

        // Set content wrapper variables & data attributes.
        var $contentWrapper = $el.find('.' + sectionClass + '__content-wrapper');
        var contentWrapperDom = $contentWrapper.get(0);
        $el.data('contentWrapper', $contentWrapper);
        $el.data('contentWrapperDom', contentWrapperDom);

        // Set content wrapper scroll width variables & data attributes.
        var contentWrapperScrollWidth = $el.data('contentWrapperDom').scrollWidth;
        $el.data('contentWrapperScrollWidth', contentWrapperScrollWidth);

        // Set right max variables & data attributes.
        var rightMax = $el.data('contentWrapperScrollWidth') - winWidth;
        var rightMaxMinus = -(rightMax);
        $el.data('rightMax', Number(rightMaxMinus));

        // Set initialized data variable to false do incidate scrolling functionality doesn't work yet.
        $el.data('initalized', false);

        // Set height of section to the scroll width of content wrapper.
        $el.css('height', $el.data('contentWrapperScrollWidth'));

        // Set data attribute for outerHeight.
        $el.data('outerHeight', $el.outerHeight());

        // Set data attribute for offset top.
        $el.data('offsetTop', $el.offset().top);

        // Set data initialized data variable to true to indicate ready for functionality.
        $el.data('initalized', true);

        // Set data variable for transform X (0 by default)
        $el.data('transformX', '0');

        // Add class of init
        $el.addClass($el.attr('class') + '--init');
    }

    function resetHorizontalScroll($el) {


        // Update data attribute for content wrapper scroll width.

        var contentWrapperScrollWidth = $el.data('contentWrapperDom').scrollWidth;
        $el.data('contentWrapperScrollWidth', contentWrapperScrollWidth);


        // Update rightMax variables & data attributes.
        rightMax = $el.data('contentWrapperScrollWidth') - winWidth;
        rightMaxMinus = -(rightMax);
        $el.data('rightMax', Number(rightMaxMinus));

        // Update height of section to the scroll width of content wrapper.
        $el.css('height', $el.data('contentWrapperScrollWidth'));

        // Update data attribute for outerHeight.
        $el.data('outerHeight', $el.outerHeight());

        // Update data attribute for offset top.
        $el.data('offsetTop', $el.offset().top);

        // If transform is smaller than rightmax, make it rightmax.
        if ($el.data('transformX') <= $el.data('rightMax')) {
            $el.data('contentWrapper').css({
                'transform': 'translate3d(' + $el.data('rightMax') + 'px, 0, 0)',
            });
        }
    }

    var $horizontalScrollSections = $('.horizontal-scroll-section');
    var $horizontalScrollSectionsTriggers = $horizontalScrollSections.find('.trigger');

    // Each function - set variables ready for scrolling functionality. Call horizontal scroll functions on load and resize.
    $horizontalScrollSections.each(function(i, el) {

        var $thisSection = $(this);

        $(this).data('elDom', $(this).get(0));

        // Set up horizontal scrolling data attributes and show section all have been computed.
        setUpHorizontalScroll($(this));

        // Now we're ready, call setScene on load that adds classes based on scroll position.
        setScene($(this));

        // Resize function
        $(window).on('resize', function() {
            // Reset horizontal scrolling data attributes and transform content wrapper if transform is bigger than scroll width.
            resetHorizontalScroll($thisSection);
            // Reset scene positioning.
            setScene($thisSection);
        });

    });

    function setupHorizontalTriggers($el, section) {
        var parent = $el.parent();
        var positionLeft = parent.position().left;
        var positionLeftMinus = -(positionLeft);
        var triggerOffset = $el.data('triggerOffset');
        triggerOffset = !triggerOffset ? 0.5 : triggerOffset = triggerOffset;
        $el.data('triggerOffset', triggerOffset);
        $el.data('triggerPositionLeft', positionLeftMinus);
        $el.data('triggerSection', section);
    }

    function useHorizontalTriggers($el) {
        if ($el.data('triggerSection').data('transformX') <= ($el.data('triggerPositionLeft') * $el
                .data(
                    'triggerOffset'))) {
            $el.data('triggerSection').addClass($el.data('class'));
        } else {
            if ($el.data('remove-class') !== false) {
                $el.data('triggerSection').removeClass($el.data('class'));
            }
        }
    }

    $horizontalScrollSectionsTriggers.each(function(i, el) {
        setupHorizontalTriggers($(this), $(this).closest('.horizontal-scroll-section'));
    });

    function transformBasedOnScrollHorizontalScroll($el) {

        // Get amount scrolled variables.
        var amountScrolledContainer = winScrollTop - $el.data('offsetTop');
        var amountScrolledThrough = (amountScrolledContainer / ($el.data('outerHeight') - (winHeight -
            winWidth)));

        // Add transform value variable based on amount scrolled through multiplied by scroll width of content.
        var toTransform = (amountScrolledThrough * $el.data('contentWrapperScrollWidth'));

        // Add transform value for minus (as we're transforming opposite direction).
        var toTransformMinus = -(toTransform);

        // If transform value is bigger or equal than 0, set value to 0.
        toTransformMinus = Math.min(0, toTransformMinus);

        // If transform value is smaller or equal than rightMax, set value to rightMax.
        toTransformMinus = Math.max(toTransformMinus, $el.data('rightMax'));

        // Update transformX data variable for section.
        $el.data('transformX', Number(toTransformMinus));

        // If section has been initalized, apply transform.
        if ($el.data('initalized') == true) {
            $el.data('contentWrapper').css({
                'transform': 'translate3d(' + $el.data('transformX') + 'px, 0, 0)'
            });
        }
    }

    // 
    $(window).on('scroll', function() {

        // Get window scroll top.
        winScrollTop = $(window).scrollTop();

        // Each function in horizontal scroll sections.
        $horizontalScrollSections.each(function(i, el) {
            transformBasedOnScrollHorizontalScroll($(this));
            setScene($(this));
        });

        // Each function for horizontal scroll section triggers.
        $horizontalScrollSectionsTriggers.each(function(i, el) {
            useHorizontalTriggers($(this));
        });

    });

});


$(".abt-studio").click(function() {
    $("html , body").animate({
        scrollTop: $(".black-bg").offset().top - 73
    }, 1300);
});
$(".product-info").click(function() {
    $("html , body").animate({
        scrollTop: $("#slider-bg").offset().top - 0
    }, 1300);
});


$('.owl-carousel').owlCarousel({
    loop: true,
    autoplay:false,
    touchDrag  : true,
    mouseDrag  : true,
   autoplayTimeout:5000,
    dots: false,
    margin: 0,
    autoHeight:true,
    nav: true,
    navText: ["<img src='assets/img/left.png'>",
        "<img src='assets/img/right.png'>"
    ],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});


window.addEventListener('load', videoScroll);
window.addEventListener('scroll', videoScroll);

function videoScroll() {

  if ( document.querySelectorAll('video[autoplay]').length > 0) {
    var windowHeight = window.innerHeight,
        videoEl = document.querySelectorAll('video[autoplay]');

    for (var i = 0; i < videoEl.length; i++) {

      var thisVideoEl = videoEl[i],
          videoHeight = thisVideoEl.clientHeight,
          videoClientRect = thisVideoEl.getBoundingClientRect().top;

      if ( videoClientRect <= ( (windowHeight) - (videoHeight*.5) ) && videoClientRect >= ( 0 - ( videoHeight*.5 ) ) ) {
        thisVideoEl.play();
      } else {
        thisVideoEl.pause();
      }

    }
  }

}



    $(document).ready(function() {
  $(window).scroll(function(){
      if ($(this).scrollTop() > 50) {
         $('.black-bg').addClass('typecustom');
      } else {
         $('.black-bg').removeClass('typecustom');
      }
  });

  $(window).scroll(function(){
    if ($(this).scrollTop() >1000) {
       $('.purifier-bg').addClass('typecustom2');
    } else {
       $('.purifier-bg').removeClass('typecustom2');
    }
});
  $(window).scroll(function(){
    if ($(this).scrollTop() >8000) {
       $('.product-item').addClass('typecustom3');
    } else {
       $('.product-item').removeClass('typecustom3');
    }
});


});




window.document.onkeydown = function(e) {
    if (!e) {
        e = event;
    }
    if (e.keyCode == 27) {
        lightbox_close();
    }
}

function lightbox_open() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideo");
    // window.scrollTo(0, 0);
    document.getElementById('lightone').style.display = 'block';
    document.getElementById('fadeone').style.display = 'block';
    lightBoxVideo.play();
}

function lightbox_close() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideo");
    document.getElementById('lightone').style.display = 'none';
    document.getElementById('fadeone').style.display = 'none';
    lightBoxVideo.pause();
    lightBoxVideo.currentTime = 0;
}



window.document.onkeydown = function(e) {
    if (!e) {
        e = event;
    }
    if (e.keyCode == 27) {
        lightbox_closetwo();
    }
}

function lightbox_opentwo() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideotwo");
    // window.scrollTo(0, 0);
    document.getElementById('lighttwo').style.display = 'block';
    document.getElementById('fadetwo').style.display = 'block';
    lightBoxVideo.play();
}

function lightbox_closetwo() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideotwo");
    document.getElementById('lighttwo').style.display = 'none';
    document.getElementById('fadetwo').style.display = 'none';
    lightBoxVideo.pause();
    lightBoxVideo.currentTime = 0;
}




window.document.onkeydown = function(e) {
    if (!e) {
        e = event;
    }
    if (e.keyCode == 27) {
        lightbox_closethree();
    }
}

function lightbox_openthree() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideothree");
    // window.scrollTo(0, 0);
    document.getElementById('lightthree').style.display = 'block';
    document.getElementById('fadethree').style.display = 'block';
    lightBoxVideo.play();
}

function lightbox_closethree() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideothree");
    document.getElementById('lightthree').style.display = 'none';
    document.getElementById('fadethree').style.display = 'none';
    lightBoxVideo.pause();
    lightBoxVideo.currentTime = 0;
}


window.document.onkeydown = function(e) {
    if (!e) {
        e = event;
    }
    if (e.keyCode == 27) {
        lightbox_closefour();
    }
}

function lightbox_openfour() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideofour");
    // window.scrollTo(0, 0);
    document.getElementById('lightfour').style.display = 'block';
    document.getElementById('fadefour').style.display = 'block';
    lightBoxVideo.play();
}

function lightbox_closefour() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideofour");
    document.getElementById('lightfour').style.display = 'none';
    document.getElementById('fadefour').style.display = 'none';
    lightBoxVideo.pause();
    lightBoxVideo.currentTime = 0;
}

function lightbox_closeaqi() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideoaqi");
    document.getElementById('lightaqi').style.display = 'none';
    document.getElementById('fadeaqi').style.display = 'none';
    lightBoxVideo.pause();
    lightBoxVideo.currentTime = 0;
}
function lightbox_openaqi() {
    var lightBoxVideo = document.getElementById("VisaChipCardVideoaqi");
    // window.scrollTo(0, 0);
    document.getElementById('lightaqi').style.display = 'block';
    document.getElementById('fadeaqi').style.display = 'block';
    lightBoxVideo.play();
}
