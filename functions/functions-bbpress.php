<?php
/**
 * Functions of bbPress's Default theme
 *
 * @package bbPress
 * @subpackage BBP_Theme_Compat
 * @since bbPress (r3732)
 */

function arreat_get_categories() {

    // Parse arguments with default forum query for most circumstances
    $args = bbp_parse_args( $args, array(
        'post_type'           => bbp_get_forum_post_type(),
        'post_parent'         => 0,
        'post_status'         => bbp_get_public_status_id(),
        'posts_per_page'      => get_option( '_bbp_forums_per_page', 50 ),
        'ignore_sticky_posts' => true,
        'orderby'             => 'menu_order title',
        'order'               => 'ASC'
    ), 'has_forums' );

    return get_posts( $args );
}


/**
 * this function changes the bbp freshness data (time since) into a last post date for forums
 * @return string Formatted date-time
 */
function change_freshness_forum () {

// Verify forum and get last active meta
    $forum_id    = bbp_get_forum_id( $forum_id );
    $last_active = get_post_meta( $forum_id, '_bbp_last_active_time', true );

    if ( empty( $last_active ) ) {
        $reply_id = bbp_get_forum_last_reply_id( $forum_id );
        if ( !empty( $reply_id ) ) {
            $last_active = get_post_field( 'post_date', $reply_id );
        } else {
            $topic_id = bbp_get_forum_last_topic_id( $forum_id );
            if ( !empty( $topic_id ) ) {
                $last_active = bbp_get_topic_last_active_time( $topic_id );
            }
        }
    }

    $last_active = bbp_convert_date( $last_active ) ;
    $date_format = get_option( 'date_format' );
    $time_format = get_option( 'time_format' );
    $date= date_i18n( "{$date_format}", $last_active );
    $time=date_i18n( "{$time_format}", $last_active );
    $active_time = sprintf( _x( '%1$s, %2$s', 'date at time', 'bbp-last-post' ), $date, $time );
    return $active_time ;
}


/**
 * this function changes the bbp freshness data (time since) into a last post date for topics
 */
function change_freshness_topic ($last_active, $topic_id) {

$topic_id = bbp_get_topic_id( $topic_id );

    // Try to get the most accurate freshness time possible
    $last_active = get_post_meta( $topic_id, '_bbp_last_active_time', true );
    if ( empty( $last_active ) ) {
    $reply_id = bbp_get_topic_last_reply_id( $topic_id );
    if ( !empty( $reply_id ) ) {
        $last_active = get_post_field( 'post_date', $reply_id );
    } else {
            $last_active = get_post_field( 'post_date', $topic_id );
        }
    }

    $last_active = bbp_convert_date( $last_active ) ;
    $date_format = get_option( 'date_format' );
    $time_format = get_option( 'time_format' );
    $date= date_i18n( "{$date_format}", $last_active );
    $time=date_i18n( "{$time_format}", $last_active );
    $active_time = sprintf( _x( '%1$s, %2$s', 'date at time', 'bbp-last-post' ), $date, $time );
    return $active_time ;
}

/**
 * This function changes the heading "Freshness" to the name created in Settings>bbp last post
 */
function change_translate_text( $translated_text ) {
    $text = 'Freshness' ;
    if ( $translated_text == $text ) {
        global $rlp_options;
        $translated_text = $rlp_options['heading_label'];
    }
    return $translated_text;
}

/**
 * Убирает ссылку на главную страницу из ббпрессовых хлебных крошек
 */
function arreat_remove_home_crumb($crumbs) {
    return array_slice($crumbs, 1);
}

add_filter('gettext', 'change_translate_text', 20);
add_filter('bbp_get_forum_last_active', 'change_freshness_forum', 10, 2);
add_filter('bbp_get_topic_last_active', 'change_freshness_topic', 10, 2);
add_filter('bbp_breadcrumbs', 'arreat_remove_home_crumb');
