<?php
/* 
Plugin Name: Wapuu Image Select API
Description: Create Wapuu Image Selector API
Version: 1.0.0
Author: IKEDA, yuriko
Author URI: http://www.yuriko.net/cat/wordpress/
License: GPL v2 or later
*/

/*  Copyright (c) 2017 IKEDA, yuriko

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_action( 'rest_api_init', function () {
	register_rest_route( 'wapuu/v1', '/set/(?P<id>\d+)', array(
		'methods' => 'POST',
		'callback' => 'set_wapuu_image',
		'args' => array(
			'id' => array(
				'validate_callback' => function($param, $request, $key) {
					return is_numeric( $param );
				}
			),
		),
	) );
	register_rest_route( 'wapuu/v1', '/get', array(
		'methods' => 'GET',
		'callback' => 'get_wapuu_image',
	) );
} );

function set_wapuu_image( $data ) {
	$id = $data['id'];
	update_post_meta( 60, 'wapuu-image', $id );
	$data = array( 'id' => $id );
	return new WP_REST_Response( $data, 200 );
}

function get_wapuu_image() {
	$id = get_post_meta( 60, 'wapuu-image', true );
	$data = array( 'id' => $id );
	return new WP_REST_Response( $data, 200 );
}