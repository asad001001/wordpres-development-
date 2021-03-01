jQuery(document).ready(
  function($) {

    var $w = $(window);
    var $y = $('.move_it');
    var _x = 0;
    var _y = -8;

    $(window).scroll(function(event) {
      var st = $w.scrollTop();

      _x = st;
      _y = -8;
	
      $y.css('left', (st * (150/100)) + 0);
      
		$y.css('bottom', _y);

    });

  });
