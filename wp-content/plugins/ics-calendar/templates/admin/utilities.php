<h3 class="hndle"><?php _e('Utilities', 'r34ics'); ?></h3>

<div class="inside">

	<form id="r34ics-purge-calendar-transients" method="post" action="">
		<?php
		wp_nonce_field('r34ics','r34ics-purge-calendar-transients-nonce');
		?>
		<input type="submit" class="button" value="<?php echo esc_attr(__('Clear Cached Calendar Data', 'r34ics')); ?>" />
		<p><?php _e('This will immediately clear all existing cached calendar data (purge transients), forcing WordPress to reload all calendars the next time they are viewed. Caching will then resume as before.', 'r34ics'); ?></p>
	</form>

</div>
