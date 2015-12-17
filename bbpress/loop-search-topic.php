<?php

/**
 * Search Loop - Single Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bbp-topic-header">

    <div class="bbp-topic-title">

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>
            <?php _e( 'Topic: ', 'bbpress' ); ?>
		    <strong><a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></strong> <span class="bbp-topic-title-meta">

                <?php if ( function_exists( 'bbp_is_forum_group_forum' ) && bbp_is_forum_group_forum( bbp_get_topic_forum_id() ) ) : ?>

                    <?php _e( 'in group forum ', 'bbpress' ); ?>

                <?php else : ?>

                    <?php _e( 'in forum ', 'bbpress' ); ?>

                <?php endif; ?>

                <strong><a href="<?php bbp_forum_permalink( bbp_get_topic_forum_id() ); ?>"><?php bbp_forum_title( bbp_get_topic_forum_id() ); ?></a></strong>

            </span><!-- .bbp-topic-title-meta -->
		<?php do_action( 'bbp_theme_after_topic_title' ); ?>


	</div><!-- .bbp-topic-title -->

</div><!-- .bbp-topic-header -->

<div id="post-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<div class="bbp-topic-author">

		<?php do_action( 'bbp_theme_before_topic_author_details' ); ?>
		<a href="<?php bbp_topic_author_url(bbp_get_topic_id()); ?>">
		    <?php bbp_topic_author_avatar(bbp_get_topic_id()); ?>
        </a>
        <div class="bbp-reply-author-role">
            <?php bbp_topic_author_role(array('topic_id' => bbp_get_topic_id())); ?>
        </div>
		<?php do_action( 'bbp_theme_after_topic_author_details' ); ?>


	</div><!-- .bbp-topic-author -->

	<div class="bbp-topic-content entry">

        <div class="bbp-reply-header">

            <span class="bbp-reply-author-name">
                <a href="<?php bbp_reply_author_url(bbp_get_reply_id()); ?>">
                    <?php bbp_reply_author_display_name(bbp_get_reply_id()); ?>
                </a>
            </span>

            <?php if ( bbp_is_user_keymaster() ) : ?>
                <?php do_action( 'bbp_theme_before_topic_author_admin_details' ); ?>
                <span class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_topic_id() ); ?></span>
                <?php do_action( 'bbp_theme_after_topic_author_admin_details' ); ?>
            <?php endif; ?>

            <span class="bbp-reply-date">
                <a href="<?php bbp_topic_permalink(); ?>" class="bbp-reply-link">
                <?php bbp_topic_post_date( bbp_get_topic_id() ); ?>
                </a>
            </span>
        </div>

		<?php do_action( 'bbp_theme_before_topic_content' ); ?>
		<?php bbp_topic_content(); ?>
		<?php do_action( 'bbp_theme_after_topic_content' ); ?>

	</div><!-- .bbp-topic-content -->

</div><!-- #post-<?php bbp_topic_id(); ?> -->
