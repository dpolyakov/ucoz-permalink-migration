<?php

/*
Plugin Name: uCoz permalink migration
Description: Правильные редиректы с юкозовских урлов.
Version: 1.1
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
    $patterns = array("/index/", "/blog/", "'\/'");
    $query = preg_replace($patterns, '', $query);

    $params = explode("-", $query);
    $params_count = count($params);

    // "Странный урл 86-" или страница
    if ($params_count == 4 || $params_count == 2) {
        $permalink = get_permalink($params[1]);
    }

    // Пост с множеством комментов
    if ($params_count == 6) {
        $permalink = get_permalink($params[3]);
    }

    // Скорее всего это категория
    if ($params_count == 3) {
        $category = get_category_by_slug($query);
        $category_id = $category->term_id;
        $permalink = get_category_link($category_id);
    }

    if ($permalink) {
        do_internal_redirect($permalink);
    }
}

function do_internal_redirect($permalink)
{
    if (strcasecmp($permalink, '') != 0) {
        wp_redirect($permalink, 301);
        exit;
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