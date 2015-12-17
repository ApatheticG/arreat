<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div <?php bbp_reply_class(); ?> id="post-<?php bbp_reply_id(); ?>">

    <div class="bbp-reply-author">

        <?php do_action( 'bbp_theme_before_reply_author_details' ); ?>
        <a href="<?php bbp_reply_author_url(bbp_get_reply_id()); ?>">
            <?php bbp_reply_author_avatar(bbp_get_reply_id()); ?>
        </a>
        <div class="bbp-reply-author-role">
            <?php bbp_reply_author_role(array('reply_id' => bbp_get_reply_id())); ?>
        </div>
        <?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

    </div><!-- .bbp-reply-author -->

    <div class="bbp-reply-content entry">

        <div class="bbp-reply-header">

            <span class="bbp-reply-author-name">
                <a href="<?php bbp_reply_author_url(bbp_get_reply_id()); ?>">
                    <?php bbp_reply_author_display_name(bbp_get_reply_id()); ?>
                </a>
            </span>

            <?php if ( bbp_is_user_keymaster() ) : ?>
                <?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>
                <span class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></span>
                <?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>
            <?php endif; ?>

            <span class="bbp-reply-date">
                <a href="<?php bbp_reply_url(); ?>" class="bbp-reply-link">
                    <?php bbp_reply_post_date(); ?>
                </a>

                <?php if ( bbp_is_single_user_replies() ) : ?>
                    <?php _e( 'in reply to: ', 'bbpress' ); ?>
                    <a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
                <?php endif; ?>
            </span>

        </div>

        <div class="bbp-reply-content-inner" id="content-<?php bbp_reply_id(); ?>">
            <?php do_action( 'bbp_theme_before_reply_content' ); ?>
            <?php bbp_reply_content(); ?>
            <?php do_action( 'bbp_theme_after_reply_content' ); ?>
        </div>

        <div class="bbp-reply-footer">
            <?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>
            <?php
                $reply_sep = '&nbsp;&nbsp;-&nbsp;&nbsp;';
                $reply_data = 'data-id="#content-' . bbp_get_reply_id() . '" data-url="' . bbp_get_reply_url() . '" data-author="' . bbp_get_reply_author_display_name(bbp_get_reply_id()) . '"';
                $reply_link = is_user_logged_in() ? $reply_sep . '<a class="js-reply" href="#new-post" ' . $reply_data . '>Цитата</a>' : '';

                bbp_reply_admin_links(array(
                        'sep' => $reply_sep,
                        'after'  => $reply_link . '</span>'
                ));
                ?>
            <?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
        </div>


    </div><!-- .bbp-reply-content -->

</div><!-- .reply --><!-- #post-<?php bbp_reply_id(); ?> -->
