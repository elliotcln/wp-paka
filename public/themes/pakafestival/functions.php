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

    if ($display) {
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
function get_breadcrumb($post_ID)
{

    $bread = '';
    $bread_classes = 'breadcrumb';


    $bread .= '<ul class="' . $bread_classes . '">';
    $bread .= '<li><a href="' . get_bloginfo('url') . '">' . get_bloginfo('title') . '</a></li>';
    $attrs = '';
    if (get_permalink(get_the_ID()) === get_the_permalink()) {
        $attrs .= 'aria-current="page"';
    }
    if (is_home()) {
        $bread .= '<li ' . $attrs . '>' . get_the_title($post_ID) . '</li>';
    } else if (is_page()) {
        if (get_post($post_ID)->post_parent) {
            $bread .= '<li><a href="' . get_permalink(get_post($post_ID)->post_parent) . '">' . get_the_title(get_post($post_ID)->post_parent) . '</a></li>';
        }
        // $blog_id = get_option('page_for_posts');
        // $bread .= '<li><a href="' . get_permalink($blog_id) . '">' . get_the_title($blog_id) . '</a></li>';
        // if (get_the_category($post_ID)) {

        //     $cat = get_the_category($post_ID)[0];
        //     $cat_url = get_category_link($cat);
        //     $bread .= '<li><a href="' . $cat_url . '">' . $cat->name . '</a></li>';
        // }
        $bread .= '<li ' . $attrs . '>' . get_the_title() . '</li>';
    } else if (is_single()) {
        $blog_id = get_option('page_for_posts');
        $bread .= '<li><a href="' . get_permalink($blog_id) . '">' . get_the_title($blog_id) . '</a></li>';
        $bread .= '<li ' . $attrs . '>' . get_the_title($post_ID) . '</li>';
    } else if (is_category()) {
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
            $item_output .= '<label aria-label="collapse sub-menu" for="check-menu-item-parent-' . $item->ID . '" class="ml-auto lg:ml-1 w-7 h-7 flex place-items-center justify-center">
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

        $title  = !empty($item->attr_title) ? esc_attr($item->attr_title) : $item->title;

        $href = '';

        $output .= '<li ' . $class_names . '>';
        $output .= '<a href="' . $item->url . '" title="' . $title . '" target="' . $item->target . '">';
        if (strpos($class_names, 'instagram')) {
            $href = 'instagram';
        } elseif (strpos($class_names, 'facebook')) {
            $href = 'facebook';
        } elseif (strpos($class_names, 'youtube')) {
            $href = 'youtube';
        }
        $output .= '<svg aria-hidden="true" class="icon h-6 w-6 text-yellow-300"><use xlink:href="#' . $href . '" /></svg>';
        $output .= '</a>';
        $output .= '</li>';
    }
}
