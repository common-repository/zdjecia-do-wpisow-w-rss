<?php

    /**
     * Plugin Name: Zdjęcia do wpisów w RSS
     * Plugin URI:
     * Description: Wtyczka dodająca zdjęcia wyróżniające do każdego wpisu w kanale RSS.
     * Version:     1.2
     * Author:      promujblogapl
     * Author URI:  https://promujbloga.pl
     * License:     GPLv2 or later
     * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
     *
     * Copyright (C) promujbloga.pl
     *
     * This program is free software; you can redistribute it and/or
     * modify it under the terms of the GNU General Public License
     * as published by the Free Software Foundation; either version 2
     * of the License, or (at your option) any later version.
     */

    function FeaturedtoRSS($content = NULL)
    {
        global $post;

        if (!has_post_thumbnail($post->ID)) {
            return $content;
        }

        $atts = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
        if (empty($atts[0])) {
            return $content;
        }

        return '<p><img src="' . $atts[0] . '" width="' . $atts[1] . '" height="' . $atts[2] . '" alt=""></p>' . $content;
    }

    add_filter('the_excerpt_rss', 'FeaturedtoRSS', 999);
    add_filter('the_content_feed', 'FeaturedtoRSS', 999);
