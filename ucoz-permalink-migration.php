<?php

/*
Plugin Name: uCoz permalink migration
Description: Правильные редиректы с юкозовских урлов.
Version: 1.0
Author: Dmitry Polyakov
Author URI: http://my-html.ru
*/

function external_redirect($query)
{
    $permalink = preg_replace("/\/go\?/", '', $query);

    wp_redirect($permalink, 302);
    exit;
}

function internal_redirect($query)
{
    $post_id = 0;
    $patterns = array("/index/", "/blog/", "'\/'");
    $query = preg_replace($patterns, '', $query);

    $params = explode("-", $query);
    $params_count = count($params);

    if ($params_count == 4 || $params_count == 2) {
        $post_id = $params[1];
    }

    if ($params_count == 6) {
        $post_id = $params[3];
    }

    if ($post_id) {
        $permalink = get_permalink($post_id);

        if (strcasecmp($permalink, '') != 0) {
            wp_redirect($permalink, 301);
            exit;
        }
    }
}

function ucoz_redirect($template)
{
    $query = $_SERVER['REQUEST_URI'];

    if (strrpos($query, "go?")) {
        external_redirect($query);
    } else {
        internal_redirect($query);
    }

    return $template;
}

add_filter('404_template', 'ucoz_redirect');

?>