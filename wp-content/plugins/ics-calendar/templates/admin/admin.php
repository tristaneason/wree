<?php
global $R34ICS;
?>

<div class="wrap r34ics">

	<h2><?php echo get_admin_page_title(); ?></h2>
	
	<div class="metabox-holder columns-2">
	
		<div class="column-1">
				
			<div class="postbox" id="basic-example">

				<h3 class="hndle"><span><?php _e('Basic Shortcode Example', 'r34ics'); ?></span></h3>
	
				<div class="inside">

					<p><?php _e('To insert an ICS calendar in a page, use the following shortcode format, replacing the all-caps text with your feed URL. Many additional customization options are available. Please see the User Guide for details.', 'r34ics'); ?></p>

					<p><input type="text" name="null" readonly="readonly" value="[ics_calendar url=&quot;CALENDAR_FEED_URL&quot;]" style="width: 97%; background: white;" onclick="this.select();" /></p>
			
				</div>
		
			</div>

			<div class="postbox" id="utilities">

				<?php
				include_once(plugin_dir_path(__FILE__) . 'utilities.php');
				?>

			</div>

			<div class="postbox" id="system-report">

				<h3 class="hndle"><?php _e('System Report', 'r34ics'); ?></h3>
	
				<div class="inside">
			
					<p><?php _e('Please copy the following text and include it in your message when emailing support.', 'r34ics'); ?><br />
					<strong style="color: red;"><?php _e('Also please include the ICS Calendar shortcode exactly as you have it entered on the affected page.', 'r34ics'); ?></strong></p>
					
					<textarea class="diagnostics-window" style="cursor: copy;" onclick="this.select(); document.execCommand('copy');"><?php r34ics_system_report(); ?></textarea>
			
				</div>

			</div>

		</div>
	
		<div class="column-2">

			<?php
			include_once(plugin_dir_path(__FILE__) . 'sidebar.php');
			?>
	
		</div>
	
	</div>

</div>