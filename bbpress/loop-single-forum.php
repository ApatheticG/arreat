<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

    <li class="bbp-forum-info">

        <?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

            <span class="bbp-row-actions">

                <?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>
                <?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>
                <?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

            </span>

        <?php endif; ?>

        <?php do_action( 'bbp_theme_before_forum_title' ); ?>
        <a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>
        <?php do_action( 'bbp_theme_after_forum_title' ); ?>

        <?php do_action( 'bbp_theme_before_forum_description' ); ?>
        <div class="bbp-forum-content"><?php bbp_forum_content(); ?></div>
        <?php do_action( 'bbp_theme_after_forum_description' ); ?>

        <?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>
        <?php bbp_list_forums(array('show_topic_count' => false, 'show_reply_count' => false)); ?>
        <?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

        <?php bbp_forum_row_actions(); ?>

    </li>

    <li class="bbp-forum-topic-count"><?php bbp_forum_topic_count(); ?></li>

    <li class="bbp-forum-freshness">

        <strong><a href="<?php bbp_forum_last_topic_permalink(); ?>" title="<?php bbp_forum_last_topic_title(); ?>"><?php bbp_forum_last_topic_title(); ?></a></strong>

        <p class="bbp-topic-meta">

            <?php do_action( 'bbp_theme_before_topic_author' ); ?>
            <span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 14 ) ); ?></span>
            <?php do_action( 'bbp_theme_after_topic_author' ); ?>

            <?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
            <?php bbp_forum_freshness_link(); ?>
            <?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>

        </p>
    </li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
