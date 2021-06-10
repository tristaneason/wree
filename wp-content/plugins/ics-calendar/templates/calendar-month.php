<?php
// Require object
if (empty($ics_data)) { return false; }

global $R34ICS;
global $wp_locale;

$days_of_week = $R34ICS->get_days_of_week($args['columnlabels']);
$start_of_week = get_option('start_of_week', 0);

$date_format = r34ics_date_format($args['format']);

$today = r34ics_date('Ymd');
$this_ym = r34ics_date('Ym');

$ics_calendar_classes = array(
	'ics-calendar',
	'layout-month',
	(!empty($args['hidetimes']) ? ' hide_times' : ''),
	(!empty($args['monthnav']) ? ' monthnav-' . esc_attr($args['monthnav']) : ''),
	(!empty($args['nomobile']) ? ' nomobile' : ''),
	(!empty($args['toggle']) ? ' r34ics_toggle' : ''),
	(count((array)$ics_data['urls']) > 1 ? ' multi-feed' : ''),
);

// Feed colors custom CSS
if (!empty($ics_data['colors'])) {
	r34ics_feed_colors_css($ics_data);
}
?>

<section class="<?php echo esc_attr(implode(' ', $ics_calendar_classes)); ?>" id="<?php echo esc_attr($ics_data['guid']); ?>">

	<?php
	// Title and description
	if (!empty($ics_data['title'])) {
		?>
		<h2 class="ics-calendar-title"><?php echo $ics_data['title']; ?></h2>
		<?php
	}
	if (!empty($ics_data['description'])) {
		?>
		<p class="ics-calendar-description"><?php echo $ics_data['description']; ?></p>
		<?php
	}
	
	// Actions before rendering calendar wrapper (can include additional template output)
	do_action('r34ics_display_calendar_before_wrapper', $view, $args, $ics_data);

	// Color code key
	if (empty($args['legendposition']) || $args['legendposition'] == 'above') {
		echo $R34ICS->color_key_html($args, $ics_data);
	}

	// Show previous/next month arrows if applicable
	if (!empty($args['monthnav']) && in_array($args['monthnav'], array('arrows','both','compact'))) {
		?>
		<nav class="ics-calendar-arrow-nav" style="display: none;">
			<a href="#" class="prev" data-goto=""><span class="prev-icon">&larr;</span> <span class="prev-text"></span></a>
			<a href="#" class="next" data-goto=""><span class="next-text"></span> <span class="next-icon">&rarr;</span></a>
		</nav>
		<?php
	}
	?>	

	<select class="ics-calendar-select<?php if (!empty($args['monthnav']) && $args['monthnav'] == 'arrows') { echo ' hidden'; } ?>" style="display: none;" autocomplete="off" data-this-month="<?php echo esc_attr($this_ym); ?>">
		<?php
		// Build list from earliest to latest month
		foreach (array_keys((array)$ics_data['events']) as $year) {
			for ($m = 1; $m <= 12; $m++) {
				$month = $m < 10 ? '0' . $m : '' . $m;
				$ym = $year . $month;
				if (isset($ics_data['earliest']) && $ym < $ics_data['earliest']) { continue; }
				if (isset($ics_data['latest']) && $ym > $ics_data['latest']) { break(2); }
				$month_label = ucwords(r34ics_date($args['formatmonthyear'], $m.'/1/'.$year));
				?>
				<option value="<?php echo esc_attr($ym); ?>"<?php if ($ym == $this_ym) { echo ' selected="selected"'; } ?>><?php echo $month_label; ?></option>
				<?php
			}
		}
		?>
	</select>

	<!-- Toggle show/hide past events on mobile -->
	<span class="ics-calendar-past-events-toggle phone_only inline_block" aria-hidden="true">&nbsp;<a href="#" data-ics-calendar-action="show-past-events"><?php _e('Show past events','r34ics'); ?></a></span>
	
	<?php
	// Build monthly calendars
	foreach (array_keys((array)$ics_data['events']) as $year) {
		for ($m = 1; $m <= 12; $m++) {
			$month = $m < 10 ? '0' . $m : '' . $m;
			$ym = $year . $month;
			if (isset($ics_data['earliest']) && $ym < $ics_data['earliest']) { continue; }
			if (isset($ics_data['latest']) && $ym > $ics_data['latest']) { break(2); }
			$month_label = ucwords(r34ics_date($args['formatmonthyear'], $m.'/1/'.$year));
			$month_guid = $ics_data['guid'] . '-' . $ym;
			
			// Build month's calendar
			?>
			<article class="ics-calendar-month-wrapper" data-year-month="<?php echo esc_attr($ym); ?>" style="display: none;">

				<h3 class="ics-calendar-label" id="<?php echo esc_attr($month_guid); ?>"><?php echo $month_label; ?></h3>

				<table class="ics-calendar-month-grid" aria-labelledby="<?php echo esc_attr($month_guid); ?>">
					<thead>
						<tr>
							<?php
							foreach ((array)$days_of_week as $w => $dow) {
								?>
								<th data-dow="<?php echo $w; ?>"><?php echo $dow; ?></th>
								<?php
							}
							?>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php
							$first_dow = $R34ICS->first_dow($m.'/1/'.$year);
							if ($first_dow < $start_of_week) { $first_dow = $first_dow + 7; }
							for ($off_dow = $start_of_week; $off_dow < $first_dow; $off_dow++) {
								?>
								<td class="off" data-dow="<?php echo intval($off_dow); ?>"></td>
								<?php
							}
							for ($day = 1; $day <= r34ics_date('t', $m.'/1/'.$year); $day++) {
								$date = r34ics_date('Ymd', $m.'/'.$day.'/'.$year);
								$d = r34ics_date('d', $date);
								$dow = r34ics_date('w', $date);
								$day_events = isset($ics_data['events'][$year][$month][$d]) ? $ics_data['events'][$year][$month][$d] : null;
								$day_guid = $ics_data['guid'] . '-' . $ym . $d;
								$day_classes = r34ics_day_classes(array(
									'date' => $date,
									'today' => $today,
									'count' => count((array)$day_events),
									'filler' => !empty($day_events['all-day'][0]['filler'])
								));
								if ($dow == $start_of_week) {
									?>
									</tr><tr>
									<?php
								}
								?>
								<td data-dow="<?php echo intval($dow); ?>" class="<?php echo esc_attr($day_classes); ?>">
									<div class="day">
										<span class="phone_only" id="<?php echo esc_attr($day_guid); ?>"><?php echo r34ics_date($date_format, $date); ?></span>
										<span class="no_phone" aria-hidden="true"><?php echo r34ics_date('j', $date); ?></span>
									</div>
									<?php
									if (!empty($day_events)) {
										?>
										<ul class="events" aria-labelledby="<?php echo esc_attr($day_guid); ?>">
											<?php
											foreach ((array)$day_events as $time => $events) {
												$all_day_indicator_shown = !empty($args['hidealldayindicator']);
												foreach ((array)$events as $event) {
													$has_desc = r34ics_has_desc($args, $event);
													if ($time == 'all-day') {
														?>
														<li class="<?php echo r34ics_event_css_classes($event, $time, $args); ?>" data-feed-key="<?php echo intval($event['feed_key']); ?>" data-feed-color="<?php echo !empty($ics_data['colors'][$event['feed_key']]['base']) ? esc_attr($ics_data['colors'][$event['feed_key']]['base']) : ''; ?>">
															<?php
															if (!$all_day_indicator_shown) {
																?>
																<span class="all-day-indicator"><?php _e('All Day', 'r34ics'); ?></span>
																<?php
																$all_day_indicator_shown = true;
															}

															// Event label (title)
															echo $R34ICS->event_label_html($args, $event, (!empty($has_desc) ? array('has_desc') : null));

															// Sub-label
															echo $R34ICS->event_sublabel_html($args, $event, null);

															// Description/Location/Organizer
															echo $R34ICS->event_description_html($args, $event, (empty($args['toggle']) ? array('phone_only','hover_block') : null), $has_desc);
															?>
														</li>
														<?php
													}
													else {
														?>
														<li class="<?php echo r34ics_event_css_classes($event, $time, $args); ?>" data-feed-key="<?php echo intval($event['feed_key']); ?>" data-feed-color="<?php echo !empty($ics_data['colors'][$event['feed_key']]['base']) ? esc_attr($ics_data['colors'][$event['feed_key']]['base']) : ''; ?>">
															<?php
															if (!empty($event['start'])) {
																?>
																<span class="time"><?php
																echo $event['start'];
																if (!empty($event['end']) && $event['end'] != $event['start']) {
																	if (empty($args['showendtimes'])) {
																		?>
																		<span class="show_on_hover">&#8211; <?php echo $event['end']; ?></span>
																		<?php
																	}
																	else {
																		?>
																		&#8211; <?php echo $event['end']; ?>
																		<?php
																	}
																}
																?></span>
																<?php
															}

															// Event label (title)
															echo $R34ICS->event_label_html($args, $event, (!empty($has_desc) ? array('has_desc') : null));

															// Sub-label
															echo $R34ICS->event_sublabel_html($args, $event, null);

															// Description/Location/Organizer
															echo $R34ICS->event_description_html($args, $event, (empty($args['toggle']) ? array('phone_only','hover_block') : null), $has_desc);
															?>
														</li>
														<?php
													}
												}
											}
											?>
										</ul>
										<?php
									}
									?>
								</td>
								<?php
							}
							$calc_dow = ($start_of_week != 0 && $dow == 0) ? 7 : $dow;
							for ($off_dow = $calc_dow + 1; $off_dow < ($start_of_week + 7); $off_dow++) {
								?>
								<td class="off" data-dow="<?php echo intval($off_dow % 7); ?>"></td>
								<?php
							}
							?>
						</tr>
					</tbody>
				</table>

			</article>
			<?php
		}
	}
		
	// Color code key
	if (!empty($args['legendposition']) && $args['legendposition'] == 'below') {
		echo $R34ICS->color_key_html($args, $ics_data);
	}

	// Actions after rendering calendar wrapper (can include additional template output)
	do_action('r34ics_display_calendar_after_wrapper', $view, $args, $ics_data);
	?>

</section>
