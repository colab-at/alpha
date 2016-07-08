<!DOCTYPE html>
<html>
<head>
	<title>Colab</title>
</head>
<body>

<?php get_header(); ?>

<?php

	$sites = wp_get_sites(array(
    'network_id' => null,
    'public'     => null,
    'archived'   => 0,
    'mature'     => 0,
    'spam'       => 0,
    'deleted'    => 0,
    'limit'      => 100,
    'offset'     => 0
	));

	for ($i = 0; $i < count($sites); $i++) {
		if ($sites[$i]['path'] !== "/") {
			echo '<a href="' . $sites[$i]['path'] . '">' . $sites[$i]['path'] . '</a><br>';
		}
	}

?>

<br>
<a href="wp-signup.php">Create a new project</a>

<?php get_footer(); ?>

</body>
</html>