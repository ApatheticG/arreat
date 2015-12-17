/*jslint
    browser: true
*/
/*global
    jQuery, arreatData, tinymce, tinyMCE, slide
*/
/*
    scripts.js

    License: GNU General Public License v3.0
    License URI: http://www.gnu.org/licenses/gpl-3.0.html

    Copyright: (c) 2013 Alexander "Alx" Agnarson, http://alxmedia.se
*/

"use strict";

/*  Цитирование
------------------------------------ */

var ArreatTools = {
    storage: { },
    quote_wrote: 'написал(а)',
    get_selection: function () {
        var t = '';

        if (window.getSelection) {
            t = window.getSelection();
        } else if (document.getSelection) {
            t = document.getSelection();
        } else if (document.selection) {
            t = document.selection.createRange().text;
        }

        return jQuery.trim(t.toString());
    },
    init: function () {
        jQuery(document).on('click', '.js-reply', function (e) {
            e.preventDefault();

            if (jQuery('#bbp_reply_content').length > 0) {
                var qout = ArreatTools.get_selection(),
                    author = jQuery(this).data('author'),
                    url = jQuery(this).data('url'),
                    id = jQuery(this).data('id'),
                    quote_id = jQuery(id).clone().find('.bbp-reply-revision-log').remove().end(), // Чистка от мусора
                    title,
                    txtr,
                    cntn,
                    old_ie = jQuery.browser.msie && parseInt(jQuery.browser.version, 10) < 9;


                if (qout === "") {
                    qout = quote_id.html();
                }

                qout = qout.replace(/&nbsp;/g, " ");
                qout = qout.replace(/<p>|<br>/g, "");
                qout = qout.replace(/<\/\s*p>/g, "\n");

                title = '<div><a href="' + url + '">';
                title += author + ' ' + ArreatTools.quote_wrote + ':</a></div>';
                qout = '<blockquote>' + title + qout + '</blockquote>';

                if (arreatData.wp_editor === 1 && !jQuery("#bbp_reply_content").is(":visible")) {
                    if (arreatData.wp_version > 38) {
                        tinymce.get("bbp_reply_content").execCommand("mceInsertContent", false, qout + '<p></p>');
                    } else {
                        tinyMCE.execInstanceCommand("bbp_reply_content", "mceInsertContent", false, qout + '<p></p>');
                    }
                } else {
                    txtr = jQuery("#bbp_reply_content");
                    cntn = txtr.val();

                    if (jQuery.trim(cntn) !== '') {
                        qout = "\n\n" + qout;
                    }

                    txtr.val(cntn + qout);
                }

                if (!old_ie) {
                    jQuery("html, body").animate({scrollTop: jQuery("#new-post").offset().top}, 1000);
                } else {
                    document.location.href = "#new-post";
                }
            }
        });
    }
};


jQuery(document).ready(function ($) {

/*  Toggle header search
------------------------------------ */
	$('.toggle-search').click(function () {
		$('.toggle-search').toggleClass('active');
		$('.search-expand').fadeToggle(250);
        setTimeout(function () {
            $('.search-expand input').focus();
        }, 300);
	});

/*  Scroll to top
------------------------------------ */
	$('a#back-to-top').click(function () {
		$('html, body').animate({scrollTop: 0}, 'slow');
		return false;
	});

/*  Tabs widget
------------------------------------ */
	(function () {
		var $tabsNav       = $('.alx-tabs-nav'),
			$tabsNavLis    = $tabsNav.children('li'),
			$tabsContainer = $('.alx-tabs-container');

		$tabsNav.each(function () {
			var $this = $(this);
			$this.next().children('.alx-tab').stop(true, true).hide()
			     .siblings($this.find('a').attr('href')).show();
			$this.children('li').first().addClass('active').stop(true, true).show();
		});

		$tabsNavLis.on('click', function (e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
			     .addClass('active');

			$this.parent().next().children('.alx-tab').stop(true, true).hide()
			     .siblings($this.find('a').attr('href')).fadeIn();
			e.preventDefault();
		}).children(window.location.hash ? 'a[href=' + window.location.hash + ']' : 'a:first').trigger('click');

	}());

/*  Comments / pingbacks tabs
------------------------------------ */
    $(".comment-tabs li").click(function () {
        $(".comment-tabs li").removeClass('active');
        $(this).addClass("active");
        $(".comment-tab").hide();
        var selected_tab = $(this).find("a").attr("href");
        $(selected_tab).fadeIn();
        return false;
    });

/*  Table odd row class
------------------------------------ */
	$('table tr:odd').addClass('alt');

/*  Sidebar collapse
------------------------------------ */
	$('body').addClass('s1-collapse');
	$('body').addClass('s2-collapse');

	$('.s1 .sidebar-toggle').click(function () {
		$('body').toggleClass('s1-collapse').toggleClass('s1-expand');
		if ($('body').is('.s2-expand')) {
			$('body').toggleClass('s2-expand').toggleClass('s2-collapse');
		}
	});
	$('.s2 .sidebar-toggle').click(function () {
		$('body').toggleClass('s2-collapse').toggleClass('s2-expand');
		if ($('body').is('.s1-expand')) {
			$('body').toggleClass('s1-expand').toggleClass('s1-collapse');
		}
	});

/*  Dropdown menu animation
------------------------------------ */
	$('.nav ul.sub-menu').hide();
	$('.nav li').hover(
		function () {
			$(this).children('ul.sub-menu').slideDown('fast');
		},
		function () {
			$(this).children('ul.sub-menu').hide();
		}
	);

/*  Mobile menu smooth toggle height
------------------------------------ */
	$('.nav-toggle').on('click', function () {
		slide($('.nav-wrap .nav', $(this).parent()));
	});

	function slide(content) {
		var wrapper = content.parent(),
            contentHeight = content.outerHeight(true),
            wrapperHeight = wrapper.height();

		wrapper.toggleClass('expand');
		if (wrapper.hasClass('expand')) {
            setTimeout(function () {
                wrapper.addClass('transition').css('height', contentHeight);
            }, 10);
        } else {
            setTimeout(function () {
                wrapper.css('height', wrapperHeight);
                setTimeout(function () {
                    wrapper.addClass('transition').css('height', 0);
                }, 10);
            }, 10);
        }

        wrapper.one('transitionEnd webkitTransitionEnd transitionend oTransitionEnd msTransitionEnd', function () {
            if (wrapper.hasClass('open')) {
                wrapper.removeClass('transition').css('height', 'auto');
            }
        });
	}

    ArreatTools.init();

});
