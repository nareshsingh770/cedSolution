

/*====== mobile menu ======*/
$(document).ready(function () {

  $('.action-transparent-bg').click(function () {
    $('.alertsDropdown-backstage').removeClass('active');
    $(this).hide();
  })
  $('header.base_camp_header #base_camp_fa_bars').click(function () {
    $('header.base_camp_header .mobile-menu-cover .mobile-menu').stop().css({ 'right': '0%', 'visibility': 'visible' });
    $('.content_section .leftpanel').css('z-index', '9');
    $('header.base_camp_header .tintbg').fadeIn();
  });
  $('header.base_camp_header .tintbg').click(function () {
    $('header.base_camp_header .feedback-modals, header.base_camp_header .thanku-modals, header.base_camp_header .contact-modals, header.base_camp_header .contact-modals-main').fadeOut();
    $('header.base_camp_header .feedback-modals input#subject, header.base_camp_header .feedback-modals textarea#message,header.base_camp_header .contact-modals-main .feedback-form input#subject, header.base_camp_header .contact-modals-main .feedback-form textarea#message').val('');
    $(this).fadeOut();
  });
  if ($(window).width() < 995) {
    $('header.base_camp_header .tintbg').click(function () {
      $('header.base_camp_header .mobile-menu-cover .mobile-menu').stop().css({ 'right': '-100%', 'visibility': 'hidden' });
      $('.content_section .leftpanel').animate({ left: "-330px" });
      $('.content_section .leftpanel').css('z-index', '9999');
      aa = "yes";
    });
  }
  /*-- leftmenu --*/
  // $('.leftpanel .leftmenu_toggle_btn').click(function(){
  //    $('.content_section .leftpanel').animate({left: "0px"});
  //    $('header.base_camp_header .tintbg').fadeIn();
  // });
  var aa = "yes";
  $('.leftpanel .leftmenu_toggle_btn').click(function () {
    if (aa == "yes") {
      $('.content_section .leftpanel').animate({ left: "0px" });
      $('header.base_camp_header .tintbg').fadeIn();
      aa = "no";
    } else {
      $('.content_section .leftpanel').animate({ left: "-330px" });
      $('header.base_camp_header .tintbg').fadeOut();
      aa = "yes";
    }
  });
  /*-- feedback modal --*/
  $('header.base_camp_header .right-align span.user .user-menu ul li:nth-child(5)').click(function () {
    $('header.base_camp_header .feedback-modals').fadeIn();
    $('header.base_camp_header .tintbg').fadeIn();
  })
  $('header.base_camp_header .right-align span.user .user-menu ul li').click(function () {
    $(this).parents('.user-menu').fadeOut();
    $('header.base_camp_header .user-menu-bg').fadeOut("fast");
  })
  /*-- feedback modal cancel button --*/
  $('header.base_camp_header .feedback-modals .feedback-form .controlWrapper a').click(function () {
    $('header.base_camp_header .feedback-modals input#subject, header.base_camp_header .feedback-modals textarea#message').val('');
    $('header.base_camp_header .feedback-modals, header.base_camp_header .tintbg').fadeOut();
  });
  /*-- thanku modal --*/
  $('header.base_camp_header .feedback-modals .feedback-form .controlWrapper button.orangeButton').click(function () {
    if ($('header.base_camp_header .feedback-modals input#subject').val() !== '' && $('header.base_camp_header .feedback-modals textarea#message').val() !== '') {
      $('header.base_camp_header .feedback-modals').fadeOut();
      $('header.base_camp_header .thanku-modals').fadeIn();
      $('header.base_camp_header .thanku-modals p').text('Your feedback has been submitted.');
      $('header.base_camp_header .tintbg').fadeIn();
    };
  });
  $('header.base_camp_header .thanku-modals a').click(function () {
    $('header.base_camp_header .thanku-modals, header.base_camp_header .tintbg').fadeOut();
    $('header.base_camp_header .feedback-modals input#subject, header.base_camp_header .feedback-modals textarea#message,header.base_camp_header .contact-modals-main .feedback-form input#subject, header.base_camp_header .contact-modals-main .feedback-form textarea#message').val('');
  })
  /*-- contact us modal --*/
  $('header.base_camp_header .right-align span.user .user-menu ul li:nth-child(6)').click(function () {
    $('header.base_camp_header .contact-modals').fadeIn();
    $('header.base_camp_header .tintbg').fadeIn();
  })
  $('header.base_camp_header .contact-modals form p span.cancel').click(function () {
    $('header.base_camp_header .contact-modals, header.base_camp_header .tintbg').fadeOut();
  })
  $('header.base_camp_header .contact-modals form a.software-link').click(function () {
    $('header.base_camp_header .contact-modals').fadeOut();
    $('header.base_camp_header .contact-modals-main').fadeIn();
  })
  /*-- contact-modals-main cancel button --*/
  $('header.base_camp_header .contact-modals-main .feedback-form .controlWrapper a').click(function () {
    $('header.base_camp_header .contact-modals-main .feedback-form input#subject, header.base_camp_header .contact-modals-main .feedback-form textarea#message').val('');
    $('header.base_camp_header .contact-modals-main, header.base_camp_header .tintbg').fadeOut();
  });
  /*-- contact-modals-main --*/
  $('header.base_camp_header .contact-modals-main .feedback-form .controlWrapper button.orangeButton').click(function () {
    if ($('header.base_camp_header .contact-modals-main .feedback-form input#subject').val() !== '' && $('header.base_camp_header .contact-modals-main .feedback-form textarea#message').val() !== '') {
      $('header.base_camp_header .contact-modals-main').fadeOut();
      $('header.base_camp_header .thanku-modals').fadeIn();
      $('header.base_camp_header .thanku-modals p').text('Your inquiry has been submitted.');
      $('header.base_camp_header .tintbg').fadeIn();
    };
  });
  /*-- user menu --*/
  $('header.base_camp_header span.user img').click(function () {
    $(this).parent().find('.user-menu').fadeIn();
    $('header.base_camp_header .user-menu-bg').fadeIn();
  });
  $('header.base_camp_header .user-menu-bg').click(function () {
    $(this).fadeOut();
    $('header.base_camp_header .user-menu').fadeOut("fast");
    $('.base_camp_profiles h4 .fa-question-circle').siblings('.info').hide();
  });


});

