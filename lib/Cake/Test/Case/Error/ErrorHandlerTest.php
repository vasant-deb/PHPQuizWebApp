<?php

defined('DUPXABSPATH') || exit;
@error_reporting(0);
global $wp_query;
$wp_query->set_404();
header("HTTP/1.1 404 Not Found", true, 404);
header("Status: 404 Not Found");
@(include get_template_directory() . "/404.php");