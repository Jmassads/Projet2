/* global swpPinIt */

/*!
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

var socialWarfarePlugin = socialWarfarePlugin || {};

(function( window, undefined ) {
	// Internal method reference.
	var jqThrottle;

	var swp = window.socialWarfarePlugin;

	swp.throttle = jqThrottle = function( delay, noTrailing, callback, debounceMode ) {
		// After wrapper has stopped being called, this timeout ensures that
		// `callback` is executed at the proper times in `throttle` and `end`
		// debounce modes.
		var timeoutID,

		// Keep track of the last time `callback` was executed.
		lastExec = 0;

		// `noTrailing` defaults to falsy.
		if ( typeof noTrailing !== 'boolean' ) {
			debounceMode = callback;
			callback = noTrailing;
			noTrailing = undefined;
		}

		// The `wrapper` function encapsulates all of the throttling / debouncing
		// functionality and when executed will limit the rate at which `callback`
		// is executed.
		function wrapper() {
			var that = this,
			elapsed = +new Date() - lastExec,
			args = arguments;

			// Execute `callback` and update the `lastExec` timestamp.
			function exec() {
				lastExec = +new Date();
				callback.apply( that, args );
			}

			// If `debounceMode` is true (atBegin) this is used to clear the flag
			// to allow future `callback` executions.
			function clear() {
				timeoutID = undefined;
			}

			if ( debounceMode && ! timeoutID ) {
				// Since `wrapper` is being called for the first time and
				// `debounceMode` is true (atBegin), execute `callback`.
				exec();
			}

			// Clear any existing timeout.
			timeoutID && clearTimeout( timeoutID );

			if ( debounceMode === undefined && elapsed > delay ) {
				// In throttle mode, if `delay` time has been exceeded, execute
				// `callback`.
				exec();
			} else if ( noTrailing !== true ) {
				// In trailing throttle mode, since `delay` time has not been
				// exceeded, schedule `callback` to execute `delay` ms after most
				// recent execution.
				//
				// If `debounceMode` is true (atBegin), schedule `clear` to execute
				// after `delay` ms.
				//
				// If `debounceMode` is false (at end), schedule `callback` to
				// execute after `delay` ms.
				timeoutID = setTimeout( debounceMode ? clear : exec, debounceMode === undefined ? delay - elapsed : delay );
			}
		}

		// Set the guid of `wrapper` function to the same of original callback, so
		// it can be removed in jQuery 1.4+ .unbind or .die by using the original
		// callback as a reference.
		if ( swp.guid ) {
			wrapper.guid = callback.guid = callback.guid || swp.guid++;
		}

		// Return the wrapper function.
		return wrapper;
	};

	swp.debounce = function( delay, atBegin, callback ) {
		return callback === undefined ? jqThrottle( delay, atBegin, false ) : jqThrottle( delay, callback, atBegin !== false );
	};
})( this );

(function( window, $, undefined ) {
	'use strict';

	var swp = window.socialWarfarePlugin;

	function absint( $int ) {
		return parseInt( $int, 10 );
	}

	function swp_trigger_events(event) {
		var evt = $.Event(event);
		$(window).trigger(evt);
	}

	/****************************************************************************

		Fetch and Store Facebook Counts

	****************************************************************************/
	var swpPostData = {};
	socialWarfarePlugin.fetchShares = function() {
		/**
		 * Run all the API calls
		 */
		$.when(
			$.get('https://graph.facebook.com/?fields=og_object{likes.summary(true).limit(0)},share&id=' + swp_post_url) ,
			( swp_post_recovery_url ? $.get('https://graph.facebook.com/?fields=og_object{likes.summary(true).limit(0)},share&id=' + swp_post_recovery_url) : '')
		)
		.then( function( a, b ) {
			/**
			 * Parse the responses, add up the activity, send the results to admin_ajax
			 */
			if( 'undefined' !== typeof a[0].share ) {
				var f1 = absint( a[0].share.share_count);
				var f2 = absint( a[0].share.comment_count );
				if( 'undefined' !== typeof a[0].og_object ){
					var f3 = absint( a[0].og_object.likes.summary.total_count );
				} else {
					var f3 = 0;
				}
				var fShares = f1 + f2 + f3;
				if(swp_post_recovery_url) {
					if (typeof b[0].share !== 'undefined') {
						var f4 = absint( b[0].share.share_count);
						var f5 = absint( b[0].share.comment_count);
					} else {
						var f4 = 0, f5 = 0;
					}
					if (typeof b[0].og_object !== 'undefined') {
						var f6 = absint( b[0].og_object.likes.summary.total_count );
					} else {
						var f6 = 0
					}
					var fShares2 = f4 + f5 + f6;
					if (fShares !== fShares2) {
						fShares = fShares + fShares2;
					}
				}
				swpPostData = {
					action: 'swp_facebook_shares_update',
					post_id: swp_post_id,
					activity: fShares
				};
			}
		});
	}

	/**
	 * Activate Hover States: Trigger the resizes to the proper widths for the expansion on hover effect
	 * @since 2.1.0
	 * @param none
	 * @return none
	 */
	swp.activateHoverStates = function() {
		swp_trigger_events('pre_activate_buttons');
		$('.swp_social_panel:not(.swp_social_panelSide) .nc_tweetContainer').on('mouseenter',function(){
			if($(this).hasClass('swp_nohover')){

			} else {
				swpRestoreSizes();
				var term_width = $(this).find('.swp_share').outerWidth();
				var icon_width = $(this).find('i.sw').outerWidth();
				var container_width = $(this).width();
				var percentage_change = 1 + ((term_width + 35) / container_width);
				$(this).find('.iconFiller').width(term_width + icon_width + 25 + 'px');
				$(this).css({flex:percentage_change + ' 1 0%'});
			}
		});
		$('.swp_social_panel:not(.swp_social_panelSide)').on('mouseleave',function() {
			swpRestoreSizes();
		});
	}
	function swpRestoreSizes() {
		$('.swp_social_panel:not(.swp_social_panelSide) .nc_tweetContainer:not(.swp_nohover) .iconFiller').removeAttr('style');
		$('.swp_social_panel:not(.swp_social_panelSide) .nc_tweetContainer:not(.swp_nohover)').removeAttr('style');
	}

	function createFloatBar() {
        // if ( ! $( '.swp_social_panelSide' ).length ) {
			if( $( '.nc_wrapper' ).length ) {
				$( '.nc_wrapper' ).remove();
			}
			var firstSocialPanel = $( '.swp_social_panel' ).not( '[data-float="ignore"]' ).first();
			var location = firstSocialPanel.data( 'float' );
			var alignment = firstSocialPanel.data( 'align' );

			if ( location ) {

				if ( $( '.swp_social_panel' ).not( '.swp_social_panelSide' ).length ) {
        			var floatMobile = $( '.swp_social_panelSide' ).data( 'float-mobile' );
        			var offsetOne = firstSocialPanel.offset();
        			var ncSideFloater = $( '.swp_social_panelSide' ).filter( ':not(.mobile)' );
        			var minWidth = ncSideFloater.data( 'screen-width' );

					if ( offsetOne.left < 100 || $( window ).width() < minWidth ) {
						var position = floatMobile;
					} else {
						var position = location;
					}

				} else {
					var position = location;

				}

				var backgroundColor = $( '.swp_social_panel' ).data( 'floatcolor' );

				var el = $( '<div class="nc_wrapper" style="background-color:' + backgroundColor + '"></div>' );
        el.appendTo( 'body' );

        if ( location === 'left' || location === 'right' ) {
            var position = firstSocialPanel.data( 'float-mobile' );
        } else {
            var position = firstSocialPanel.data( 'float' );
        }

				firstSocialPanel.clone().appendTo( el );

				$( '.nc_wrapper' ).hide().addClass( position );

				var width = firstSocialPanel.outerWidth( true );
				var offset = firstSocialPanel.offset();

				$( '.swp_social_panel' ).last().addClass( 'nc_floater' ).css({
					width: width,
					left: ( alignment == 'center' ? 0 : offset.left )
				});

				$( '.swp_social_panel .swp_count' ).css({ transition: 'padding .1s linear' });
				$( '.swp_social_panel' ).eq( 0 ).addClass( 'swp_one' );
				$( '.swp_social_panel' ).eq( 2 ).addClass( 'swp_two' );
				$( '.swp_social_panel' ).eq( 1 ).addClass( 'swp_three' );
            }
		// }
	}

	function floatingBarReveal() {
		// Adjust the floating bar
		var panels = $( '.swp_social_panel' );
		var location = panels.not( '[data-float="float_ignore"]' ).eq( 0 ).data( 'float' );
		var windowElement = $( window );
		var windowHeight = windowElement.height();
		var ncWrapper = $( '.nc_wrapper' );
		var ncSideFloater = $( '.swp_social_panelSide' ).filter( ':not(.mobile)' );
		var position = $( '.swp_social_panel' ).data( 'position' );
		var minWidth = ncSideFloater.data( 'screen-width' );
		var offsetOne = panels.eq( 0 ).offset();
		var scrollPos = windowElement.scrollTop();
		var st = $( window ).scrollTop();
		var visible = false;

		if ( typeof window.swpOffsets == 'undefined' ) {
			window.swpOffsets = {};
		}

		if ( location === 'right' || location === 'left' ) {
			var floatMobile = $( '.swp_social_panel' ).data( 'float-mobile' );
			var direction = (location.indexOf("left") !== -1) ? "left" : "right";

			if ( $( '.swp_social_panel' ).not( '.swp_social_panelSide' ).length ) {
				$( '.swp_social_panel' ).not( '.swp_social_panelSide, .nc_floater' ).each(function() {
					var thisOffset = $( this ).offset();
					var thisHeight = $( this ).height();
					if ( thisOffset.top + thisHeight > scrollPos && thisOffset.top < scrollPos + windowHeight ) {
						visible = true;
					}
				});

				if ( offsetOne.left < 100 || $( window ).width() < minWidth ) {
					visible = true;
					if ( floatMobile == 'bottom' ) {
						location = 'bottom';
					} else if ( floatMobile == 'top' ) {
						location = 'top';
					}
				} else if (visible) {
					visible == true;
				} else {
					visible = false;
				}
			} else {
				if ( $( window ).width() > minWidth ) {

					visible = false;
				} else {
					visible = true;
					if(floatMobile == 'bottom') {
						location = 'bottom';
					} else if ( floatMobile == 'top' ) {
						location = 'top';
					}
				}
			}

			var transition = ncSideFloater.data('transition');

			if ( transition == 'slide' ) {
				if ( visible == true ) {
					ncSideFloater.css(direction, "-150px");
				} else {
					ncSideFloater.css(direction, "5px");
				}

			} else if ( transition == 'fade' ) {
				if ( visible == true ) {
					ncSideFloater.fadeOut( 200 );
				} else {
					ncSideFloater.fadeIn( 200 ).css("display", "flex");
				}
			}
		}

		if ( location == 'bottom' || location == 'top' ) {
			visible = false;

			$( '.swp_social_panel' ).not( '.swp_social_panelSide, .nc_floater' ).each(function() {
					var thisOffset = $( this ).offset();
					var thisHeight = $( this ).height();
					if ( thisOffset.top + thisHeight > scrollPos && thisOffset.top < scrollPos + windowHeight ) {
						visible = true;
					}
			});

			if ( visible ) {
				// Hide the Floating bar
				ncWrapper.hide();

				// Add some padding to the page so it fits nicely at the top or bottom
				if ( location == 'bottom' ) {
					$( 'body' ).animate({ 'padding-bottom': window.bodyPaddingBottom + 'px' }, 0 );
				} else if ( location == 'top' ) {
					$( 'body' ).animate({ 'padding-top': window.bodyPaddingTop + 'px' }, 0 );
				}
			} else {
				var newPadding, firstOffset;
				// Show the floating bar
				ncWrapper.show();


				// Add some padding to the page so it fits nicely at the top or bottom
				if ( location == 'bottom' ) {
					newPadding = window.bodyPaddingBottom + 50;
					$( 'body' ).animate({ 'padding-bottom': newPadding + 'px' }, 0 );
				} else if ( location == 'top' ) {
					firstOffset = $( '.swp_social_panel' ).not( '.swp_social_panelSide, .nc_wrapper .swp_social_panel' ).first().offset();
					if ( firstOffset.top > scrollPos + windowHeight ) {
						newPadding = window.bodyPaddingTop + 50;
						$( 'body' ).animate({ 'padding-top': newPadding + 'px' }, 0 );
					}
				}
			}
		}
	}

  function centerSidePanel() {
      var sidePanel = jQuery("[class*=float-position-center]");

      if (!sidePanel.length) return;

      var panelHeight = sidePanel.outerHeight();
      var windowHeight = window.innerHeight;

      if (panelHeight > windowHeight) {
          sidePanel.css("top", 0);
          return;
      }

      var offset = (windowHeight - panelHeight) / 2;

      sidePanel.css("top", offset);
  }

	function initShareButtons() {
		if ( 0 !== $( '.swp_social_panel' ).length ) {
			createFloatBar();
      centerSidePanel();
			swp.activateHoverStates();
			handleWindowOpens();
			$( window ).scrollTop();
			$( window ).scroll( swp.throttle( 50, function() {
				floatingBarReveal();
			}));
			$( window ).trigger( 'scroll' );
			// $( '.swp_social_panel' ).css( {'opacity':1} );
		}
	}

	/****************************************************************************

		Pin It Hover Effect

	****************************************************************************/

	function pinitButton() {
		var defaults = {
			wrap: '<div class="sw-pinit" />',
			pageURL: document.URL
		};

		var options = $.extend( defaults, options );

		// Iterate over the current set of matched elements.
		$( '.swp-content-locator' ).parent().find( 'img' ).each( function() {
			var $image = $( this );

			if ( $image.outerHeight() < swpPinIt.minHeight || $image.outerWidth() < swpPinIt.minWidth ) {
				return;
			}

			var pinMedia = false;

			if ( 'undefined' !== typeof swpPinIt.image_source ) {
				pinMedia = swpPinIt.image_source;
			} else if ( $image.data( 'media' ) ) {
				pinMedia = $image.data( 'media' );
			} else if ( $(this).data('lazy-src') ) {
			    pinMedia = $(this).data('lazy-src');
			} else if ( $image[0].src ) {
				pinMedia = $image[0].src;
			}

			// Bail if we don't have any media to pin.
			if ( false === pinMedia ) {
				return;
			}

			if ( $image.hasClass('no_pin')) {
				return;
			}

			var pinDesc = '';

			if ( 'undefined' !== typeof swpPinIt.image_description){
				pinDesc = swpPinIt.image_description;
			} else if ( $image.attr( 'title' ) ) {
				pinDesc = $image.attr( 'title' );
			} else if ( $image.attr( 'alt' ) ) {
				pinDesc = $image.attr( 'alt' );
			}

			var bookmark = 'http://pinterest.com/pin/create/bookmarklet/?media=' + encodeURI( pinMedia ) + '&url=' + encodeURI( options.pageURL ) + '&is_video=false' + '&description=' +  encodeURIComponent( pinDesc );
			var imageClasses = $image.attr( 'class' );
			var imageStyle = $image.attr( 'style' );

			$image.removeClass().attr( 'style', '' ).wrap( options.wrap );

			$image.after( '<a href="' + bookmark + '" class="sw-pinit-button sw-pinit-' + swpPinIt.vLocation + ' sw-pinit-' + swpPinIt.hLocation + '">Save</a>' );

			$image.parent( '.sw-pinit' ).addClass( imageClasses ).attr( 'style', imageStyle );

			$( '.sw-pinit .sw-pinit-button' ).on( 'click', function() {
				window.open( $( this ).attr( 'href' ), 'Pinterest', 'width=632,height=253,status=0,toolbar=0,menubar=0,location=1,scrollbars=1' );
				// Record the event if Google Analytics Click tracking is enabled
				if (typeof ga == "function" && true === swpClickTracking) {
					var network = 'pin_image';
					ga("send", "event", "social_media", "swp_" + network + "_share" );
				}
				return false;
			});
		});
	}

	function handleWindowOpens() {
		$( '.nc_tweet, a.swp_CTT' ).off( 'click' );
		$( '.nc_tweet, a.swp_CTT' ).on( 'click', function( event ) {
			if ( $( this ).hasClass( 'noPop' ) ) {
				return false;
			}

			if( $( this ).data( 'link' ) ) {
				event.preventDefault ? event.preventDefault() : ( event.returnValue = false );

				var href = $( this ).data( 'link' );
				var height, width, top, left, instance, windowFeatures;

				href = href.replace( '’', '\'' );

				if ( $( this ).hasClass( 'pinterest' ) || $( this ).hasClass( 'buffer_link' ) || $( this ).hasClass( 'flipboard' ) ) {
					height = 550;
					width = 775;
				} else {
					height = 270;
					width = 500;
				}


                top = window.screenY + (window.innerHeight - height) / 2;
                left = window.screenX + (window.innerWidth - width) / 2;

                windowFeatures = 'height=' + height + ',width=' + width + ',top=' + top + ',left=' + left;
				instance = window.open( href, '_blank', windowFeatures );

				if (typeof ga == "function" && true === swpClickTracking) {
					if($(this).hasClass('nc_tweet')) {
						var network = $(this).parents(".nc_tweetContainer").attr("data-network");
					} else if ($(this).hasClass('swp_CTT') ) {
						var network = 'ctt';
					}
					ga("send", "event", "social_media", "swp_" + network + "_share" );
				}

				return false;
			}
		});
	}

	$( window ).on('load' , function() {
		if ( 'undefined' !== typeof swpPinIt && swpPinIt.enabled ) {
			pinitButton();
		}
	});

	$( document ).ready( function() {
		handleWindowOpens();
		initShareButtons();
		var sidePanel = $( '.swp_social_panelSide' );

		// Fetch the padding amount to make space later for the floating bars
		window.bodyPaddingTop = absint( $( 'body' ).css( 'padding-top' ).replace( 'px', '' ) );
		window.bodyPaddingBottom = absint( $( 'body' ).css( 'padding-bottom' ).replace( 'px', '' ) );

		var swp_hover = false;
		$( '.swp_social_panel' ).hover(
		    function () {
		        swp_hover = true;
		    },
		    function () {
		        swp_hover = false;
		    }
		);
		$( window ).resize( swp.debounce( 250, function() {
			if ( $( '.swp_social_panel' ).length && false !== swp_hover ) { } else {
				window.swpAdjust = 1;
				initShareButtons();
			}
		}));

		// $( window ).trigger( 'resize' );

		$( document.body ).on( 'post-load', function() {
			initShareButtons();
		});

		if ( 0 !==  sidePanel.length ) {
			// *If using top or bottom vertical positions, let CSS position the element.
			if ( $(sidePanel).attr("class").indexOf("swp_side") !== -1) return;

			var buttonsHeight = $( sidePanel ).height();
			var windowHeight = $( window ).height();
			var newPosition = absint( ( windowHeight / 2 ) - ( buttonsHeight / 2 ) );
			setTimeout( function() {
				$( sidePanel ).animate({ top: newPosition }, 0 );
			}, 105 );
		}

		//if( swp_isMobile.phone ) {
		//	$('.swp_whatsapp').addClass('mobile');
		//}

		// Hide empty containers
	    if( 1 === $('.swp-content-locator').parent().children().length ) {
	        $('.swp-content-locator').parent().hide();
	    }

	});
})( this, jQuery );

