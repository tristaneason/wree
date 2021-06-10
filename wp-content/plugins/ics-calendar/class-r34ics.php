<?php

// Don't load directly
if (!defined('ABSPATH')) { exit; }

class R34ICS {

	public $version = '7.6.0';

	public $colors = array(
		'white' => '#ffffff',		// rgb(255,255,255)
		'whitesmoke' => '#f5f5f5',	// rgb(245,245,245)
		'gainsboro' => '#dcdcdc',	// rgb(220,220,220)
		'darkgray' => '#a9a9a9', 	// rgb(169,169,169)
		'gray' => '#808080',		// rgb(128,128,128)
		'black' => '#000000',		// rgb(0,0,0)
	);

	public $debug = false;
	public $debug_messages = array();

	public $icon_logo = 'data:image/svg+xml;base64,PHN2ZyBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLW1pdGVybGltaXQ9IjIiIHZpZXdCb3g9IjAgMCAzNTUgNDAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0zMTQuMjY5IDM5OS44NTVoLTI3My44MDljLTIyLjMzIDAtNDAuNDYtMTguMTI5LTQwLjQ2LTQwLjQ1OXYtMjczLjgxYzAtMjIuMzMgMTguMTI5LTQwLjQ1OSA0MC40Ni00MC40NmgzOC4yODVjLS4xNjgtLjgxNS0uMjU3LTEuNjU5LS4yNTctMi41MjR2LTMwLjE2NGMwLTYuODY1IDUuNTczLTEyLjQzOCAxMi40MzgtMTIuNDM4aDI0Ljg3N2M2Ljg2NSAwIDEyLjQzOCA1LjU3MyAxMi40MzggMTIuNDM4djMwLjE2NGMwIC44NjUtLjA4OSAxLjcwOS0uMjU3IDIuNTI0aDk5LjU1NWMtLjE2OC0uODE1LS4yNTctMS42NTktLjI1Ny0yLjUyNHYtMzAuMTY0YzAtNi44NjUgNS41NzQtMTIuNDM4IDEyLjQzOS0xMi40MzhoMjQuODc2YzYuODY1IDAgMTIuNDM4IDUuNTczIDEyLjQzOCAxMi40Mzh2MzAuMTY0YzAgLjg2My0uMDg4IDEuNzA1LS4yNTcgMi41MjRoMzcuNDkxYzIyLjMzNC4wMDQgNDAuNDYgMTguMTMyIDQwLjQ2IDQwLjQ2djI3My44MWMwIDIyLjMyOC0xOC4xMjYgNDAuNDU2LTQwLjQ2IDQwLjQ1OXptOS4yNjktMjc0LjE4OWgtMjkyLjM0N3YyNDEuMTUyaDI5Mi4zNDd6bS0xNDcuMzE2IDIxNC4yOTZjLTIuMDM0LS4yNDQtNC4wMDQtMS4xNDUtNS41NjQtMi43MDVsLTY2LjMzMy02Ni4zMzRjLTMuNjk3LTMuNjk2LTMuNjk3LTkuNjk5IDAtMTMuMzk1bDEzLjM5NS0xMy4zOTZjMy42OTctMy42OTYgOS42OTktMy42OTYgMTMuMzk1IDBsNDYuMjUxIDQ2LjI1MSA0Ni4yNDgtNDYuMjQ4YzMuNjk2LTMuNjk3IDkuNjk5LTMuNjk3IDEzLjM5NSAwbDEzLjM5NiAxMy4zOTVjMy42OTYgMy42OTcgMy42OTYgOS42OTkgMCAxMy4zOTZsLTY2LjMzNCA2Ni4zMzNjLTIuMTQxIDIuMTQxLTUuMDU2IDMuMDQyLTcuODQ5IDIuNzAzem0wLTg2LjUxOGMtMi4wMzQtLjI0My00LjAwNC0xLjE0NS01LjU2NC0yLjcwNWwtNjYuMzMzLTY2LjMzM2MtMy42OTctMy42OTctMy42OTctOS42OTkgMC0xMy4zOTZsMTMuMzk1LTEzLjM5NWMzLjY5Ny0zLjY5NiA5LjY5OS0zLjY5NiAxMy4zOTUgMGw0Ni4yNTEgNDYuMjUgNDYuMjQ4LTQ2LjI0OGMzLjY5Ni0zLjY5NiA5LjY5OS0zLjY5NiAxMy4zOTUgMGwxMy4zOTYgMTMuMzk2YzMuNjk2IDMuNjk2IDMuNjk2IDkuNjk5IDAgMTMuMzk1bC02Ni4zMzQgNjYuMzM0Yy0yLjE0MSAyLjE0MS01LjA1NiAzLjA0Mi03Ljg0OSAyLjcwMnoiIGZpbGw9IiNmZmYiLz48L3N2Zz4=';
	
	public $limit_days = 365;
	public $tz = null;
	
	protected $ical_path = '/vendors/ics-parser/src/ICal/ICal.php';
	protected $event_path = '/vendors/ics-parser/src/ICal/Event.php';
	protected $pand_path = '/vendors/persist-admin-notices-dismissal/persist-admin-notices-dismissal.php';
	protected $parser_loaded = false;

	protected $shortcode_defaults = array(
		'attach' => null,
		'color' => null,
		'columnlabels' => null,
		'count' => null,
		'currentweek' => false,
		'customoptions' => null,
		'debug' => false,
		'description' => null,
		'eventdesc' => false,
		'extendmultiday' => false,
		'feedlabel' => null,
		'format' => null,
		'formatmonthyear' => 'F Y',
		'hidealldayindicator' => false,
		'hiderecurrence' => null,
		'hidetimes' => false,
		'legendinline' => false,
		'legendposition' => null,
		'legendstyle' => null,
		'limitdays' => null,
		'limitdayscustom' => false,
		'linebreakfix' => false,
		'linktitles' => false,
		'location' => false,
		'maskinfo' => false,
		'method' => null,
		'monthnav' => null,
		'nolink' => false,
		'nomobile' => false,
		'organizer' => false,
		'pastdays' => null,
		'reload' => false,
		'showendtimes' => false,
		'skip' => null,
		'skiprecurrence' => false,
		'startdate' => null,
		'title' => null,
		'toggle' => false,
		'tz' => null,
		'url' => null,
		'view' => 'month',
	);
	

