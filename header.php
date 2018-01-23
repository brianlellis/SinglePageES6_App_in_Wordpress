<!DOCTYPE html>
<html lang="en">
<head>

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta charset="utf-8">

	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i|Merriweather:400,400i,700,700i|Montserrat:400,700" rel="stylesheet">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<div id="site-wrap">

	<?php // Content: Header
	get_template_part( 'content/header/default' ); ?>
