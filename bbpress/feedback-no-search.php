<?php

/**
 * No Search Results Feedback Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div class="notebox">
    <?php _e( 'Oh bother! No search results were found here!', 'bbpress' ); ?>
    <?php if ( !have_posts() ): ?>
        <?php _e('Please try another search:','hueman'); ?>
    <?php endif; ?>
    <div class="search-again">
        <?php bbp_get_template_part( 'form', 'search' ); ?>
    </div>
</div>