	public function __construct() {
	
		// Set base timezone for wp_date() functions in templates
		$this->tz = new DateTimeZone(get_option('timezone_string') ? get_option('timezone_string') : 'UTC');

		// Set property values
		$this->ical_path = plugin_dir_path(__FILE__) . $this->ical_path;
		$this->event_path = plugin_dir_path(__FILE__) . $this->event_path;
		$this->pand_path = plugin_dir_path(__FILE__) . $this->pand_path;
		
		// WP settings
		add_action('init', array(&$this, 'wp_settings'));

		// Set up admin menu
		add_action('admin_menu', array(&$this, 'admin_menu'));
		
		// Enqueue admin scripts
		add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));

		// Enqueue scripts
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));

		// Add ICS shortcode
		add_shortcode('ics_calendar', array(&$this, 'shortcode'));

		// Add editor button
		add_action('admin_init', array(&$this, 'editor_button'));

		// Add admin notices and persistent dismissal
		add_action('admin_notices', array(&$this, 'admin_notices'));
		add_action('admin_init', array(&$this, 'admin_notices_persist_dismissals'));

	}
	
	
	public function admin_enqueue_scripts() {
		wp_enqueue_script('ics-calendar-admin', plugin_dir_url(__FILE__) . 'assets/admin-script.js', array('jquery'));
		wp_enqueue_style('ics-calendar-admin', plugin_dir_url(__FILE__) . 'assets/admin-style.css', false, $this->version);
	}


	public function admin_menu() {
		if (!post_type_exists('r34icspro_calendar')) {
			add_menu_page(
				'ICS Calendar',
				'ICS Calendar',
				'edit_posts',
				'ics-calendar',
				array(&$this, 'admin_page'),
				$this->icon_logo,
				49
			);
		}
	}


	public function admin_notices() {
		$current_screen = get_current_screen();

		// Dashboard-only notices for administrator-level users
		if (current_user_can('manage_options') && $current_screen->base == 'dashboard') {

			// Require allow_url_fopen
			if (!r34ics_url_open_allowed()) {
				?>
				<div class="notice notice-error" style="background-image: url('<?php echo plugin_dir_url(__FILE__); ?>assets/ics-calendar-icon.svg'); background-position: left 1em top 1em; background-repeat: no-repeat; background-size: 4em; min-height: 6em; padding-left: 6em;">
					<p><?php printf(__('The %sICS Calendar%s plugin requires either the PHP cURL extensions, or the %s PHP setting to be turned on. Please update the settings in your %s file or contact your hosting provider for assistance.', 'r34ics'), '<strong>', '</strong>', '<code>allow_url_fopen</code>', '<code>php.ini</code>'); ?></p>
				</div>
				<?php
			}
		
			// Warning about UTC-based timezones
			if (empty(get_option('timezone_string')) || strpos(get_option('timezone_string'), 'UTC') === 0) {
				?>
				<div class="notice notice-warning" style="background-image: url('<?php echo plugin_dir_url(__FILE__); ?>assets/ics-calendar-icon.svg'); background-position: left 1em top 1em; background-repeat: no-repeat; background-size: 4em; min-height: 6em; padding-left: 6em;">
					<p><strong><?php _e('Your site is currently using a UTC offset-based timezone setting.', 'r34ics'); ?></strong> <?php printf(__('This can produce time display errors in the %s plugin in locations that observe Daylight Saving Time.', 'r34ics'), '<strong>ICS Calendar</strong>'); ?></p>
					<p><?php printf(__('Please %schange your timezone setting%s to the city nearest your location, in the same timezone, for proper time display.', 'r34ics'), '<a href="' . admin_url('options-general.php#timezone_string') . '">', '</a>'); ?></p>
					<p><?php printf(__('See the %sPHP documentation%s for additional information on this issue.', 'r34ics'), '<a href="https://www.php.net/manual/en/timezones.others.php" target="_blank">', '</a>'); ?></p>
				</div>
				<?php
			}

		}

	}
	
	
	public function admin_notices_persist_dismissals() {
		$this->_load_pand();
		if (class_exists('PAnD')) {
			PAnD::init();
		}
	}


	public function admin_page() {
	
		// Run utilities if applicable
		if (isset($_POST['r34ics-purge-calendar-transients-nonce']) && wp_verify_nonce($_POST['r34ics-purge-calendar-transients-nonce'],'r34ics')) {
			// Remember, there are *two* DB records for each transient, so we'll divide by 2 when we count these!
			$cleared = r34ics_purge_calendar_transients();
			if ($cleared > 0) {
				?>
				<div class="notice notice-success">
					<p><?php printf(__('Cleared %s cached calendar(s).', 'r34ics'), ceil($cleared / 2)); ?></p>
				</div>
				<?php
			}
			else {
				?>
				<div class="notice notice-warning">
					<p><?php _e('No cached calendars were found.', 'r34ics'); ?></p>
				</div>
				<?php
			}
		}
		
		// Render template
		include(plugin_dir_path(__FILE__) . 'templates/admin/admin.php');

	}
	

	public function color_key_html($args, $ics_data) {
		if (!empty($args['legendstyle']) && $args['legendstyle'] == 'none') { return null; }
		ob_start();
		if (count((array)$ics_data['feed_titles']) > 1) {
			?>
			<div class="ics-calendar-color-key<?php if (!empty($args['legendstyle']) && $args['legendstyle'] == 'inline') { echo ' inline'; } ?>">
				<?php
				if (count($ics_data['feed_titles']) > 4) {
					$toggle_all_guid = r34ics_guid();
					?>
					<div class="ics-calendar-color-key-header">
						<label for="<?php echo esc_attr($toggle_all_guid); ?>"><input type="checkbox" id="<?php echo esc_attr($toggle_all_guid); ?>" class="ics-calendar-color-key-toggle-all" data-feed-key="ALL" checked="checked" />
						<?php _e('Show/hide all', 'r34ics'); ?>
						</label>
					</div>
					<?php
				}
				foreach ((array)$ics_data['feed_titles'] as $feed_key => $feed_title) {
					$toggle_guid = r34ics_guid();
					?>
					<div class="ics-calendar-color-key-item" data-feed-key="<?php echo intval($feed_key); ?>" data-feed-color="<?php echo !empty($ics_data['colors'][$feed_key]['base']) ? esc_attr($ics_data['colors'][$feed_key]['base']) : ''; ?>">
						<label for="<?php echo esc_attr($toggle_guid); ?>"><input type="checkbox" id="<?php echo esc_attr($toggle_guid); ?>" class="ics-calendar-color-key-toggle" data-feed-key="<?php echo intval($feed_key); ?>" data-feed-color="<?php echo !empty($ics_data['colors'][$feed_key]['base']) ? esc_attr($ics_data['colors'][$feed_key]['base']) : ''; ?>" checked="checked" />
						<?php
						echo $feed_title;
						do_action('r34ics_color_key_html_after_feed_title', $feed_key, $args, $ics_data);
						?>
						</label>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		$color_key_content = ob_get_clean();
		return !r34ics_empty_content($color_key_content) ? $color_key_content : null;
	}


	public function days_of_week($format=null) {
		global $wp_locale;
		$days_of_week = array();
		// Do not abbreviate day names in Arabic (WP_Locale::get_weekday_initial() translations are apparently incorrect)
		if (get_locale() == 'ar' || get_locale() == 'ary') {
			$days_of_week = array(
				0 => $wp_locale->get_weekday(0),
				1 => $wp_locale->get_weekday(1),
				2 => $wp_locale->get_weekday(2),
				3 => $wp_locale->get_weekday(3),
				4 => $wp_locale->get_weekday(4),
				5 => $wp_locale->get_weekday(5),
				6 => $wp_locale->get_weekday(6),
			);
		}
		// Default handling for all other languages
		else {
			switch ($format) {
				case 'min':
					$days_of_week = array(
						0 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(0)),
						1 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(1)),
						2 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(2)),
						3 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(3)),
						4 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(4)),
						5 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(5)),
						6 => $wp_locale->get_weekday_initial($wp_locale->get_weekday(6)),
					);
					break;
				case 'short':
					$days_of_week = array(
						0 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(0)),
						1 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(1)),
						2 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(2)),
						3 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(3)),
						4 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(4)),
						5 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(5)),
						6 => $wp_locale->get_weekday_abbrev($wp_locale->get_weekday(6)),
					);
					break;
				case 'full':
				default:
					$days_of_week = array(
						0 => $wp_locale->get_weekday(0),
						1 => $wp_locale->get_weekday(1),
						2 => $wp_locale->get_weekday(2),
						3 => $wp_locale->get_weekday(3),
						4 => $wp_locale->get_weekday(4),
						5 => $wp_locale->get_weekday(5),
						6 => $wp_locale->get_weekday(6),
					);
					break;
			}
		}
		return $days_of_week;
	}


	public function display_calendar($args) {
		extract(array_merge($this->shortcode_defaults, $args));
		
		// Reset debug messages for this call
		$this->debug = $debug;
		if ($this->debug) { $this->debug_messages = array('args' => $args); }
		
		// Get ICS data, from transient if possible
		$loaded_from_transient = null;
		$transient_name = __METHOD__ . '_' . sha1($url . serialize($args));
		$ics_data = null;
		if (empty($reload)) {
			$loaded_from_transient = true;
			$ics_data = get_transient($transient_name);
			if ($this->debug) {
				$this->debug_messages['Loaded from transient'] = size_format(strlen(serialize($ics_data)), 2);
			}
		}

		// No transient ICS data; retrieve ICS file from server
		if (empty($ics_data)) {
			$loaded_from_transient = false;
			$ics_data = array();
	
			// Convert URL into array and iterate
			$ics_data['events'] = array();
			$ics_data['urls'] = r34ics_space_pipe_explode($url);
			$ics_data['tz'] = !empty($tz) ? r34ics_space_pipe_explode($tz) : get_option('timezone_string');
			
			// Set general calendar information
			$ics_data['guid'] = r34ics_guid();
			$ics_data['title'] = isset($title)
				? (!r34ics_boolean_check($title) ? null : $title)
				: null;
			$ics_data['description'] = isset($description)
				? (!r34ics_boolean_check($description) ? null : $description)
				: null;

			// Set colors and feed titles for color key
			$ics_data['colors'] = apply_filters('r34ics_display_calendar_color_set', (!empty($color) ? r34ics_color_set(r34ics_space_pipe_explode($color)) : null), $args);
			$ics_data['feed_titles'] = !empty($feedlabel) ? explode('|', $feedlabel) : array();
			
			foreach ((array)$ics_data['urls'] as $feed_key => $url) {
			
				// Get timezone for this feed
				$url_tz = r34ics_get_feed_tz($ics_data, $feed_key);
		
				// Fix URL protocol
				// (This may not always work, but it will in many cases, and this protocol would *definitely* not work otherwise!)
				if (strpos($url,'webcal://') === 0) {
					$url = str_replace('webcal://','https://',$url);
				}

				// Get ICS file contents
				$ics_contents = r34ics_url_get_contents($url, $method);
		
				// No ICS data present -- throw error and move on to the next feed
				if (empty($ics_contents)) {
					trigger_error(__('ICS file could not be retrieved or was empty. Please verify URL is correct, and check your php.ini configuration to verify either cURL or allow_url_fopen is available. If you are using spaces to delimit multiple URLs, you may also wish to try using the pipe character instead. Affected URL:','r34ics') . ' ' . $url, E_USER_NOTICE);
					continue;
				}
								
				// Fix issue with hard line breaks inside DESCRIPTION fields (not included in the documentation because problem needs further research)
				if (!empty($linebreakfix)) {
					$ics_contents = r34ics_line_break_fix($ics_contents);
				}
				
				// Determine start and end dates for range (these can be rough -- it's just to limit excessive unnecessary parsing)
				// As of v. 7.1.0 we're adding a month to $range_start to accommodate multi-day events that may begin out of range
				if ((!empty($startdate) && intval($startdate) > 20000000)) {
					$range_start = r34ics_date('Y/m/d', $startdate, $url_tz, '-30 days');
					$range_end = r34ics_date('Y/m/d', $startdate, $url_tz, '+' . intval($limitdays+7) . ' days');
				}
				else {
					if (!empty($pastdays)) {
						$range_start = r34ics_date('Y/m/d', null, $url_tz, '-' . intval($pastdays+30) . ' days');
					}
					else {
						$range_start = r34ics_date('Y/m/d', null, $url_tz, '-' . intval(wp_date('j')+30) . ' days');
					}
					// Extend by "limitdays" + one week past current date
					$range_end = r34ics_date('Y/m/d', null, $url_tz, '+' . intval($limitdays+7) . ' days');
				}
				// Additional filtering of range dates
				$range_start = apply_filters('r34ics_display_calendar_range_start', $range_start, $args);
				$range_end = apply_filters('r34ics_display_calendar_range_end', $range_end, $args);
				
				// Filter to allow external pre-processing of raw feed contents before parsing
				$ics_contents = apply_filters('r34ics_display_calendar_preprocess_raw_feed', $ics_contents, $range_start, $range_end, $args);

				// Get day counts for ICS Parser's range filters
				$now_dtm = new DateTime();
				$filter_days_after = $now_dtm->diff(new DateTime($range_end))->format('%a');
				$filter_days_before = $now_dtm->diff(new DateTime($range_start))->format('%a');
				
				// Parse ICS contents
				if (!$this->parser_loaded) {
					$this->parser_loaded = $this->_load_parser();
				}
				$ICal = new ICal\ICal('ICal.ics', array(
					'defaultSpan'					=> !empty($limit_days) ? intval(ceil($limit_days / 365)) : 1,
					'defaultTimeZone'				=> $url_tz->getName(),
					'disableCharacterReplacement'	=> true,
					'filterDaysAfter'				=> $filter_days_after,
					'filterDaysBefore'				=> $filter_days_before,
					'replaceWindowsTimeZoneIds'		=> true,
					'skipRecurrence'				=> $skiprecurrence,
				));
				$ICal->initString($ics_contents);

				// Update general calendar information
				if (empty($ics_data['title']) && r34ics_boolean_check($title) !== false) { $ics_data['title'] = $ICal->calendarName(); }
				if (empty($ics_data['description']) && r34ics_boolean_check($description) !== false) { $ics_data['description'] = $ICal->calendarDescription(); }
				$ics_data['timezone'][$url] = $ICal->calendarTimeZone();
				if (is_array($ics_data['feed_titles']) && empty($ics_data['feed_titles'][$feed_key])) { $ics_data['feed_titles'][$feed_key] = $ICal->calendarName(); }
				
				// Debugging information
				if ($this->debug) {
					$this->debug_messages[$url]['Calendar name'] = $ICal->calendarName();
					$this->debug_messages[$url]['Calendar description'] = $ICal->calendarDescription();
					$this->debug_messages[$url]['Calendar time zone'] = $ICal->calendarTimeZone();
					$this->debug_messages[$url]['Default time zone'] = $url_tz->getName();
					$this->debug_messages[$url]['Parsed date range'] = $range_start . ' to ' . $range_end;
					$this->debug_messages[$url]['Filter days after'] = $filter_days_after;
					$this->debug_messages[$url]['Filter days before'] = $filter_days_before;
					if ($ICal->hasEvents() == false) {
						$this->debug_messages[$url]['Errors'][] = 'Calendar contains no events.';
					}
					if ($this->debug >= 2) {
						$current_memory_usage = memory_get_usage();
						if (!isset($this->debug_messages['Peak memory usage']) || $current_memory_usage > $this->debug_messages['Peak memory usage']) {
							$this->debug_messages['Peak memory usage'] = memory_get_usage();
						}
					}
				}

				// Process events
				if ($ICal->hasEvents() && $ics_events = $ICal->eventsFromRange($range_start,$range_end)) {
				
					// Assemble events
					foreach ((array)$ics_events as $event_key => $event) {
						
						// Allow external filtering of events
						$exclude_event = apply_filters('r34ics_display_calendar_exclude_event', false, $event, $args);
						if (!empty($exclude_event)) { continue; }
						
						// Set start and end dates for event
						$dtstart_date = wp_date('Ymd', $event->dtstart_array[2], $url_tz);
						// Conditional is for events that are missing DTEND altogether, which should never be the case but has been observed in customer support
						$dtend_date = wp_date('Ymd', (!isset($event->dtend_array[2]) ? $event->dtstart_array[2] : $event->dtend_array[2]), $url_tz);

						// All-day events
						if (strlen($event->dtstart) == 8 || (strpos($event->dtstart, 'T000000') !== false && strpos($event->dtend, 'T000000') !== false)) {
							$dtstart_time = null;
							$dtend_time = null;
							$all_day = true;
						}
						// Start/end times
						else {
							$dtstart_time = wp_date('His', $event->dtstart_array[2], $url_tz);
							// Conditional is for events that are missing DTEND altogether, which should never be the case but has been observed in customer support
							$dtend_time = wp_date('His', (!isset($event->dtend_array[2]) ? $event->dtstart_array[2] : $event->dtend_array[2]), $url_tz);
							$all_day = false;
						}
						
						// Workaround for events in feeds that do not contain an end date/time
						if (empty($dtend_date)) { $dtend_date = isset($dtstart_date) ? $dtstart_date : null; }
						if (empty($dtend_time)) { $dtend_time = isset($dtstart_time) ? $dtstart_time : null; }
						
						// General event item details (regardless of all-day/start/end times)
						$event_item = array(
							'label' => (!empty($maskinfo) ? $maskinfo : @$event->summary),
							'dtstart_time' => @$dtstart_time,
							'dtend_time' => @$dtend_time,
							'feed_key' => $feed_key,
							// Event description and other details have $maskinfo check in r34ics_has_desc() function
							'eventdesc' => @$event->description,
							'location' => @$event->location,
							'organizer' => (!empty($event->organizer_array) ? $event->organizer_array : @$event->organizer),
							'url' => (!empty($event->url) ? $event->url : null),
							'attach' => (!empty($event->attach_array) ? $this->parse_attach_array($event->attach_array) : null),
							'rrule' => (!empty($event->rrule) ? $event->rrule : null),
						);
						
						// Events with different start and end dates
						if	(
								$dtend_date != $dtstart_date &&
								// Watch out for events that are NOT multiday, but end at midnight of the start date!
								!($dtend_date == r34ics_date('Ymd', $dtstart_date, $url_tz, '+1 day') && $dtend_time == '000000')
							)
						{
							$loop_date = $dtstart_date;
							while ($loop_date <= $dtend_date) {
								// Classified as an all-day event and we've hit the end date -- don't display unless $extendmultiday is set
								if ($all_day && $loop_date == $dtend_date && empty($extendmultiday)) {
									break;
								}
								// Multi-day events may be given with end date/time as midnight of the NEXT day (unless $extendmultiday is set)
								$effective_end_date =	(!empty($all_day) && empty($dtend_time) && empty($extendmultiday))
														? r34ics_date('Ymd', $dtend_date, $url_tz, '-1 day')
														: $dtend_date;
								if ($dtstart_date == $effective_end_date) {
									$ics_data['events'][$dtstart_date]['all-day'][] = $event_item;
									break;
								}
								// Get full date/time range of multi-day event (to be used in displaying multi-day events as single items in list views)
								$event_item['multiday'] = array(
									'event_key' => $event_key,
									'start_date' => $dtstart_date,
									'start_time' => $dtstart_time,
									'end_date' => $effective_end_date,
									'end_time' => $dtend_time,
									'all_day' => $all_day,
								);
								// Classified as an all-day event, or we're in the middle of the range -- treat as regular all-day event
								// Note: For all-day events, $dtend_date is midnight on the date AFTER the event ends
								if ($all_day || ($loop_date != $dtstart_date && $loop_date != $dtend_date)) {
									$event_item['multiday']['position'] = 'middle';
									if ($loop_date == $dtstart_date) {
										$event_item['multiday']['position'] = 'first';
									}
									elseif ($loop_date == $effective_end_date) {
										$event_item['multiday']['position'] = 'last';
									}
									$event_item['start'] = $event_item['end'] = null;
									$ics_data['events'][$loop_date]['all-day'][] = $event_item;
								}
								// First date in range -- show start time
								elseif ($loop_date == $dtstart_date) {
									$event_item['start'] = r34ics_time_format($dtstart_time);
									$event_item['end'] = null;
									$event_item['multiday']['position'] = 'first';
									$ics_data['events'][$loop_date]['t'.$dtstart_time][] = $event_item;
								}
								// Last date in range -- show end time
								elseif ($loop_date == $effective_end_date) {
									// If event ends at midnight, skip
									if (!empty($dtend_time) && $dtend_time != '000000') {
										$event_item['sublabel'] = __('Ends', 'r34ics') . ' ' . r34ics_time_format($dtend_time);
										$event_item['start'] = null;
										$event_item['end'] = r34ics_time_format($dtend_time);
										$event_item['multiday']['position'] = 'last';
										$ics_data['events'][$loop_date]['t'.$dtend_time][] = $event_item;
									}
								}
								$loop_date = r34ics_date('Ymd', $loop_date, $url_tz, '+1 day');
							}
						}
						// All-day events
						elseif ($all_day) {
							$ics_data['events'][$dtstart_date]['all-day'][] = $event_item;
						}
						// Events with start/end times
						else {
							$event_item['start'] = r34ics_time_format($dtstart_time);
							$event_item['end'] = r34ics_time_format($dtend_time);
							$ics_data['events'][$dtstart_date]['t'.$dtstart_time][] = $event_item;
						}
					}
				}

				// Debugging information (must occur outside conditional in case it evaluates to false)
				if ($this->debug >= 2) {
					/* This may output a very large amount of data */
					$this->debug_messages[$url]['ICS Parser Data'] = !isset($ics_events) ? 'NO DATA' : $ics_events;
				}
				$this->debug_messages[$url]['Events parsed'] = !isset($ics_events) ? 0 : count((array)$ics_events);
		
				// If no events, create empty array for today to allow calendars to build
				if (empty($ics_data['events'])) {
					$ics_data['events'] = array(r34ics_date('Ymd') => array());
				}

				// Remove out-of-range dates
				if (!empty($ics_data['events'])) {
					$first_date = r34ics_date('Ymd'); // Default value
					$limit_date = null;
					switch (@$view) {
						case 'week':
						case 'currentweek': // Rolling date range from start of previous week to end of next week
							if (($limitdays >= 1 && $limitdays <= 7) || !empty($startdate)) {
								if ($limitdays < 1 || $limitdays > 7) { $limitdays = 7; }
								if (!empty($startdate) && intval($startdate) > 20000000) {
									$first_date = $startdate;
								}
								else {
									$first_date = r34ics_date('Ymd');
								}
								$first_ts = strtotime($first_date);
								$limit_date = r34ics_date('Ymd', $first_date, $url_tz, '+' . intval($limitdays-1) . ' days');
							}
							else {
								$cw1 = r34ics_first_day_of_current('week');
								$first_date = r34ics_date('Ymd', '@' . $cw1, $url_tz, '-7 days');
								$first_ts = strtotime($first_date);
								$limit_date = r34ics_date('Ymd', '@' . $cw1, $url_tz, '+13 days');
							}
							break;
						case 'list':
							if (!empty($startdate) && intval($startdate) > 20000000) {
								$first_date = $startdate;
							}
							elseif (!empty($pastdays)) {
								$first_date = r34ics_date('Ymd', null, $url_tz, '-' . intval($pastdays) . ' days');
							}
							else {
								$first_date = r34ics_date('Ymd');
							}
							$first_ts = strtotime($first_date);
							$limit_date = r34ics_date('Ymd', $first_date, $url_tz, '+' . intval($limitdays-1) . ' days');
							break;
						case 'month':
							if (!empty($startdate) && intval($startdate) > 20000000) {
								$first_date = $startdate;
							}
							elseif (!empty($pastdays)) {
								$first_date = r34ics_date('Ymd', $first_date, $url_tz, '-' . intval($pastdays) . ' days');
							}
							else {
								$first_date = r34ics_date('Ymd', '@' . r34ics_first_day_of_current('month'), $url_tz);
							}
							$first_ts = strtotime($first_date);
							$limit_date = r34ics_date('Ymd', $first_date, $url_tz, '+' . intval($limitdays-1) . ' days');
							break;
						default:
							// Handle other views externally
							$first_date = apply_filters('r34ics_display_calendar_set_first_date', $view, $first_date, $startdate, $pastdays);
							$first_ts = strtotime($first_date);
							$limit_date = apply_filters('r34ics_display_calendar_set_limit_date', $view, $first_ts, $limitdays);
							break;
					}
					// Remove out-of-range events and sort the rest
					foreach (array_keys((array)$ics_data['events']) as $date) {
						if ($date < $first_date || $date > $limit_date) { unset($ics_data['events'][$date]); }
						else { ksort($ics_data['events'][$date]); }
					}
				}
				
				// Debugging information
				if ($this->debug) {
					$this->debug_messages['Included date range'] = $first_date . ' to ' . $limit_date;
				}
			
			}

			// No events in array -- throw notice (if debugging) and return false
			/* Removed in v. 7.1.0 because it needlessly hides a legitimate calendar that just doesn't have any events in range
			if (empty($ics_data['events'])) {
				if (!empty($this->debug)) {
					trigger_error(__('No events found in ICS feed(s). This may mean your calendar contains no events, your feed URL may be incorrect, or your shortcode may have other configuration errors. Set debug="true" in shortcode for additional details.','r34ics'), E_USER_NOTICE);
					r34ics_debug($this->debug_messages);
				}
			}
			*/

			// Sort events
			ksort($ics_data['events']);
			
			// Split events into year/month/day groupings
			$max_date = null;
			foreach ((array)$ics_data['events'] as $date => $events) {
				$year = substr($date,0,4);
				$month = substr($date,4,2);
				$day = substr($date,6,2);
				$ym = substr($date,0,6);
				$ics_data['events'][$year][$month][$day] = $events;
				unset($ics_data['events'][$date]);
				if ($date > $max_date) { $max_date = $date; }
			}
			
			// Set earliest and latest dates
			switch (@$view) {
				case 'week':
				case 'currentweek':
					$ics_data['earliest'] = $first_date;
					$ics_data['latest'] = !empty($limitdayscustom) ? r34ics_date('Ymd', $first_date, $url_tz, '+' . intval($limitdays-1) . ' days') : $max_date;
					break;
				case 'list':
				case 'month':
					$ics_data['earliest'] = substr($first_date,0,6);
					$ics_data['latest'] = !empty($limitdayscustom) ? r34ics_date('Ym', $first_date, $url_tz, '+' . intval($limitdays-1) . ' days') : substr($max_date,0,6);
					break;
				default:
					// Handle other views externally
					$ics_data['earliest'] = apply_filters('r34ics_display_calendar_set_earliest', $view, $first_date);
					$ics_data['latest'] = apply_filters('r34ics_display_calendar_set_latest', $view, $max_date, $first_ts, $limitdays, $limitdayscustom);
					break;
			}

			// Add empty event arrays, if necessary, to populate dropdowns and grids
			/*
			Note: This prevents a simple check for whether or not there are events;
			r34ics_is_empty_array() function was added to accommodate this situation
			but it is only being used in list view since we do want the grid to
			display in the other views, even if empty.
			*/
			for ($i = substr($ics_data['earliest'],0,6); $i <= substr($ics_data['latest'],0,6); $i++) {
				$Y = substr($i,0,4);
				$m = substr($i,4,2);
				if (intval($m) < 1 || intval($m) > 12) { continue; }
				if (!isset($ics_data['events'][$Y][$m])) {
					$ics_data['events'][$Y][$m] = null;
				}
			}
			// Now sort these or it may not work (e.g. if the first actual event is next year)
			foreach (array_keys((array)$ics_data['events']) as $key_year) { ksort($ics_data['events'][$key_year]); }
			ksort($ics_data['events']);
	
			// Write ICS data to transient
			set_transient($transient_name, $ics_data, get_option('r34ics_transients_expiration'));

		}

		// Debugging
		if (!empty($this->debug)) {
			if (empty($ics_data)) {
				if (!empty($loaded_from_transient)) {
					$this->debug_messages['Errors'][] = 'Unavailable -- loaded from transient; set reload="true" in shortcode to force reload.';
				}
				else {
					$this->debug_messages['Errors'][] = 'Unable to parse ICS data.';
				}
			}
			$current_memory_usage = memory_get_usage();
			if (!isset($this->debug_messages['Peak memory usage']) || $current_memory_usage > $this->debug_messages['Peak memory usage']) {
				$this->debug_messages['Peak memory usage'] = memory_get_usage();
				$this->debug_messages['Peak memory usage'] = size_format($this->debug_messages['Peak memory usage'], 2);
			}
			$this->debug_messages['Plugin Data'] = $ics_data;
			r34ics_debug($this->debug_messages);
		}
		
		// Allow external customization of ICS data
		$ics_data = apply_filters('r34ics_display_calendar_filter_ics_data', $ics_data, $args);
		
		// Actions before rendering template (can include additional template output)
		do_action('r34ics_display_calendar_before_render_template', $view, $args, $ics_data);

		// Render template
		switch (@$view) {
			case 'week':
			case 'currentweek':
				include(plugin_dir_path(__FILE__) . 'templates/calendar-week.php');
				break;
			case 'list':
				include(plugin_dir_path(__FILE__) . 'templates/calendar-list.php');
				break;
			case 'month':
				include(plugin_dir_path(__FILE__) . 'templates/calendar-month.php');
				break;
			default:
				// Handle other views externally
				do_action('r34ics_display_calendar_render_template', $view, $args, $ics_data);
		}
		
		// Actions after rendering template (can include additional template output)
		do_action('r34ics_display_calendar_after_render_template', $view, $args, $ics_data);

	}


	public function editor_button() {
		// Add "Add Calendar" button to the editor
		add_action('media_buttons', function() {
			$current_screen = get_current_screen();
			if (isset($current_screen->parent_file) && strpos($current_screen->parent_file, 'edit.php') !== false) {
				// Display button
				include(plugin_dir_path(__FILE__) . 'templates/admin/add-calendar-button.php');
			}
		}, 20);

		// Add modal for "Add Calendar"
		add_action('admin_print_footer_scripts', function() {
			$current_screen = get_current_screen();
			if (isset($current_screen->parent_file) && strpos($current_screen->parent_file, 'edit.php') !== false) {
				include_once(plugin_dir_path(__FILE__) . 'templates/admin/add-calendar.php');
			}
		}, 10);
	}


	public function enqueue_scripts() {
		wp_enqueue_script('ics-calendar', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), $this->version);
		wp_enqueue_style('ics-calendar', plugin_dir_url(__FILE__) . 'assets/style.css', false, $this->version);
		if (current_user_can('edit_posts')) {
			wp_enqueue_style('ics-calendar-debug', plugin_dir_url(__FILE__) . 'assets/debug.css', false, $this->version);
		}
		wp_localize_script('ics-calendar', 'ics_calendar_i18n', array(
			'hide_past_events' => __('Hide past events','r34ics'),
			'show_past_events' => __('Show past events','r34ics'),
		));
	}
	
	
	public function event_description_html($args, $event, $classes=array(), $has_desc=null) {
		if (empty($args) || empty($event) || empty($has_desc)) { return false; }
		ob_start();
		// Attachment handling
		$attachment_is_image = false;
		$show_attachment = false;
		if (!empty($event['attach'])) {
			// Check if attachment is an image URL (for direct display)
			$attachment_is_image = (strpos($event['attach'],'<img') !== false);
			// Determine whether or not to show attachment based on shortcode argument
			switch ($args['attach']) {
				case 'image':
					if ($attachment_is_image) {
						$show_attachment = true;
					}
					break;
				case 'download':
					if (!$attachment_is_image) {
						$show_attachment = true;
					}
					break;
				case '1':
				case 'true':
					$show_attachment = true;
					break;
				case '0':
				case 'false':
					break;
				case '':
				default:
					if (!empty($args['eventdesc'])) {
						$show_attachment = true;
					}
					break;
			}
		}
		// Float attachment in list view
		if ($show_attachment && $attachment_is_image && $args['view'] == 'list') {
			?>
			<div class="attach attach_float"><?php echo strip_tags($event['attach'],'<a><img>'); ?></div>
			<?php
		}
		if (!empty($args['location']) && !empty($event['location'])) {
			?>
			<div class="location"><?php echo r34ics_maybe_make_clickable($event['location']); ?></div>
			<?php
		}
		if (!empty($args['organizer']) && !empty($event['organizer'])) {
			?>
			<div class="organizer"><?php echo r34ics_organizer_format($event['organizer']); ?></div>
			<?php
		}
		$eventdesc_content = '';
		if (!empty($args['eventdesc'])) {
			if (!empty($event['eventdesc'])) {
				if ($args['view'] != 'month' && intval($args['eventdesc']) > 1) {
					$eventdesc_content .=	'<div class="descloc_toggle">' .
												'<div class="descloc_toggle_excerpt" aria-hidden="true" title="' . esc_attr__('Click for more...', 'r34ics') . '">' .
													r34ics_maybe_make_clickable(wp_trim_words($event['eventdesc'], intval($args['eventdesc']))) .
												'</div>' .
												'<div class="descloc_toggle_full">' . r34ics_filter_the_content(r34ics_maybe_make_clickable($event['eventdesc'])) . '</div>' .
											'</div>';
				}
				else {
					$eventdesc_content .=	r34ics_filter_the_content(r34ics_maybe_make_clickable($event['eventdesc']));
				}
			}
			if (empty($args['linktitles']) && empty($args['nolink']) && !empty($event['url'])) {
				$eventdesc_content .=	'<div class="eventdesc eventurl">' .
											'<a href="' . esc_url($event['url']) . '"' . (!r34ics_domain_match($event['url']) ? ' target="_blank" rel="noopener noreferrer nofollow"' : '') . '>' . esc_url($event['url']) . '</a>' .
										'</div>';
			}
		}
		// Show attachment after description if not list view
		if ($show_attachment && (!$attachment_is_image || $args['view'] != 'list')) {
			$eventdesc_content .=	'<div class="attach">' . strip_tags($event['attach'],'<a><img>') . '</div>';
		}
		// Add recurrence information
		if (empty($args['skiprecurrence']) && !empty($event['rrule'])) {
			$eventdesc_content .= r34ics_recurrence_description($event['rrule'], $args['hiderecurrence']);
		}
		// Appent eventdesc if we have anything to show
		if (!r34ics_empty_content($eventdesc_content)) {
			?>
			<div class="eventdesc"><?php echo $eventdesc_content; ?></div>
			<?php
		}
		// Action for additional content
		do_action('r34ics_event_description_html', $args, $event, $classes);
		// Add wrapper div and prepend title/time
		$descloc_content = trim(ob_get_clean());
		if (!empty($descloc_content)) {
			ob_start();
			$descloc_class = array_merge(array('descloc'), (array)$classes);
			?>
			<div class="<?php echo esc_attr(implode(' ', $descloc_class)); ?>">
			<?php
			// Repeat event title in hover block
			if (in_array('hover_block', $descloc_class)) {
				?>
				<div class="title_in_hover_block"><?php echo $this->event_label_html($args, $event, null); ?></div>
				<?php
				if (!empty($event['start'])) {
					?>
					<div class="time_in_hover_block">
						<?php
						echo $event['start'];
						if (!empty($event['end'])) { echo ' &#8211; ' . $event['end']; }
						?>
					</div>
					<?php
				}
			}
			$descloc_content = ob_get_clean() . $descloc_content . '</div>';
		}
		// Filter content
		$descloc_content = apply_filters('r3417_event_description_html_filter', $descloc_content, $args);
		// Return content
		return !r34ics_empty_content($descloc_content) ? $descloc_content : null;
	}
	
	
	public function event_label_html($args, $event, $classes=array()) {
		if (empty($args) || empty($event)) { return false; }
		ob_start();
		$title_class = array_merge(array('title'), (array)$classes);
		?>
		<span class="<?php echo esc_attr(implode(' ', $title_class)); ?>">
			<?php
			if (!empty($args['linktitles']) && empty($args['nolink']) && !empty($event['url'])) {
				echo '<a href="' . esc_url($event['url']) . '" ' . (!r34ics_domain_match($event['url']) ? ' target="_blank" rel="noopener noreferrer nofollow"' : '') . '>';
			}
			echo html_entity_decode(str_replace('/', '/<wbr />',$event['label']));
			if (!empty($args['linktitles']) && empty($args['nolink']) && !empty($event['url'])) {
				echo '</a>';
			}
			do_action('r34ics_event_label_html', $args, $event, $classes);
			?>
		</span>
		<?php
		$title_content = apply_filters('r3417_event_label_html_filter', ob_get_clean(), $args);
		return !r34ics_empty_content($title_content) ? $title_content : null;
	}
	
	
	public function event_sublabel_html($args, $event, $classes=array()) {
		if (empty($args) || empty($event) || empty($event['sublabel'])) { return false; }
		ob_start();
		$sublabel_class = array_merge(array('sublabel'), (array)$classes);
		?>
		<span class="<?php echo esc_attr(implode(' ', $sublabel_class)); ?>">
			<?php
			if (empty($event['start']) && !empty($event['end'])) {
				?>
				<span class="carryover">&#10554;</span>
				<?php
			}
			echo str_replace('/', '/<wbr />',$event['sublabel']);
			do_action('r34ics_event_sublabel_html', $args, $event, $classes);
			?>
		</span>
		<?php
		$sublabel_content = apply_filters('r3417_event_sublabel_html_filter', ob_get_clean(), $args);
		return !r34ics_empty_content($sublabel_content) ? $sublabel_content : null;
	}


	public function first_dow($date=null) {
		return r34ics_date('w', r34ics_date('Ym', $date) . '01');
	}


	public function get_days_of_week($format=null) {
		$days_of_week = $this->days_of_week($format);

		// Shift sequence of days based on site configuration
		$start_of_week = get_option('start_of_week', 0);
		for ($i = 0; $i < $start_of_week; $i++) {
			$day = $days_of_week[$i];
			unset($days_of_week[$i]);
			$days_of_week[$i] = $day;
		}

		return $days_of_week;
	}
	
	
	public function parse_attach_array($attach) {
		if (empty($attach) || !is_array($attach) || count($attach) != 2) { return false; }
		
		// Determine file/URL properties
		$url = $attach[1];
		$mime = isset($attach[0]['FMTTYPE']) ? $attach[0]['FMTTYPE'] : null;
		$filename = isset($attach[0]['FILENAME']) ? $attach[0]['FILENAME'] : pathinfo($url,PATHINFO_BASENAME);
		$ext = pathinfo($filename,PATHINFO_EXTENSION);
		$clean_filename = sanitize_title(pathinfo($filename,PATHINFO_FILENAME)) . '.' . $ext;
		
		// Validate URL (some feeds may contain local/network file paths instead of properly formed URLs)
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			return false;
		}
			
		// Return images as an image tag (MIME type MUST be passed or this may not actually be a direct image link (e.g. a Google Drive preview link)
		elseif (!empty($mime) && strpos($mime, 'image/') === 0) { 
			return '<img src="' . esc_url($url) . '" alt="" style="position: relative; height: auto; width: 100%;" />';
		}
		
		// Return other files with a MIME type set, and not equal to a text format, as downloads
		elseif (!empty($mime) && strpos($mime, 'text/') === false) {
			return '<a href="' . esc_url($url) . '" download="' . $filename . '" rel="noopener noreferrer nofollow">' . $filename . '</a>';
		}
		
		// Return others (no MIME type, or a "text/" mime type) as clickable links
		else {
			return '<a href="' . esc_url($url) . '" ' . (!r34ics_domain_match($url) ? ' target="_blank" rel="noopener noreferrer nofollow"' : '') . '>' . $filename . '</a>';
		}
		
		// Do nothing with other files
		return false;
	}


	public function shortcode($atts) {
		
		// Don't do anything in admin
		if (is_admin()) { return; }

		// Extract attributes
		extract(shortcode_atts($this->shortcode_defaults, $atts, 'ics_calendar'));
		
		// Assemble display arguments array
		$args = array(
			'attach' => (in_array($attach, array('','0','false','1','true','image','download')) ? $attach : null),
			'color' => $color,
			'columnlabels' => (in_array($columnlabels, array('','short','min')) ? $columnlabels : null),
			'count' => intval($count),
			'currentweek' => r34ics_boolean_check($currentweek),
			'customoptions' => explode('|', $customoptions),
			'description' => $description,
			'debug' => (intval($debug) ? intval($debug) : r34ics_boolean_check($debug)),
			'eventdesc' => (intval($eventdesc) ? intval($eventdesc) : r34ics_boolean_check($eventdesc)),
			'extendmultiday' => r34ics_boolean_check($extendmultiday),
			'feedlabel' => $feedlabel,
			'format' => $format,
			'formatmonthyear' => preg_replace('/[^FMmnYy\/\.\-\s]+/','',$formatmonthyear),
			'hidealldayindicator' => r34ics_boolean_check($hidealldayindicator),
			'hiderecurrence' => r34ics_hiderecurrence_parse($hiderecurrence),
			'hidetimes' => r34ics_boolean_check($hidetimes),
			'legendinline' => false, // Deprecated
			'legendposition' => (in_array($legendposition, array('above','below')) ? $legendposition : null),
			'legendstyle' => (in_array($legendstyle, array('block','inline','none')) ? $legendstyle : (r34ics_boolean_check($legendinline) ? 'inline' : null)),
			'limitdays' => (intval($limitdays) > 0 ? intval($limitdays) : $this->limit_days),
			'limitdayscustom' => isset($limitdays),
			'linebreakfix' => r34ics_boolean_check($linebreakfix),
			'linktitles' => r34ics_boolean_check($linktitles),
			'location' => r34ics_boolean_check($location),
			'maskinfo' => $maskinfo,
			'method' => (in_array(strtolower($method), array('curl','fopen')) ? strtolower($method) : null),
			'monthnav' => (in_array($view, array('month')) && in_array($monthnav, array('arrows','select','both','compact')) ? $monthnav : null),
			'nolink' => r34ics_boolean_check($nolink),
			'nomobile' => r34ics_boolean_check($nomobile),
			'pastdays' => intval($pastdays),
			'organizer' => r34ics_boolean_check($organizer),
			'reload' => (r34ics_boolean_check($reload) || intval($debug) >= 2),
			'showendtimes' => r34ics_boolean_check($showendtimes),
			'skip' => intval($skip),
			'skiprecurrence' => r34ics_boolean_check($skiprecurrence),
			'startdate' => ($startdate == 'today' || (empty($startdate) && $view == 'week' && $limitdays > 0 && $limitdays <= 7) ? wp_date('Ymd', current_time('timestamp')) : intval($startdate)),
			'title' => $title,
			'toggle' => r34ics_boolean_check($toggle),
			'tz' => $tz,
			'url' => $url,
			'view' => (!empty($currentweek) ? 'currentweek' : $view), // Backwards compatibility for "currentweek" option from version 2.0.5
		);
		$args = apply_filters('r34ics_display_calendar_args', $args, $atts);

		// Get the calendar output
		ob_start();
		$this->display_calendar($args);
		return ob_get_clean();
	}


	public function wp_settings() {
		// Transient timeout
		// v. 6.11.1 Renamed option from 'r34ics_transient_expiration' to 'r34ics_transient_expiration' so it's not a transient itself
		if (!get_option('r34ics_transients_expiration')) {
			$transients_expiration = get_option('r34ics_transient_expiration') ? get_option('r34ics_transient_expiration') : 3600;
			update_option('r34ics_transients_expiration', $transients_expiration);
			delete_option('r34ics_transient_expiration');
		}
	}


	private function _load_parser() {
		if (!class_exists('ICal\ICal')) { include_once($this->ical_path); }
		if (!class_exists('ICal\Event')) { include_once($this->event_path); }
		return true;
	}
	
	private function _load_pand() {
		if (!class_exists('PAnD')) { include_once($this->pand_path); }
	}
	
}