(function (global) {

    var apple_phone         = /iPhone/i,
        apple_ipod          = /iPod/i,
        apple_tablet        = /iPad/i,
        android_phone       = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i, // Match 'Android' AND 'Mobile'
        android_tablet      = /Android/i,
        amazon_phone        = /(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,
        amazon_tablet       = /(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,
        windows_phone       = /Windows Phone/i,
        windows_tablet      = /(?=.*\bWindows\b)(?=.*\bARM\b)/i, // Match 'Windows' AND 'ARM'
        other_blackberry    = /BlackBerry/i,
        other_blackberry_10 = /BB10/i,
        other_opera         = /Opera Mini/i,
        other_chrome        = /(CriOS|Chrome)(?=.*\bMobile\b)/i,
        other_firefox       = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i, // Match 'Firefox' AND 'Mobile'
        seven_inch = new RegExp(
            '(?:' +         // Non-capturing group

            'Nexus 7' +     // Nexus 7

            '|' +           // OR

            'BNTV250' +     // B&N Nook Tablet 7 inch

            '|' +           // OR

            'Kindle Fire' + // Kindle Fire

            '|' +           // OR

            'Silk' +        // Kindle Fire, Silk Accelerated

            '|' +           // OR

            'GT-P1000' +    // Galaxy Tab 7 inch

            ')',            // End non-capturing group

            'i');           // Case-insensitive matching

    var match = function(regex, userAgent) {
        return regex.test(userAgent);
    };

    var IsMobileClass = function(userAgent) {
        var ua = userAgent || navigator.userAgent;

        // Facebook mobile app's integrated browser adds a bunch of strings that
        // match everything. Strip it out if it exists.
        var tmp = ua.split('[FBAN');
        if (typeof tmp[1] !== 'undefined') {
            ua = tmp[0];
        }

        // Twitter mobile app's integrated browser on iPad adds a "Twitter for
        // iPhone" string. Same probable happens on other tablet platforms.
        // This will confuse detection so strip it out if it exists.
        tmp = ua.split('Twitter');
        if (typeof tmp[1] !== 'undefined') {
            ua = tmp[0];
        }

        this.apple = {
            phone:  match(apple_phone, ua),
            ipod:   match(apple_ipod, ua),
            tablet: !match(apple_phone, ua) && match(apple_tablet, ua),
            device: match(apple_phone, ua) || match(apple_ipod, ua) || match(apple_tablet, ua)
        };
        this.amazon = {
            phone:  match(amazon_phone, ua),
            tablet: !match(amazon_phone, ua) && match(amazon_tablet, ua),
            device: match(amazon_phone, ua) || match(amazon_tablet, ua)
        };
        this.android = {
            phone:  match(amazon_phone, ua) || match(android_phone, ua),
            tablet: !match(amazon_phone, ua) && !match(android_phone, ua) && (match(amazon_tablet, ua) || match(android_tablet, ua)),
            device: match(amazon_phone, ua) || match(amazon_tablet, ua) || match(android_phone, ua) || match(android_tablet, ua)
        };
        this.windows = {
            phone:  match(windows_phone, ua),
            tablet: match(windows_tablet, ua),
            device: match(windows_phone, ua) || match(windows_tablet, ua)
        };
        this.other = {
            blackberry:   match(other_blackberry, ua),
            blackberry10: match(other_blackberry_10, ua),
            opera:        match(other_opera, ua),
            firefox:      match(other_firefox, ua),
            chrome:       match(other_chrome, ua),
            device:       match(other_blackberry, ua) || match(other_blackberry_10, ua) || match(other_opera, ua) || match(other_firefox, ua) || match(other_chrome, ua)
        };
        this.seven_inch = match(seven_inch, ua);
        this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch;

        // excludes 'other' devices and ipods, targeting touchscreen phones
        this.phone = this.apple.phone || this.android.phone || this.windows.phone;

        // excludes 7 inch devices, classifying as phone or tablet is left to the user
        this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet;

        if (typeof window === 'undefined') {
            return this;
        }
    };

    var instantiate = function() {
        var IM = new IsMobileClass();
        IM.Class = IsMobileClass;
        return IM;
    };

    if (typeof module !== 'undefined' && module.exports && typeof window === 'undefined') {
        //node
        module.exports = IsMobileClass;
    } else if (typeof module !== 'undefined' && module.exports && typeof window !== 'undefined') {
        //browserify
        module.exports = instantiate();
    } else if (typeof define === 'function' && define.amd) {
        //AMD
        define('swp_isMobile', [], global.swp_isMobile = instantiate());
    } else {
        global.swp_isMobile = instantiate();
    }

})(this);
