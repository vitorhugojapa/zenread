<!-- search form -->
<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label for="s" class="assistive-text"><?php echo _e('search', 'zen-read'); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php _e('type here', 'zen-read'); ?>" tabindex="1" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php _e('search','zen-read'); ?>" tabindex="2" />
</form>