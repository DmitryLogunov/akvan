// slider brands
		$(document).ready(function() {
			$('.slideshow-brand').bxSlider({
				minSlides: 13,
				maxSlides: 13,
				slideWidth: 86,
				pager: false
			});
		});

// slider main page
		$(document).ready(function() {
			$('.slideshow-main').bxSlider({
				mode: 'fade',
				controls: false,
				auto: true
			});
		});

// slider photo
		$(document).ready(function() {
			$('.slideshow-photo').bxSlider({
				minSlides: 3,
				maxSlides: 3,
				slideWidth: 108,
				slideMargin: 21,
				pager: false
			});
		});

//Sidebar left menu
		$(document).on('click', '.menu-accordion li > a', function(event) {
			var $this = $(this),
				$next = $this.next();
			if ($next.length) {
				if ($next.is(':visible')) {
					$next.slideToggle(function() {
						$next.find('ul').toggle(false);
					});
				} else {
					$next.slideToggle().parent().siblings().find('ul').filter(':visible').slideToggle();
				}
				event.preventDefault();
			}
		});

//	Goods counter
		$(document).ready(function() {
    $('.goods').on('click', function(evt) {
        var elem = evt.target;
        var container = evt.currentTarget;
        var input = container.getElementsByClassName('counter')[0];
        var count = parseInt(input.getAttribute('data-count'), 10);
        
    	if (elem.classList.contains('down')) {
        	count = count == 1 ? count : (count - 1);
        } else if (elem.classList.contains('up')){
        	count += 1;
        }
        input.value = count;
        input.setAttribute('data-count', count);
    });
		});


//	Lightbox товара 
		$(document).ready(function() {
			$( ".lightbox-photo" ).click(function() {
					$('#zoomPhoto').arcticmodal({
				afterOpen: function(){
					$('.slideshow-photo-big').bxSlider({
					pager: false
				});
				}
			});
			});
			$( ".slideshow-photo-wrapper img" ).click(function() {
				$('.slideshow-photo-wrapper li div').removeClass('active');
				$(this).parent().addClass('active');
				$('.photos .big  img').attr('src',$(this).attr('src'))
			});
		});

// View target
		$(document).ready(function() {
			$('.list .wrap-img img').hover(function() {
				$($(this).next()).show();
				$('.list .wrap-img .img-big img').attr('src',$(this).attr('src'));
				$('.list .wrap-img .img-big img').attr('alt',$(this).attr('alt'));
			},
			function() {
    	$('.list .wrap-img .img-big').hide();
		});
		});

//	Lightbox товара 
		$(document).ready(function() {
			$( ".question a" ).click(function() {
					$('#popup').arcticmodal();
			});
		});
