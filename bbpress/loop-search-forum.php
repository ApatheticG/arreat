<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bbp-forum-header">

	<div class="bbp-forum-title">
		<?php do_action( 'bbp_theme_before_forum_title' ); ?>
		<div><?php _e( 'Forum: ', 'bbpress' ); ?> <strong><a href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></strong></div>
		<?php do_action( 'bbp_theme_after_forum_title' ); ?>
	</div><!-- .bbp-forum-title -->

	<div class="bbp-meta">
		<span class="bbp-forum-post-date"><?php printf( __( 'Last updated %s', 'bbpress' ), bbp_get_forum_last_active_time() ); ?></span>
	</div><!-- .bbp-meta -->


</div><!-- .bbp-forum-header -->

<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<div class="bbp-forum-content entry">
		<?php do_action( 'bbp_theme_before_forum_content' ); ?>
        <p><?php bbp_forum_content(); ?></p>
		<?php do_action( 'bbp_theme_after_forum_content' ); ?>
	</div><!-- .bbp-forum-content -->

</div><!-- #post-<?php bbp_forum_id(); ?> -->
