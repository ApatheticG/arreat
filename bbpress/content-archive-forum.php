<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">

    <?php bbp_forum_subscription_link(); ?>

    <?php do_action( 'bbp_template_before_forums_index' ); ?>

    <?php
        $arr_top = arreat_get_categories();
        if (empty($arr_top)) {
            bbp_get_template_part( 'feedback', 'no-forums' );
        }
    ?>
    <?php
        foreach($arr_top as $arr_forum) {
            if ( bbp_has_forums([
                'post_parent' => $arr_forum->ID
            ]) ) {
                include 'loop-forums.php';
            }
        }
    ?>

    <?php do_action( 'bbp_template_after_forums_index' ); ?>

</div>