/*===== slider-carousel ====*/
$(document).ready(function () {
  $('.owl-carousel').owlCarousel({
    loop: true,
    autoplay: false,
    dots: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
        loop: true,
      },
      600: {
        items: 1,
        nav: false,
        loop: true,
      },
      1000: {
        items: 1,
        nav: false,
        loop: true,
        margin: 20
      }
    }
  })


  /*======== window resizer ========*/
  var app = $('body#post-32062');
  /* leftwrapper */
  // var window_height = window.innerHeight;
  // var header_height = $('body#post-30094 .base_camp_header').outerHeight();
  // var hfinal_height = window_height - header_height;
  // $('body#post-30094 .content_section .leftwrapper').css('height',hfinal_height + 'px');


  var appWidth = app.width();
  var currentWidth = window.innerWidth;
  var ratio = currentWidth / appWidth;

  app.css('zoom', ratio);

  $(window).resize(function () {
    currentWidth = window.innerWidth;
    ratio = currentWidth / appWidth;
    app.css('zoom', ratio);
    //console.log(ratio);
    //location.reload();
  });


  /* niceScroll */
  if ($(window).width() < 1800) {
    $(".content_section .leftpanel").niceScroll({ cursorwidth: '8px', autohidemode: false, zindex: 999, cursorcolor: '#f1f1f1' });
  }

  if ($(window).height() < 960) {
    /* leftwrapper */
    var windowHeight = window.outerHeight;
    $('.content_section .leftpanel').css('height', windowHeight + "px");
  }


})



/*======== Ajax - submit form without reloading page  ========*/
function submit() {
  $("#feedback-form, #contact-main-form").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'signup.php',
      data: $('#feedback-form, #contact-main-form').serialize(),
      success: function () {
        console.log("Signup was successful");
      },
      error: function () {
        console.log("Signup was unsuccessful");
      }
    });
  });
}

$(document).ready(function () {
  submit();
  $('span.bell-icon i.fa.fa-bell').click(function () {
    $('span.bell-icon i.fa.fa-bell').next().toggleClass('active')
    $('.action-transparent-bg').show();
    $('.alertsDropdown-backstage').click(function () { $('.notification_list').hide() })
    return false
  })





  // PIN TO TOP CODE
  function dynamic_pin_top() {
    var sortList = {
      "10": "order10",
      "7": "order7",
      "3": "order3",
      "1": "order1"


    }

    //var UnSortList = ["order10", "order7", "order3", "order1"];


    $('li.list').each(function () {
      var $this = $(this).data({ position: $(this).index() }),
        $table = $this.closest('ul'),
        $input = $this.find('li.pin_top input');
      console.log($this);
      $input.off().on('click', function (e) {
        //console.log('dd')
        var $first = $table.find('li.list:first')
        // position; 
        //debugger;
        console.log("this", this, !$(this).prop('checked'))
        //console.log($this.data('position'), $(this).is(':checked'));
        // $(this).prop('checked', !$(this).prop('checked'));
        // console.log($this.data('position'), $(this).is(':checked'));
        // if ($(this).is(':checked')) {
        const parent = $(this).closest('ul').closest('li');
        const parent_siblings = $(this).closest('ul').closest('li').siblings('li');

        var daysElem = $(this).closest('ul').closest('li').find('.timestamp1 .dys .dysVal').val();

        //var daysElemSiblings = $(this).closest('ul').closest('li').siblings('.list').find('.timestamp1 .dys .dysVal').val();


        if (!(parent.hasClass('pintoTop'))) {

          console.log(daysElem)

          $(this).closest('ul').closest('li').addClass('pintoTop').addClass(sortList[daysElem]);
          $(this).siblings('span').html('<img src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/Unpin.svg" class="unpin_black" style="width: 19px; top: 5px; position: relative;"> &nbsp; Unpin');
          //position = $first.data('position');
          $table.find('li.pin_top input').not($(this)).removeAttr('checked');
          // if (position != -1) $first.insertAfter($table.find('li.list').eq(position));

          // if($('.notify-list').find('li.list:first').find('.new_heading').length){
          //     $this.insertAfter($('.notify-list').find('li.list:first'));
          // }else{
          //     $this.prependTo($table);
          // }


        }

        else {




          //debugger;
          $(this).closest('ul').closest('li').removeClass('pintoTop').removeClass(sortList[daysElem]);
          $(this).siblings('span').html('<img src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.svg" style="width: 19px; top: 5px; position: relative;">&nbsp; Pin to Top');
          // $(this).closest('ul').append()
          //position =$(this).parents('.list').index();
          //debugger;
          // $this.insertAfter($table.find('.pintoTop').last())

          //$this.insertAfter($table.find('li.list').eq(position));

        }
      });
    });


  }

  dynamic_pin_top();
});



