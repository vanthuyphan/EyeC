/*================================================================*\

 Name: Scripts.js
 Author: Theme Hippo
 Author URI: http://www.themehippo.com
 Version: 0.1

 \*================================================================*/


jQuery(function ($) {

    'use strict';

    /*================================================================*\
     ================================================================
     Table Of Contents
     ================================================================

     # Blank JS Wrapper
     # Off Canvas Menu
     # Mega Menu widget nav menu sub
     # Enable Bootstrap tooltip
     # Sticky Blog Sidebar
     # Sticky Menu
     # Enable Bootstrap DropDown
     # Drop Down Menu
     # Back to Top
     # Twitter Scroll Widget
     # Flickr Photo Feed
     # prettyPhoto Image Popup
     # Social Share Button Popup
     # MiniCart count on Added to cart
     # MiniCart remove item ajax
     # Before Remove From MiniCart Action
     # After Removed From MiniCart Action
     # MiniCart refresh
     # Login modal
     # Single Product Gallery
     # Variation Product Carousal
     # Product filter toggle
     # Category list toggle button
     # WooCommerce Variation Change
     # Enable Select2 on Country Select and State Select
     # Page Pre loader Remove after Page Load
     # Material Style SelectBox

     \*================================================================*/


    // ================================================================
    // Blank JS Wrapper
    // ================================================================

    (function () {


    }());

    // ================================================================
    // Off Canvas Menu
    // ================================================================

    (function () {

        // click button
        $('.navbar-toggle').HippoOffCanvasMenu({

            documentWrapper : '#wrapper',
            contentWrapper  : '.contents',
            position        : eyewearJSObject.offcanvas_menu_position,    // class name
            // opener         : 'st-menu-open',         // class name
            effect          : eyewearJSObject.offcanvas_menu_effect,  // class name
            closeButton     : '.close-sidebar',
            menuWrapper     : '#offcanvasmenu',                // class name
            documentPusher  : '.pusher'
        });
    }());

    // ================================================================
    // Mega Menu widget nav menu sub
    // ================================================================

    (function () {

        $('.megamenu-widget.widget_nav_menu .current-menu-item').parents("ul.sub-menu").addClass('show-child');

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children > a').each(function () {
            $(this).append($('<i class="fa fa-angle-right child-opener"></i>'));
        });

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children > ul').each(function () {
            $(this).prepend($('<li class="child-closer-wrapper"><a class="child-closer" href="#"><i class="fa fa-angle-left"></i> Back </a></li>'));
        });

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children .child-opener').on('click', function (e) {

            e.preventDefault();

            $(this).closest('li').find('>ul').addClass('show-child');
            //var height = $(this).closest('li').find('>ul').height();
            var height = $(this).closest('li').find('>ul')[0].scrollHeight;
            $(this).closest('.megamenu-widget.widget_nav_menu > div > ul').css('height', height);

        });

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children .child-closer').on('click', function (e) {

            e.preventDefault();

            $(this).closest('ul').removeClass('show-child');
            //var height = $(this).closest('ul').prev().closest('ul').height();
            var height = $(this).closest('ul').prev().closest('ul')[0].scrollHeight;

            if ($(this).closest('ul').prev().closest('ul').is($(this).closest('ul.menu'))) {
                $(this).closest('.megamenu-widget.widget_nav_menu > div > ul').css('height', '');
            }
            else {
                $(this).closest('.megamenu-widget.widget_nav_menu > div > ul').css('height', height);
            }
        });
    }());

    // ================================================================
    // Enable Bootstrap tooltip
    // ================================================================

    (function () {
        $('[data-toggle="tooltip"]').tooltip();
    }());

    // ================================================================
    // Sticky Blog Sidebar
    // ================================================================
    if (eyewearJSObject.is_sticky_sidebar && (eyewearJSObject.is_home || eyewearJSObject.is_single_post)) {
        (function () {

            $('.blog-section .right-sidebar, .blog-section .left-sidebar').stick_in_parent();
        }());
    }

    // ================================================================
    // Sticky Menu
    // ================================================================

    if (eyewearJSObject.is_sticky_menu) {
        (function () {

            var class_added = false;

            var minimum_scroll_to_show = 150; // px

            $(document.body).on('windowScrolling', function (event, current_position, last_position, default_position) {

                // Going down and reach minimum scroll requirement :)
                if ((current_position >= last_position || current_position <= minimum_scroll_to_show) && class_added) {
                    $('.header').removeClass('sticky-header animated fadeInDown');
                    class_added = false;
                }

                // Going up and class already added :)
                if ((current_position <= last_position && current_position >= minimum_scroll_to_show) && !class_added) {
                    $('.header').addClass('sticky-header animated fadeInDown');
                    class_added = true;
                }
            });
        }());
    }


    // ================================================================
    // Enable Bootstrap DropDown
    // ================================================================

    (function () {
        $('[data-toggle="dropdown"]').dropdown();
    }());

    // ================================================================
    // Drop Down Menu
    // ================================================================

    (function () {

        function getIEVersion() {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
            return match ? parseInt(match[1]) : false;
        }

        if (getIEVersion()) {
            $('html').addClass('ie ie' + getIEVersion());
        }

        if ($('html').hasClass('ie9') || $('html').hasClass('ie10')) {
            $('.submenu-wrapper').each(function () {
                $(this).addClass('no-pointer-events');
            });
        }


        var timer;

        $('li.dropdown').on('mouseenter', function (event) {


            event.stopImmediatePropagation();
            event.stopPropagation();

            $(this).removeClass('open menu-animating').addClass('menu-animating');
            var that = this;

            if (timer) {
                clearTimeout(timer);
                timer = null;
            }

            timer = setTimeout(function () {

                $(that).removeClass('menu-animating');
                $(that).addClass('open');

            }, 300);   // 300ms as css animation end time

        });

        // on mouse leave

        $('li.dropdown').on('mouseleave', function (event) {

            var that = this;

            $(this).removeClass('open menu-animating').addClass('menu-animating');


            if (timer) {
                clearTimeout(timer);
                timer = null;
            }

            timer = setTimeout(function () {

                $(that).removeClass('menu-animating');
                $(that).removeClass('open');

            }, 300);  // 300ms as animation end time

        });

    }());

    // ================================================================
    // Back to Top
    // ================================================================

    if (eyewearJSObject.back_to_top) {
        (function () {

            $('body').append('<div class="hidden-xs" id="toTop"><i class="zmdi zmdi-long-arrow-up"></i></div>');

            $(window).scroll(function () {
                if ($(this).scrollTop() >= 700) {
                    $('#toTop').fadeIn();
                }
                else {
                    $('#toTop').fadeOut();
                }
            });

            $('#toTop').on('click', function () {
                $("html, body").animate({scrollTop : 0}, 600);
                return false;
            });

        }());
    }

    // ================================================================
    // Twitter Scroll Widget
    // ================================================================

    /**
     * ### HOW TO CREATE A VALID ID TO USE: ###
     * Go to www.twitter.com and sign in as normal, go to your settings page.
     * Go to "Widgets" on the left hand side.
     * Create a new widget for what you need eg "user time line" or "search" etc.
     * Feel free to check "exclude replies" if you don't want replies in results.
     * Now go back to settings page, and then go back to widgets page and
     * you should see the widget you just created. Click edit.
     * Look at the URL in your web browser, you will see a long number like this:
     * 567185781790228482
     * Use this as your ID below instead!
     */
    if (eyewearJSObject.is_twitter_widget) {
        (function () {

            var widgetId = $('.twitterWidget').attr('data-widget-id');
            var maxTweetNumber = $('.twitterWidget').attr('data-max-tweet');
            var twitterConfig = {
                id              : widgetId, //put your widget ID here
                domId           : "twitterWidget",
                maxTweets       : maxTweetNumber,
                enableLinks     : true,
                showUser        : false,
                showTime        : true,
                showInteraction : false,
                customCallback  : handleTweets
            };
            twitterFetcher.fetch(twitterConfig);

            function handleTweets(tweets) {
                var x = tweets.length;
                var n = 0;
                var html = "";
                while (n < x) {
                    html += '<div class="item">' + tweets[n] +
                        "</div>";
                    n++
                }
                $(".twitter-widget").html(html);
                $(".twitter_retweet_icon").html(
                    '<i class="fa fa-retweet"></i>');
                $(".twitter_reply_icon").html(
                    '<i class="fa fa-reply"></i>');
                $(".twitter_fav_icon").html(
                    '<i class="fa fa-star"></i>');
                $(".twitter-widget").owlCarousel({
                    items      : 1,
                    autoPlay   : false,
                    singleItem : true,
                    navigation : false,
                    pagination : false
                });
            }
        }());
    }

    // ================================================================
    // Flickr Photo Feed
    // ================================================================

    if (eyewearJSObject.is_flicker_widget) {
        (function () {

            $('.flickr-photo-stream').jflickrfeed({
                limit        : $('.flickr-photo-stream').attr('data-photo-limit'),
                qstrings     : {
                    id : $('.flickr-photo-stream').attr('data-flickr-id')
                },
                itemTemplate : '<li>' +
                '<a href="{{image}}" title="{{title}}">' +
                '<img src="{{image_s}}" alt="{{title}}" />' +
                '</a>' +
                '</li>'
            });
        }());
    }
    // ================================================================
    // prettyPhoto Image Popup
    // ================================================================

    (function () {
        $(window).load(function () {
            $("a[href$='.png'], a[href$='.jpg'], a[href$='.jpeg'], .element-lightbox").prettyPhoto({
                social_tools : ''
            });
        });
    }());

    // ================================================================
    // Social Share Button Popup
    // ================================================================

    (function () {
        $('.social a').on('click', function () {
            var newwindow = window.open($(this).attr('href'), '', 'height=450,width=700');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        });
    }());

    // ================================================================
    // MiniCart count on Added to cart
    // ================================================================

    (function () {
        $(document.body).on('added_to_cart', function (e, data) {
            $.get(eyewearJSObject.ajax_url, {
                action : 'eyewear_cart_count'
            }, function (data, status) {
                $('#mini-cart-total').text(data);
            });
        });
    })();

    // ================================================================
    // MiniCart remove item ajax
    // ================================================================

    (function () {
        $(document.body).on('click', '.hippo-remove-from-mini-cart-ajax', function (e) {

            e.preventDefault();

            var item_key = $.trim($(this).attr('data-item_key'));
            var product_id = $.trim($(this).attr('data-product_id'));
            var that = this;

            $(document.body).trigger('hippo_before_remove_from_mini_cart', [that, product_id, item_key]);

            $.get(eyewearJSObject.ajax_url, {
                action      : 'eyewear_remove_from_mini_cart',
                remove_item : item_key
            }, function (data, status) {
                $(document.body).trigger('added_to_cart');
                $(document.body).trigger('hippo_wc_fragments_refresh');
                $(document.body).trigger('hippo_after_removed_from_mini_cart', [that, product_id]);
            });
        });
    })();


    // ================================================================
    // Before Remove From MiniCart Action
    // ================================================================

    (function () {
        $(document.body).on('hippo_before_remove_from_mini_cart', function (e, that, product_id) {

            $(that).closest('.mini_cart_item').addClass('removing');

            if ($().block) {
                $(that).closest('.mini_cart_item').block({message : null});
            }
        });

    })();

    // ================================================================
    // After Removed From MiniCart Action
    // ================================================================

    (function () {
        $(document.body).on('hippo_after_removed_from_mini_cart', function (e, that, product_id) {

            //$(that).closest('.mini_cart_item').removeClass('removing');

            if ($().unblock) {
                $(that).closest('.mini_cart_item').unblock();
            }
        });

    })();


    // ================================================================
    // MiniCart refresh
    // ================================================================

    (function () {
        $(document.body).on('hippo_wc_fragments_refresh', function () {

            /* Storage Handling */
            var $supports_html5_storage;
            try {
                $supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );

                window.sessionStorage.setItem('wc', 'test');
                window.sessionStorage.removeItem('wc');
            }
            catch (err) {
                $supports_html5_storage = false;
            }

            var $fragment_refresh = {
                url     : wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
                type    : 'POST',
                success : function (data) {
                    if (data && data.fragments) {

                        $.each(data.fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });

                        if ($supports_html5_storage) {
                            sessionStorage.setItem(wc_cart_fragments_params.fragment_name, JSON.stringify(data.fragments));
                            sessionStorage.setItem('wc_cart_hash', data.cart_hash);
                        }

                        $(document.body).trigger('wc_fragments_refreshed');
                    }
                }
            };

            $.ajax($fragment_refresh);
        });
    })();

    // ================================================================
    // Login modal
    // ================================================================

    (function () {
        $('.toggle').on('click', function () {
            $('.form-container').stop().addClass('active');
        });

        $('.close').on('click', function () {
            $('.form-container').stop().removeClass('active');
        });
    }());

    // ================================================================
    // Single Product Gallery
    // ================================================================

    if (eyewearJSObject.is_woocommerce) {
        $(window).on('load', function () {

            $('.hippo-gallery').flexslider({
                animation     : "slide",
                directionNav  : false,
                controlNav    : false,
                animationLoop : false,
                slideshow     : false,
                //sync          : ".hippo-thumb"
                //controlsContainer: $(".hippo-product-gallery-thumb-wrapper >.hippo-thumb"),
            });

            // Navigation
            $('.hippo-thumb li').on('click', function (e) {

                $('.hippo-gallery').flexslider($(this).index());
                //console.log($(this).index());
                //$('.hippo-gallery').flexslider('prev')
                return false;
            });

            // Navigation
            $('.hippo-gallery-nav .prev').on('click', function () {
                $('.hippo-gallery').flexslider('prev')
                return false;
            });

            $('.hippo-gallery-nav .next').on('click', function () {
                $('.hippo-gallery').flexslider('next')
                return false;
            });
        }());
    }


    // ================================================================
    // Variation Product Carousal
    // ================================================================

    if (eyewearJSObject.is_woocommerce) {
        (function () {

            $(window).on('load', function () {

                $('.product-block-wrapper').each(function () {


                    var $controller = $(this).find('>.hippo-variation-product-slider-controller > li');
                    $(this).find('> a > .hippo-variation-product-slider').owlCarousel({
                        items       : 1,
                        autoPlay    : false,
                        singleItem  : true,
                        navigation  : false,
                        pagination  : false,
                        afterAction : function () {
                            $controller.removeClass('current');
                            $controller.eq(this.owl.currentItem).addClass('current');
                        }
                    });

                    var $product_variation_slider = $(this).find('> a > .hippo-variation-product-slider').data('owlCarousel');

                    $controller.on('click', function (i, e) {
                        $(this).parent().find('li').removeClass('current');
                        $product_variation_slider.goTo($(this).index());
                        $(this).addClass('current');
                    });
                });
            });

        }());
    }

    // ================================================================
    // Product filter toggle
    // ================================================================

    (function () {
        $('.shop-filter-trigger').on('click', function () {
            $('.shop-sidebar').slideToggle('slow');
        });
    }());


    // ================================================================
    // Category list toggle button
    // ================================================================

    (function () {
        $('.hippo-button-toggle').on('click', function () {
            $(this).toggleClass('open');
            $('ul').toggleClass('show-list');
        });
    }());

    // ================================================================
    // WooCommerce Variation Change
    // ================================================================

    (function () {

        $('.variations_form .variations ul.variable-items-wrapper').each(function (i, el) {

            var select = $(this).prev('select');
            var li = $(this).find('li');
            $(this).on('click', 'li:not(.selected)', function () {
                var value = $(this).data('value');
                li.removeClass('selected');
                select.val(value).trigger('change');
                $(this).addClass('selected');
            });

            $(this).on('click', 'li.selected', function () {
                li.removeClass('selected');
                select.val('').trigger('change');
                select.trigger('click');
                select.trigger('focusin');
                select.trigger('touchstart');
            });
        });
    }());

    // ================================================================
    // Enable Select2 on Country Select and State Select
    // ================================================================

    (function () {

        function getEnhancedSelectFormatString() {
            var formatString = {
                formatMatches         : function (matches) {
                    if (1 === matches) {
                        return wc_country_select_params.i18n_matches_1;
                    }

                    return wc_country_select_params.i18n_matches_n.replace('%qty%', matches);
                },
                formatNoMatches       : function () {
                    return wc_country_select_params.i18n_no_matches;
                },
                formatAjaxError       : function () {
                    return wc_country_select_params.i18n_ajax_error;
                },
                formatInputTooShort   : function (input, min) {
                    var number = min - input.length;

                    if (1 === number) {
                        return wc_country_select_params.i18n_input_too_short_1;
                    }

                    return wc_country_select_params.i18n_input_too_short_n.replace('%qty%', number);
                },
                formatInputTooLong    : function (input, max) {
                    var number = input.length - max;

                    if (1 === number) {
                        return wc_country_select_params.i18n_input_too_long_1;
                    }

                    return wc_country_select_params.i18n_input_too_long_n.replace('%qty%', number);
                },
                formatSelectionTooBig : function (limit) {
                    if (1 === limit) {
                        return wc_country_select_params.i18n_selection_too_long_1;
                    }

                    return wc_country_select_params.i18n_selection_too_long_n.replace('%qty%', limit);
                },
                formatLoadMore        : function () {
                    return wc_country_select_params.i18n_load_more;
                },
                formatSearching       : function () {
                    return wc_country_select_params.i18n_searching;
                }
            };

            return formatString;
        }

        // Select2 Enhancement if it exists

        if ($().select2) {

            var wc_country_select_select2 = function () {
                $('select.country_select:visible, select.country_to_state:visible, select.state_select:visible').each(function () {
                    var select2_args = $.extend({
                        placeholder       : $(this).attr('placeholder'),
                        placeholderOption : 'first',
                        width             : '100%'
                    }, getEnhancedSelectFormatString());

                    $(this).select2(select2_args);
                });
            };

            wc_country_select_select2();

            $(document.body).bind('country_to_state_changed', function () {
                wc_country_select_select2();
            });

            $(document).off("click", ".shipping-calculator-button");

            $(document).on('click', '.shipping-calculator-button', function () {

                $('.shipping-calculator-form').slideToggle('slow');

                wc_country_select_select2();

                return false;
            });

        }

    })();

    // ================================================================
    // Page Pre loader Remove after Page Load
    // ================================================================

    (function () {
        $(window).load(function () {
            $('#page-pre-loader').fadeOut(500, function () {
                $(this).remove();
            });
        });
    }());


    // ================================================================
    // Material Style SelectBox
    // ================================================================

    (function () {

        $('select').not('.hide, .hippo-variation-select-box, #calc_shipping_country, #calc_shipping_state, #shipping_country, #shipping_state, #billing_country, #billing_state, #rating, [multiple], :disabled').each(function (i, el) {


            var rect = $(this)[0].getBoundingClientRect();
            var options = $(this).find('option');
            var val = $(this).val();
            var text = $(this).find(':selected').text();

            var tpl = '<div class="hippo-select-wrapper" style="width: ' + (rect.width + 20) + 'px">';

            tpl += '<ul class="hippo-select-list">';

            options.each(function (i, opt) {

                if ($(this).prop('selected')) {
                    tpl += '<li class="hippo-selected" data-value="' + $(this).val() + '"> ' + $(this).text() + ' </li>';
                }
                else if ($(this).prop('disabled')) {
                    tpl += '<li class="hippo-disabled" data-value="' + $(this).val() + '"> ' + $(this).text() + ' </li>';
                }
                else {
                    tpl += '<li data-value="' + $(this).val() + '"> ' + $(this).text() + ' </li>';
                }

            });

            tpl += '</ul>';

            tpl += '<div class="hippo-select-contents">';
            tpl += '<div data-value="' + val + '" class="hippo-selected-item">' + text + '</div>';
            tpl += '<i class="zmdi zmdi-caret-down"></i></div>';


            $(this).addClass('hide').after(tpl);


        });

        $(document.body).on('click', '.hippo-select-contents', function () {
            $(this).parent().addClass('hippo-select-open');
        });

        $(document.body).on('click', '.hippo-select-list > li', function () {

            var current_value = $(this).attr('data-value');
            var current_text = $(this).text();

            $(this).closest('.hippo-select-wrapper').prev('select').val(current_value);
            $(this).closest('.hippo-select-wrapper').removeClass('hippo-select-open');
            $(this).closest('.hippo-select-wrapper').find('li').removeClass('hippo-selected');
            $(this).closest('.hippo-select-wrapper').find('li[data-value="' + current_value + '"]').addClass('hippo-selected');
            $(this).closest('.hippo-select-wrapper').find('.hippo-selected-item').text(current_text).attr('data-value', current_value);
            $(this).closest('.hippo-select-wrapper').prev('select').trigger('change');

            // Woocommerce Country to state change
            $(document.body).trigger('country_to_state_changed');
        });

        $(document.body).on('click', function (e) {
            var container = $('.hippo-select-wrapper');

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.removeClass('hippo-select-open');
            }
        });

    }());


});  // end of jquery main wrapper