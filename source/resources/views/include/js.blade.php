<!-- Custom javascript -->
<script src="{{asset('/node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- <script src="{{asset('/node_modules/jquery-ui-dist/jquery-ui.js')}}"></script> -->
<!-- <script src="{{asset('/node_modules/moment/moment.js')}}"></script> -->
<script src="{{asset('js/app.js')}}"></script>

<script>
  (function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-100829780-2', 'auto');
  ga('send', 'pageview');
</script>

<script>

$(window).on('load', function () {
    setTimeout(function () {
      $(".page_loader").fadeOut("fast");
    }, 300)
  });

  //漢堡選單

  // $('#hamburgermenu').click(function (e) {
  //         e.preventDefault();
  //         $('.menu').toggleClass('open');
  // });
  $('.hamburger').click(function (e) {
    e.preventDefault();
    $('#menu').toggleClass('open');
    $('#menu').show();

    //手機板時按下,後面黑字變淡
    // $('.index_h2').toggleClass('menu_active');
  });
</script>

<script>
  // import  '../node_modules/bootstrap/dist/js/bootstrap.js';

  $(document).ready(function () {

    //top-menu 漢堡選單展開
    $('.burgermenu-icon').click(function (e) {
      e.preventDefault();
      $('body').toggleClass('menu-show');
    });

    $('.more-button').click(function (e) {
      e.preventDefault();
      $('.more-menu').slideToggle();
    });

    //menu active
    $('.menu li a').click(function (e) {
      // e.preventDefault();
      $(this).toggleClass('active').parent().siblings().find('a').removeClass('active');
    });




    // img可直接使用svg
    $(function () {
      jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
          // Get the SVG tag, ignore the rest
          var $svg = jQuery(data).find('svg');

          // Add replaced image's ID to the new SVG
          if (typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
          }
          // Add replaced image's classes to the new SVG
          if (typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass + ' replaced-svg');
          }

          // Remove any invalid XML tags as per http://validator.w3.org
          $svg = $svg.removeAttr('xmlns:a');

          // Check if the viewport is set, else we gonna set it if we can.
          if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
          }

          // Replace image with new SVG
          $img.replaceWith($svg);

        }, 'xml');

      });
    });

    //編輯功能



    $('.edit').click(function () {
      $(this).hide();
      // $('.box').addClass('editable');
      $('.text').attr('contenteditable', 'true');
      $('.save').show();
    });
    $('.save').hide();
    $('.save').click(function () {
      $(this).hide();
      // $('.box').removeClass('editable');
      $('.text').removeAttr('contenteditable');
      $('.edit').show();
    });



    //切換語言

    window.onload = switchLang;

    var lang = sessionStorage.getItem('lang');

    function switchLang() {
 
      if (lang == 'cn') {

        $('.english').hide();
        $('.chinese').show();

      } else {
        $('.chinese').hide();
        $('.english').show();

      }

    };

    $('#english').click(function (e) {
      e.preventDefault();
      sessionStorage.setItem('lang', 'en');
      $('.chinese').hide();
      $('.english').show();
    });

    $('#chinese').click(function (e) {
      e.preventDefault();
      sessionStorage.setItem('lang', 'cn');
      $('.english').hide();
      $('.chinese').show();
    });

    $('#english_r').click(function (e) {
      e.preventDefault();
      sessionStorage.setItem('lang', 'en');
      $('.chinese').hide();
      $('.english').show();
    });

    $('#chinese_r').click(function (e) {
      e.preventDefault();
      sessionStorage.setItem('lang', 'cn');
      $('.english').hide();
      $('.chinese').show();
    });



  });
</script>