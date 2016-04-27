<?php

/**
 * Замена функции из родительской темы.
 * Нужна, если нужно будет убрать сайдбар.
 */
function hu_layout_class() {
    // Default layout
    $layout = 'col-3cm';
    $default = 'col-3cm';

//    if ( is_bbpress() && !bbp_is_single_topic() ) $layout = 'col-1c';
//    // Check for page/post specific layout
//    elseif ( is_page() || is_single() ) {
    if ( is_page() || is_single() ) {
        // Reset post data
        wp_reset_postdata();
        global $post;
        // Get meta
        $meta = get_post_meta($post->ID,'_layout',true);
        // Get if set and not set to inherit
        if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) { $layout = $meta; }
        // Else check for page-global / single-global
        elseif ( is_single() && ( hu_get_option('layout-single') !='inherit' ) ) $layout = hu_get_option('layout-single',''.$default.'');
        elseif ( is_page() && ( hu_get_option('layout-page') !='inherit' ) ) $layout = hu_get_option('layout-page',''.$default.'');
        // Else get global option
        else $layout = hu_get_option('layout-global',''.$default.'');
    }

    // Set layout based on page
    elseif ( is_home() && ( hu_get_option('layout-home') !='inherit' ) ) $layout = hu_get_option('layout-home',''.$default.'');
    elseif ( is_category() && ( hu_get_option('layout-archive-category') !='inherit' ) ) $layout = hu_get_option('layout-archive-category',''.$default.'');
    elseif ( is_archive() && ( hu_get_option('layout-archive') !='inherit' ) ) $layout = hu_get_option('layout-archive',''.$default.'');
    elseif ( is_search() && ( hu_get_option('layout-search') !='inherit' ) ) $layout = hu_get_option('layout-search',''.$default.'');
    elseif ( is_404() && ( hu_get_option('layout-404') !='inherit' ) ) $layout = hu_get_option('layout-404',''.$default.'');

    // Global option
    else $layout = hu_get_option('layout-global',''.$default.'');

    // Return layout class
    return $layout;
}

/**
 * Замена функции из родительской темы
 * Добавлены некоторые форумные классы
 */
