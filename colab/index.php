<?php

	$sites = wp_get_sites();

	foreach ( $sites as $site ) {
		print $post['path'];
	}

?>