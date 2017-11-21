/*
================================================================================================
Camaraderie - customize-preview.js
================================================================================================
This is a customizer preview that allows users experience.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net/)
================================================================================================
*/

(function($) {
	// Update the site title in real time...
	wp.customize('blogname', function(value) {
		value.bind(function(newVal) {
			$('.site-title a').html(newVal);
		} );
	} );
	
	// Update the site description in real time...
	wp.customize('blogdescription', function(value) {
		value.bind(function(newVal) {
			$('.site-description').html(newVal);
		});
	});
    
	// Header text color.
	wp.customize('header_textcolor', function(value) {
		value.bind(function(newVal) {
			if ('blank' === newVal) {
				$('.site-title a, .site-description').css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$('.site-title a, .site-description').css( {
					'clip': 'auto',
					'position': 'relative'
				});
				$('.site-title a, .site-description').css( {
					'color': newVal
				});
			}
		});
	});
} )( jQuery );