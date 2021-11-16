<?php

/**
 * Register & load scripts & styles
 */
add_action('wp_enqueue_scripts', function () {
    wp_register_style('gfonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;700&display=swap', array(), null);
    wp_register_style('style', get_template_directory_uri() . '/style.css');
    // wp_deregister_script('jquery');


    // enqueue
    wp_enqueue_style('gfonts');
    wp_enqueue_style('style');

    wp_dequeue_style('wc-block-style');
});

/**
 * Set theme supports
 */
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('page-template');
    add_theme_support('featured-content');

    register_nav_menus([
        'main' => __('Principal'),
        'footer' => __('Footer'),
        'social' => __('Social')
    ]);
});

add_action('init', function () {

    register_post_type('artists', array(
        'labels' => [
            'name' => __('Artistes'),
            'singular_name' => __('Artiste'),
            'all_items' => __('Tous les artistes'),
            'add_new' => __('Ajouter un artiste')
        ],
        'taxonomies' => array('category'),
        'menu_icon' => 'dashicons-groups',
        'public' => true,
        'has_archives' => true,
        'rewrite' => array('slug' => 'artistes'),
        'show_in_rest' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'supports' => ['title', 'thumbnail', 'custom-fields', 'page-attributes']
    ));
});

/**
 * Remove admin links
 *
 * @return void
 */
function wp_remove_admin_links()
{
    remove_menu_page('edit-comments.php');
    // remove_menu_page('opening_hours');
}
add_action('admin_init', 'wp_remove_admin_links');

/**
 * Set skip links to the top of the page
 *
 * @param string $contentId
 * @param string $contentLabel
 * @param string $navId
 * @param string $navLabel
 * @return void
 */
function set_skip_link(
    $contentId = '#main-content',
    $contentLabel = 'Aller au contenu principal',
    $navId = '#main-navigation',
    $navLabel = "Aller à la navigation principale"
) {
    $skiplinks = '<nav aria-label="skip links" class="skip-links-navigation">';
    $skiplinks .= "<a href='" . $navId . "'>" . $navLabel . "</a>";
    $skiplinks .= "<a href='" . $contentId . "'>" . $contentLabel . "</a>";
    $skiplinks .= "</nav>";

    echo $skiplinks;
}

/**
 * Undocumented function
 *
 * @param string $message
 * @param boolean $display
 * @return void
 */
function informations_box($message, $display = false)
{
    $box = '<div role="alert" class="alert bg-orange py-2 lg:py-4 text-light text-sm lg:text-base font-medium">
    <div class="container flex items-center space-x-2 lg:space-x-4">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 w-7" aria-hidden="true"><path fill="none" d="M0 0h24v24H0z"/><path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z"/></svg>
    <span>' . $message . '</span>
    </div>
    </div>';
    
    if($display) {
        echo $box;
    } else {
        return;
    }
}

/**
 * Get the breadcrumb
 *
 * @param string $theme
 * @return breadcrumb
 */
function get_breadcrumb($theme = 'dark', $post_ID)
{

    $bread = '';
    $bread_classes = 'breadcrumb';
    if ($theme === 'light') {
        $bread_classes .= ' is-light';
    }


    $bread .= '<ul class="' . $bread_classes . '">';
    $attrs = '';
    if (get_permalink(get_the_ID()) === get_the_permalink()) {
        $attrs .= 'aria-current="page"';
    }
    if (is_page() || is_single()) {
        $bread .= '<li><a href="' . get_bloginfo('url') . '">' . get_bloginfo('title') . '</a></li>';
        if (get_post($post_ID)->post_parent) {
            $bread .= '<li><a href="' . get_permalink(get_post($post_ID)->post_parent) . '">' . get_the_title(get_post($post_ID)->post_parent) . '</a></li>';
        }
        if (get_the_category($post_ID)) {

            $cat = get_the_category($post_ID)[0];
            $cat_url = get_category_link($cat);
            $bread .= '<li><a href="' . $cat_url . '">' . $cat->name . '</a></li>';
        }
        $bread .= '<li ' . $attrs . '>' . get_the_title() . '</li>';
    } else if (is_category()) {
        $bread .= '<li><a href="' . get_bloginfo('url') . '">' . get_bloginfo('title') . '</a></li>';
        $cat = get_the_category()[0];
        $bread .= '<li ' . $attrs . '>' . $cat->name . '</li>';
    }
    $bread .= '</li>';
    $bread .= '</ul>';

    echo $bread;
}

/**
 * Define navigation walker
 */
class Main_Nav_Walker extends Walker_Nav_Menu
{

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        if ($args->walker->has_children) {
            $class_names .= ' group';
        }
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '';

        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';
        if (in_array('current-menu-item', $item->classes)) {
            $attributes .= 'aria-current="page"';
        }

        $item_output = $args->before;
        $item_output .= '<li' . $class_names . '>';
        $item_output .= '<a' . $attributes . ' class="flex-grow">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        if ($args->walker->has_children) {
            $item_output .= '<label role="button" aria-label="collapse sub-menu" for="check-menu-item-parent-' . $item->ID . '" class="ml-auto lg:ml-1 w-7 h-7 flex place-items-center justify-center">
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 15l-4.243-4.243 1.415-1.414L12 12.172l2.828-2.829 1.415 1.414z"/></svg>
            </label>';
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        $item_output .= $args->after;
        if ($args->walker->has_children) {
            $output .= '<input type="checkbox" class="hidden" id="check-menu-item-parent-' . $item->ID . '">';
        }
        $item_output .= '</li>';
    }
}

/**
 * Define social navigation walker
 */
class Social_Nav_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names .= ' w-8 h-8 inline-flex items-center justify-center';
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $href = '';

        $output .= '<li ' . $class_names . '>';
        $output .= '<a href="' . $item->url . '" target="' . $item->target . '">';
        if (str_contains($class_names, 'instagram')) {
            $href = 'instagram';
            // $output .= '<svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>';
        } elseif (str_contains($class_names, 'facebook')) {
            $href = 'facebook';
            // $output .= '<svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';
        } elseif (str_contains($class_names, 'youtube')) {
            $href = 'youtube';
            // $output .= '<svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>YouTube</title><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>';
        }
        $output .= '<svg class="icon h-6 w-6 text-yellow-300"><use xlink:href="#' . $href . '" /></svg>';
        $output .= '</a>';
        $output .= '</li>';
    }
}
