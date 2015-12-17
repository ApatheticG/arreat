<?php

/**
 * Search Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bbp-search-reply-header">

	<div class="bbp-reply-title">

		<div>
            <?php _e( 'In reply to: ', 'bbpress' ); ?>
            <strong><a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a></strong>
        </div>

	</div><!-- .bbp-reply-title -->

</div><!-- .bbp-reply-header -->

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

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>
		<?php bbp_reply_content(); ?>
		<?php do_action( 'bbp_theme_after_reply_content' ); ?>


	</div><!-- .bbp-reply-content -->

</div><!-- .reply --><!-- #post-<?php bbp_reply_id(); ?> -->
