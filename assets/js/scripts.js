
jQuery(document).ready(function() {
	
	/*
	    Wow
	*/
	new WOW().init();
	
	/*
	    Slider
	*/
	$('.flexslider').flexslider({
        animation: "slide",
        controlNav: false,
        prevText: "",
        nextText: ""
    });
	
	/*
	    Image popup (home latest work)
	*/
	$('.view-work').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.parent('.work-bottom').siblings('img').attr('alt');
			}
		},
		callbacks: {
			elementParse: function(item) {
				item.src = item.el.attr('href');
			}
		}
	});
	
	/*
	    Flickr feed
	*/
	$('.flickr-feed').jflickrfeed({
        limit: 8,
        qstrings: {
            id: '52617155@N08'
        },
        itemTemplate: '<a href="{{link}}" target="_blank" rel="nofollow"><img src="{{image_s}}" alt="{{title}}" /></a>'
    });


	function mapaUbicacion() {
		var latlng = new google.maps.LatLng(22.157519,-100.985641);
		var settings = {
			zoom: 6,
			center: latlng,
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("mapaUbicacion"), settings);
		var companyLogo = new google.maps.MarkerImage("images/globo.png");

		var companyPos = new google.maps.LatLng(20.667842,-103.395214);
		var companyPos2 = new google.maps.LatLng(25.673682,-100.332824);
		var companyPos3 = new google.maps.LatLng(19.369515,-99.180686);


		var companyMarker = new google.maps.Marker({
			position: companyPos,
			map: map,
			icon: companyLogo,
			title:"Human Services 21 Guadalajara"
		});

		var contentString = '<div id="content">'+
				'<h3 style="color:#FC0016; font-size:14px;">Human Services 21</h3>'+
				'<p style="color:#000; font-size:12px;">Av. San Francisco # 3229<br />Col. Chapalita.<br />Guadalajara, Jalisco, México.<br/>Servicios con sentido humano</p></div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		google.maps.event.addListener(companyMarker, 'mouseover', function() {
			infowindow.open(map,companyMarker);
		});

		var companyMarker2 = new google.maps.Marker({
			position: companyPos2,
			map: map,
			icon: companyLogo,
			title:"Human Services 21 Monterrey"
		});

		var contentString2 = '<div id="content">'+
				'<h3 style="color:#FC0016; font-size:14px;">Human Services 21</h3>'+
				'<p style="color:#000; font-size:12px;">15 de Mayo 1416-B<br />Col. Centro, Monterrey, México.<br/>Tels: 8183422696 y 8183433681<br/>Servicios con sentido humano</p></div>';
		var infowindow2 = new google.maps.InfoWindow({
			content: contentString2
		});

		google.maps.event.addListener(companyMarker2, 'mouseover', function() {
			infowindow2.open(map,companyMarker2);
		});


		var companyMarker3 = new google.maps.Marker({
			position: companyPos3,
			map: map,
			icon: companyLogo,
			title:"Human Services 21 México"
		});

		var contentString3 = '<div id="content">'+
				'<h3 style="color:#FC0016; font-size:14px;">Human Services 21</h3>'+
				'<p style="color:#000; font-size:12px;">Av. Insurgentes Sur # 1337 Dep 5<br />Col. Insurgentes Mixcuac.<br />Delegación Benito Juarez, Estado de México.<br/>Tels: 55638110 y 55638136<br/>Servicios con sentido humano</p></div>';
		var infowindow3 = new google.maps.InfoWindow({
			content: contentString3
		});

		google.maps.event.addListener(companyMarker3, 'mouseover', function() {
			infowindow3.open(map,companyMarker3);
		});
	}
    
    /*
	    Subscription form
	*/
	$('.success-message').hide();
	$('.error-message').hide();
	
	$('.footer-box-text-subscribe form').submit(function(e) {
		e.preventDefault();
		
		var form = $(this);
	    var postdata = form.serialize();
	    
	    $.ajax({
	        type: 'POST',
	        url: 'assets/subscribe.php',
	        data: postdata,
	        dataType: 'json',
	        success: function(json) {
	            if(json.valid == 0) {
	                $('.success-message').hide();
	                $('.error-message').hide();
	                $('.error-message').html(json.message);
	                $('.error-message').fadeIn();
	            }
	            else {
	                $('.error-message').hide();
	                $('.success-message').hide();
	                form.hide();
	                $('.success-message').html(json.message);
	                $('.success-message').fadeIn();
	            }
	        }
	    });
	});
    
    /*
	    Contact form
	*/
    $('.contact-form form').submit(function(e) {
    	e.preventDefault();

    	var form = $(this);
    	var nameLabel = form.find('label[for="contact-name"]');
    	var emailLabel = form.find('label[for="contact-email"]');
    	var messageLabel = form.find('label[for="contact-message"]');
    	
    	nameLabel.html('Name');
    	emailLabel.html('Email');
    	messageLabel.html('Message');
        
        var postdata = form.serialize();
        
        $.ajax({
            type: 'POST',
            url: 'assets/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.nameMessage != '') {
                	nameLabel.append(' - <span class="colored-text error-label"> ' + json.nameMessage + '</span>');
                }
                if(json.emailMessage != '') {
                	emailLabel.append(' - <span class="colored-text error-label"> ' + json.emailMessage + '</span>');
                }
                if(json.messageMessage != '') {
                	messageLabel.append(' - <span class="colored-text error-label"> ' + json.messageMessage + '</span>');
                }
                if(json.nameMessage == '' && json.emailMessage == '' && json.messageMessage == '') {
                	form.fadeOut('fast', function() {
                		form.parent('.contact-form').append('<p><span class="colored-text">Thanks for contacting us!</span> We will get back to you very soon.</p>');
                    });
                }
            }
        });
    });
	
});


jQuery(window).load(function() {
	
	/*
	    Portfolio
	*/
	$('.portfolio-masonry').masonry({
		columnWidth: '.portfolio-box', 
		itemSelector: '.portfolio-box',
		transitionDuration: '0.5s'
	});
	
	$('.portfolio-filters a').on('click', function(e){
		e.preventDefault();
		if(!$(this).hasClass('active')) {
	    	$('.portfolio-filters a').removeClass('active');
	    	var clicked_filter = $(this).attr('class').replace('filter-', '');
	    	$(this).addClass('active');
	    	if(clicked_filter != 'all') {
	    		$('.portfolio-box:not(.' + clicked_filter + ')').css('display', 'none');
	    		$('.portfolio-box:not(.' + clicked_filter + ')').removeClass('portfolio-box');
	    		$('.' + clicked_filter).addClass('portfolio-box');
	    		$('.' + clicked_filter).css('display', 'block');
	    		$('.portfolio-masonry').masonry();
	    	}
	    	else {
	    		$('.portfolio-masonry > div').addClass('portfolio-box');
	    		$('.portfolio-masonry > div').css('display', 'block');
	    		$('.portfolio-masonry').masonry();
	    	}
		}
	});
	
	$(window).on('resize', function(){ $('.portfolio-masonry').masonry(); });
	
	// image popup	
	$('.portfolio-box h3').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.text();
			}
		},
		callbacks: {
			elementParse: function(item) {
				var box_container = item.el.parents('.portfolio-box-container');
				if(box_container.hasClass('portfolio-video')) {
					item.type = 'iframe';
					item.src = box_container.data('portfolio-big');
				}
				else {
					item.type = 'image';
					item.src = box_container.find('img').attr('src');
				}
			}
		}
	});
	
	/*
		Testimonial images
	*/
	$(".testimonial-image img").attr("style", "width: auto !important; height: auto !important;");
	
});
