(function($) {
	"use strict";
	
	var preloader = $('#preloader');
	$(window).on('load', function() {
		preloader.fadeOut('slow', function() {
			$(this).remove();
		});
	});
	
	$('.nav-btn').on('click', function() {
		$('.page-container').toggleClass('sbar_collapsed');
	});
	
	var e = function() {
		var e = (window.innerHeight > 0 ? window.innerHeight
				: this.screen.height) - 5;
		(e -= 47) < 1 && (e = 1), e > 47
				&& $(".main-content").css("min-height", e + "px")
	};
	$(window).ready(e), $(window).on("resize", e);
	
	$('#menu').metisMenu();
	
	$('.menu-inner').slimScroll({
		height : $(window).height() - 198,
		maxHeight : '460px !important'
	});
	$('.menu-inner').css("height", $(window).height() - 198);
	$(window).resize(function() {
		$('.menu-inner').css("height", $(window).height() - 198);
	});
	$('.slimScrollDiv').css("height", $(window).height() - 198);
	$(window).resize(function() {
		$('.slimScrollDiv').css("height", $(window).height() - 198);
	});
	$('.slimScrollBar').css({
		'right' : 'unset !important',
		'left' : 0,
	});

	$('.scroolbox').slimScroll({
		height : 'auto'
	});
	$('.chosen-drop').slimScroll({
		height : 'auto'
	});
	$('.nofity-list').slimScroll({
		height : '200px'
	});
	$('.timeline-area').slimScroll({
		height : '500px'
	});
	$('.recent-activity').slimScroll({
		height : 'calc(100vh - 114px)'
	});
	$('.settings-list').slimScroll({
		height : 'calc(100vh - 158px)'
	});
	
	$(window).on('scroll', function() {
		var scroll = $(window).scrollTop(), mainHeader = $('#sticky-header'), mainHeaderHeight = mainHeader.innerHeight();

		if (scroll > 1) {
			$("#sticky-header").addClass("sticky-menu");
		} else {
			$("#sticky-header").removeClass("sticky-menu");
		}
	});

	$('[data-toggle="popover"]').popover();
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation
		// styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
	
	if ($('#dataTable').length) {
		$('#dataTable').DataTable({
			responsive : true
		});
	}
	if ($('#dataTable2').length) {
		$('#dataTable2').DataTable({
			responsive : true
		});
	}
	if ($('#dataTable3').length) {
		$('#dataTable3').DataTable({
			responsive : true
		});
	}
	
	$('ul#nav_menu').slicknav({
		prependTo : "#mobile_menu"
	});
	
	$('.form-gp input').on('focus', function() {
		$(this).parent('.form-gp').addClass('focused');
	});
	$('.form-gp input').on('focusout', function() {
		if ($(this).val().length === 0) {
			$(this).parent('.form-gp').removeClass('focused');
		}
	});
	
	$('.settings-btn, .offset-close').on('click', function() {
		$('.offset-area').toggleClass('show_hide');
		$('.settings-btn').toggleClass('active');
	});
	
	function slider_area() {
		var owl = $('.testimonial-carousel').owlCarousel({
			margin : 50,
			loop : true,
			autoplay : false,
			nav : false,
			dots : true,
			responsive : {
				0 : {
					items : 1
				},
				450 : {
					items : 1
				},
				768 : {
					items : 2
				},
				1000 : {
					items : 2
				},
				1360 : {
					items : 1
				},
				1600 : {
					items : 2
				}
			}
		});
	}
	slider_area();
	
	if ($('#full-view').length) {

		var requestFullscreen = function(ele) {
			if (ele.requestFullscreen) {
				ele.requestFullscreen();
			} else if (ele.webkitRequestFullscreen) {
				ele.webkitRequestFullscreen();
			} else if (ele.mozRequestFullScreen) {
				ele.mozRequestFullScreen();
			} else if (ele.msRequestFullscreen) {
				ele.msRequestFullscreen();
			} else {
				console.log('Fullscreen API is not supported.');
			}
		};

		var exitFullscreen = function() {
			if (document.exitFullscreen) {
				document.exitFullscreen();
			} else if (document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			} else {
				console.log('Fullscreen API is not supported.');
			}
		};

		var fsDocButton = document.getElementById('full-view');
		var fsExitDocButton = document.getElementById('full-view-exit');

		fsDocButton.addEventListener('click', function(e) {
			e.preventDefault();
			requestFullscreen(document.documentElement);
			$('body').addClass('expanded');
		});

		fsExitDocButton.addEventListener('click', function(e) {
			e.preventDefault();
			exitFullscreen();
			$('body').removeClass('expanded');
		});
	}

	if ($(".chosen-select").length || $(".chosen-select-deselect").length) {
		var config = {
			'.chosen-select' : {},
			'.chosen-select-deselect' : {
				allow_single_deselect : true
			},
			'.chosen-select-no-single' : {
				disable_search_threshold : 10
			},
			'.chosen-select-no-results' : {
				no_results_text : 'Oops, nothing found!'
			},
			'.chosen-select-rtl' : {
				rtl : true
			},
			'.chosen-select-width' : {
				width : '95%'
			}
		}
		for ( var selector in config) {
			$(selector).chosen(config[selector]);
		}
	}

	if ($(".select2").length) {
		$(".select2").select2({
			theme : "bootstrap"
		});
	}

	if ($('#copyright').length) {
		var today = new Date();
		$('#copyright').text(today.getFullYear());
	}

	function handleBaseURL() {
		var getUrl = window.location, baseUrl = getUrl.protocol + "//"
				+ getUrl.host + "/" + getUrl.pathname.split('/')[1];
		return baseUrl;
	}

	if ($('.page-sound').length) {ion.sound({
			sounds : [ {
				name : "beer_can_opening"
			}, {
				name : "bell_ring",
				volume : 0.6
			}, {
				name : "branch_break",
				volume : 0.3
			}, {
				name : "button_click"
			}, {
				name : "button_click_on"
			}, {
				name : "button_push"
			}, {
				name : "button_tiny",
				volume : 0.6
			}, {
				name : "camera_flashing"
			}, {
				name : "camera_flashing_2",
				volume : 0.6
			}, {
				name : "cd_tray",
				volume : 0.6
			}, {
				name : "computer_error"
			}, {
				name : "door_bell"
			}, {
				name : "door_bump",
				volume : 0.3
			}, {
				name : "glass"
			}, {
				name : "keyboard_desk"
			}, {
				name : "light_bulb_breaking",
				volume : 0.6
			}, {
				name : "metal_plate"
			}, {
				name : "metal_plate_2"
			}, {
				name : "pop_cork"
			}, {
				name : "snap"
			}, {
				name : "staple_gun"
			}, {
				name : "tap",
				volume : 0.6
			}, {
				name : "water_droplet"
			}, {
				name : "water_droplet_2"
			}, {
				name : "water_droplet_3",
				volume : 0.6
			} ],
			path : handleBaseURL() + '/page/assets/templates/default/vendor/node_modules/ion-sound/sounds/',
			preload : true
		});

		$('.dropdown-toggle').on('click', function() {
			ion.sound.play("water_droplet_3");
		});
	}

	if ($('.page-sound').length) {
		$('input, textarea').on('input', function() {
			ion.sound.play("tap");
		});
		$('input[type=file]').on('click', function() {
			ion.sound.play("metal_plate_2");
		});
		$('input[type=checkbox], input[type=radio]').on('click', function() {
			ion.sound.play("button_tiny");
		});
		$('select').on('change', function() {
			ion.sound.play("snap");
		});
	}

	$('#logout').on('click', function() {
		ion.sound.play('camera_flashing');
		bootbox.dialog({
			message : 'Do you want to exit from Blankon?',
			title : 'Logout',
			className : 'modal-danger modal-center',
			buttons : {
				danger : {
					label : 'No',
					className : 'btn-danger'
				},
				success : {
					label : 'Yes',
					className : 'btn-success',
					callback : function() {
						window.location = $('#logout').data('url');
					}
				}
			}
		});
	});
	
	$('#back-top').hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#back-top').addClass('show animated pulse');
        } else {
            $('#back-top').removeClass('show animated pulse');
        }
    });
    $('#back-top').click(function () {
        ion.sound.play("cd_tray");
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
})(jQuery);