<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<form method="get" class="searchform themeform" action="<?php bbp_search_url(); ?>">
	<div>
	    <input type="hidden" name="action" value="bbp-search-request" />
		<input type="text" class="search" name="bbp_search" onblur="if(this.value=='')this.value='Поиск по форуму';" onfocus="if(this.value=='Поиск по форуму')this.value='';" value="Поиск по форуму" />
	</div>
</form>