function hu_dynamic_css() {
if ( ! hu_is_checked('dynamic-styles') )
  return;
  // rgb values
  $color_1 = hu_get_option('color-1');
  $color_1_rgb = hu_hex2rgb($color_1);

  // start output
  $styles = '<style type="text/css">'."\n";
  $styles .= '/* Dynamic CSS: For no styles in head, copy and put the css below in your child theme\'s style.css, disable dynamic styles */'."\n";

  // google fonts
  if ( hu_get_option( 'font' ) == 'titillium-web-ext' ) { $styles .= 'body { font-family: "Titillium Web", Arial, sans-serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'droid-serif' ) { $styles .= 'body { font-family: "Droid Serif", serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'source-sans-pro' ) { $styles .= 'body { font-family: "Source Sans Pro", Arial, sans-serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'lato' ) { $styles .= 'body { font-family: "Lato", Arial, sans-serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'raleway' ) { $styles .= 'body { font-family: "Raleway", Arial, sans-serif; }'."\n"; }
  if ( ( hu_get_option( 'font' ) == 'ubuntu' ) || ( hu_get_option( 'font' ) == 'ubuntu-cyr' ) ) { $styles .= 'body { font-family: "Ubuntu", Arial, sans-serif; }'."\n"; }
  if ( ( hu_get_option( 'font' ) == 'roboto-condensed' ) || ( hu_get_option( 'font' ) == 'roboto-condensed-cyr' ) ) { $styles .= 'body { font-family: "Roboto Condensed", Arial, sans-serif; }'."\n"; }
  if ( ( hu_get_option( 'font' ) == 'roboto-slab' ) || ( hu_get_option( 'font' ) == 'roboto-slab-cyr' ) ) { $styles .= 'body { font-family: "Roboto Slab", Arial, sans-serif; }'."\n"; }
  if ( ( hu_get_option( 'font' ) == 'playfair-display' ) || ( hu_get_option( 'font' ) == 'playfair-display-cyr' ) ) { $styles .= 'body { font-family: "Playfair Display", Arial, sans-serif; }'."\n"; }
  if ( ( hu_get_option( 'font' ) == 'open-sans' ) || ( hu_get_option( 'font' ) == 'open-sans-cyr' ) ) { $styles .= 'body { font-family: "Open Sans", Arial, sans-serif; }'."\n"; }
  if ( ( hu_get_option( 'font' ) == 'pt-serif' ) || ( hu_get_option( 'font' ) == 'pt-serif-cyr' ) ) { $styles .= 'body { font-family: "PT Serif", serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'arial' ) { $styles .= 'body { font-family: Arial, sans-serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'georgia' ) { $styles .= 'body { font-family: Georgia, serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'verdana' ) { $styles .= 'body { font-family: Verdana, sans-serif; }'."\n"; }
  if ( hu_get_option( 'font' ) == 'tahoma' ) { $styles .= 'body { font-family: Tahoma, sans-serif; }'."\n"; }

  // container width
  if ( hu_get_option('container-width') != '1380' ) {
	if ( hu_is_checked( 'boxed' ) ) {
	  $styles .= '.boxed #wrapper, .container-inner { max-width: '.hu_get_option('container-width').'px; }'."\n";
	}
	else {
	  $styles .= '.container-inner { max-width: '.hu_get_option('container-width').'px; }'."\n";
	}
  }

  // sidebar padding
  if ( hu_get_option('sidebar-padding') != '30' ) {
	$styles .= '.sidebar .widget { padding-left: '.hu_get_option('sidebar-padding').'px; padding-right: '.hu_get_option('sidebar-padding').'px; padding-top: '.hu_get_option('sidebar-padding').'px; }'."\n";
  }
  // primary color
  if ( hu_get_option('color-1') != '#3b8dbd' ) {
	$styles .= '
::selection { background-color: '.hu_get_option('color-1').'; }
::-moz-selection { background-color: '.hu_get_option('color-1').'; }

a,
.themeform label .required,
#flexslider-featured .flex-direction-nav .flex-next:hover,
#flexslider-featured .flex-direction-nav .flex-prev:hover,
.post-hover:hover .post-title a,
.post-title a:hover,
.s1 .post-nav li a:hover i,
.content .post-nav li a:hover i,
.post-related a:hover,
.s1 .widget_rss ul li a,
#footer .widget_rss ul li a,
.s1 .widget_calendar a,
#footer .widget_calendar a,
.s1 .alx-tab .tab-item-category a,
.s1 .alx-posts .post-item-category a,
.s1 .alx-tab li:hover .tab-item-title a,
.s1 .alx-tab li:hover .tab-item-comment a,
.s1 .alx-posts li:hover .post-item-title a,
#footer .alx-tab .tab-item-category a,
#footer .alx-posts .post-item-category a,
#footer .alx-tab li:hover .tab-item-title a,
#footer .alx-tab li:hover .tab-item-comment a,
#footer .alx-posts li:hover .post-item-title a,
.comment-tabs li.active a,
.comment-awaiting-moderation,
.child-menu a:hover,
.child-menu .current_page_item > a,
#bbpress-forums a,
.wp-pagenavi a { color: '.hu_get_option('color-1').'; }

.themeform input[type="submit"],
.themeform button[type="submit"],
.s1 .sidebar-top,
.s1 .sidebar-toggle,
#flexslider-featured .flex-control-nav li a.flex-active,
.post-tags a:hover,
.s1 .widget_calendar caption,
#footer .widget_calendar caption,
.author-bio .bio-avatar:after,
.commentlist li.bypostauthor > .comment-body:after,
.commentlist li.comment-author-admin > .comment-body:after { background-color: '.hu_get_option('color-1').'; }

.post-format .format-container { border-color: '.hu_get_option('color-1').'; }
#bbpress-forums li.bbp-header{ background-color: '.hu_get_option('color-1').'; }

.s1 .alx-tabs-nav li.active a,
#footer .alx-tabs-nav li.active a,
.comment-tabs li.active a,
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current
.bbp-pagination-links a:hover,
.bbp-pagination-links span.current{ border-bottom-color: '.hu_get_option('color-1').'!important; }

	'."\n";
  }
  // secondary color
  if ( hu_get_option('color-2') != '#82b965' ) {
	$styles .= '
.s2 .post-nav li a:hover i,
.s2 .widget_rss ul li a,
.s2 .widget_calendar a,
.s2 .alx-tab .tab-item-category a,
.s2 .alx-posts .post-item-category a,
.s2 .alx-tab li:hover .tab-item-title a,
.s2 .alx-tab li:hover .tab-item-comment a,
.s2 .alx-posts li:hover .post-item-title a { color: '.hu_get_option('color-2').'; }

.s2 .sidebar-top,
.s2 .sidebar-toggle,
.post-comments,
.jp-play-bar,
.jp-volume-bar-value,
.s2 .widget_calendar caption { background-color: '.hu_get_option('color-2').'; }

.s2 .alx-tabs-nav li.active a { border-bottom-color: '.hu_get_option('color-2').'; }
.post-comments span:before { border-right-color: '.hu_get_option('color-2').'; }
	'."\n";
  }
  // topbar color
  if ( hu_get_option('color-topbar') != '#26272b' ) {
	$styles .= '
.search-expand,
#nav-topbar.nav-container { background-color: '.hu_get_option('color-topbar').'; }
@media only screen and (min-width: 720px) {
#nav-topbar .nav ul { background-color: '.hu_get_option('color-topbar').'; }
}
	'."\n";
  }
  // header color
  if ( hu_get_option('color-header') != '#33363b' ) {
	$styles .= '
#header { background-color: '.hu_get_option('color-header').'; }
@media only screen and (min-width: 720px) {
#nav-header .nav ul { background-color: '.hu_get_option('color-header').'; }
}
	'."\n";
  }
  // header menu color
  if ( hu_get_option('color-header-menu') != '' ) {
	$styles .= '
#nav-header.nav-container { background-color: '.hu_get_option('color-header-menu').'; }
@media only screen and (min-width: 720px) {
#nav-header .nav ul { background-color: '.hu_get_option('color-header-menu').'; }
}
	'."\n";
  }
  // footer color
  if ( hu_get_option('color-footer') != '#33363b' ) {
	$styles .= '#footer-bottom { background-color: '.hu_get_option('color-footer').'; }'."\n";
  }
  // header logo max-height
  if ( hu_get_option('logo-max-height') != '60' ) {
	$styles .= '.site-title a img { max-height: '.hu_get_option('logo-max-height').'px; }'."\n";
  }
  // image border radius
  if ( hu_get_option('image-border-radius') != '0' ) {
	$styles .= 'img { -webkit-border-radius: '.hu_get_option('image-border-radius').'px; border-radius: '.hu_get_option('image-border-radius').'px; }'."\n";
  }
  // // body background (old)
  // if ( hu_get_option('body-background') != '#eaeaea' ) {
  //  $styles .= 'body { background-color: '.hu_get_option('body-background').'; }'."\n";
  // }

  // body background (@fromfull) => keep on wp.org
  $body_bg = hu_get_option('body-background');
  if ( ! empty( $body_bg ) ) {
	//for users of wp.org version prior to 3.0+, this option is an hex color string.
	if ( is_string($body_bg) ) {
	  $styles .= 'body { background-color: ' . $body_bg . '; }'."\n";
	} elseif ( is_array($body_bg) && isset($body_bg['background-color']) ) {
	  $styles .= 'body { background-color: '. $body_bg['background-color'] . '; }'."\n";
	}
	// elseif ( is_array($body_bg) ) {
	//   $body_bg = wp_parse_args(
	//     $body_bg,
	//     array(
	//       'background-color'      => "#eaeaea",
	//       'background-image'      => false,
	//       'background-position'   => '',
	//       'background-attachment' => '',
	//       'background-repeat'     => '',
	//       'backgrount-size'       => ''
	//     )
	//   );

	//   $body_color       = $body_bg['background-color'];
	//   $body_image       = $body_bg['background-image'];
	//   $body_position    = $body_bg['background-position'];
	//   $body_attachment  = $body_bg['background-attachment'];
	//   $body_repeat      = $body_bg['background-repeat'];
	//   $body_size        = $body_bg['background-size'];

	//   if ( false !== $body_image && $body_size == "" ) {
	//     $styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; }'."\n";
	//   } elseif ( false !== $body_image && $body_size != "" ) {
	//     $styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; background-size: '.$body_size.'; }'."\n";
	//   } elseif ( '' != $body_color ) {
	//     $styles .= 'body { background-color: '.$body_color.'; }'."\n";
	//   } else {
	//     $styles .= '';
	//   }
	// }




  }

  $styles .= '</style>'."\n";
  // end output

  echo $styles;
}

/**
 * Замена функции из оригинального шаблона
 * Нужна для добавления Noto Sans
 */
function hu_google_fonts () {
	if ( ! hu_is_checked('dynamic-styles') )
	  return;

	if ( hu_get_option( 'font' ) == 'titillium-web-ext' ) { echo '<link href="//fonts.googleapis.com/css?family=Titillium+Web:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'droid-serif' ) { echo '<link href="//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'source-sans-pro' ) { echo '<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,300,400italic,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'lato' ) { echo '<link href="//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'raleway' ) { echo '<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'noto' ) { echo '<link href="=//fonts.googleapis.com/css?family=Noto+Sans:700,400&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'noto-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Noto+Sans:700,400&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'ubuntu' ) { echo '<link href="//fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'ubuntu-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'roboto-condensed' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'roboto-condensed-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'roboto-slab' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Slab:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'roboto-slab-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Slab:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'playfair-display' ) { echo '<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'playfair-display-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700&subset=latin,cyrillic" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'open-sans' ) { echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'open-sans-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'pt-serif' ) { echo '<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
	if ( hu_get_option( 'font' ) == 'pt-serif-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
}

/**
 * Замена функции из оригинального шаблона
 */
function alx_sidebars()	{
    register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebar(array( 'name' => 'Secondary','id' => 'secondary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    if ( hu_get_option('header-ads') == 'on' ) { register_sidebar(array( 'name' => 'Header Ads','id' => 'header-ads', 'description' => "Header ads area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
    if ( hu_get_option('footer-ads') == 'on' ) { register_sidebar(array( 'name' => 'Footer Ads','id' => 'footer-ads', 'description' => "Footer ads area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
    if ( hu_get_option('subpost-ads') == 'on' ) { register_sidebar(array( 'name' => 'Subpost Ads','id' => 'subpost-ads', 'description' => "Ads under posts and before posts navigation", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
    if ( hu_get_option('footer-widgets') >= '1' ) { register_sidebar(array( 'name' => 'Footer 1','id' => 'footer-1', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
    if ( hu_get_option('footer-widgets') >= '2' ) { register_sidebar(array( 'name' => 'Footer 2','id' => 'footer-2', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
    if ( hu_get_option('footer-widgets') >= '3' ) { register_sidebar(array( 'name' => 'Footer 3','id' => 'footer-3', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
    if ( hu_get_option('footer-widgets') >= '4' ) { register_sidebar(array( 'name' => 'Footer 4','id' => 'footer-4', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
}


/**
 * Добавление стилей к визуальному редактору
 */
function arreat_add_editor_styles($content) {
    add_editor_style( 'fonts/font-awesome.min.css');
    add_editor_style( 'editor-style.css' );

    if ( ! is_admin() ) {
        global $editor_styles;
        $editor_styles = (array) $editor_styles;
        $stylesheet    = (array) $stylesheet;
        $stylesheet[] = 'fonts/font-awesome.min.css';
        $stylesheet[] = 'editor-style.css';
        $editor_styles = array_merge( $editor_styles, $stylesheet );
    }
    return $content;
}

/**
 * Замена функции из родительской темы
 * Нужна, чтобы заменить файл scripts.js на новый
 */
function hu_scripts() {
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/front/js/jquery.flexslider.min.js', array( 'jquery' ),'', false );
    wp_enqueue_script( 'jplayer', get_template_directory_uri() . '/assets/front/js/jquery.jplayer.min.js', array( 'jquery' ),'', true );
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ),'', true );
    if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
}

/**
 * Добавляет код в шапку сайта
 * 1. JS-переменная arreatData с нужными для цитирования данными
 */
function arreat_head() {
    global $wp_version;
    $vars = array(
        'wp_version' => intval(substr(str_replace('.', '', $wp_version), 0, 2)),
        'wp_editor' => bbp_use_wp_editor() ? 1 : 0
    );
    echo '<script type="text/javascript">'.
        '/* <![CDATA[ */'.
        'var arreatData = ' . json_encode($vars) .
        '/* ]]> */'.
        '</script>';
}


/**
 * Добавляет html-теги в список разрешенных
 */
function arreat_allowed_tags($list) {
    $list['div'] = array('class' => true);
    $list['p'] = array('style' => true);
    $list['header'] = array();
    return $list;
}

/**
 * Убирает полностью встроенные стили bbpress
 */
function arreat_deregister_bbpress_styles() {
    wp_deregister_style( 'bbp-default' );
}

/**
 * Замена функции из родительской темы
 */
function hu_load() {
    // Load theme languages
    load_theme_textdomain( 'hueman', get_template_directory().'/languages' );

    // Load theme options and meta boxes
    //load_template( get_template_directory() . '/functions/theme-options.php' );
    load_template( get_template_directory() . '/functions/init-meta-boxes.php' );

    // Load custom widgets
    load_template( get_template_directory() . '/functions/widgets/alx-tabs.php' );
    load_template( get_template_directory() . '/functions/widgets/alx-video.php' );
    load_template( get_template_directory() . '/functions/widgets/alx-posts.php' );

    // Load dynamic styles
    load_template( get_template_directory() . '/functions/dynamic-styles.php' );

    load_template( get_stylesheet_directory() . '/functions/functions-bbpress.php' );

    load_template( get_stylesheet_directory() . '/functions/class-utils-settings-map.php' );
}


function clientproof_visual_editor( $mceInit ) {
	$mceInit['paste_as_text'] = true;
	return $mceInit;
}

add_filter('teeny_mce_before_init', 'clientproof_visual_editor');
add_filter('tiny_mce_before_init', 'clientproof_visual_editor');
add_filter('the_editor_content', 'arreat_add_editor_styles');
add_action('wp_head', 'arreat_head');
add_filter('bbp_kses_allowed_tags', 'arreat_allowed_tags');
add_action('wp_print_styles', 'arreat_deregister_bbpress_styles', 15);


