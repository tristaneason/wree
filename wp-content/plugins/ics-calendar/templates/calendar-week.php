<?php
// Require object
if (empty($ics_data)) { return false; }

global $R34ICS;
global $wp_locale;

$days_of_week = $R34ICS->get_days_of_week($args['columnlabels']);
$start_of_week = get_option('start_of_week', 0);

$date_format = r34ics_date_format($args['format']);

$today = r34ics_date('Ymd');

$ics_calendar_classes = array(
	'ics-calendar',
	'layout-week',
	'current_week_only',
	(!empty($args['nomobile']) ? ' nomobile' : ''),
	(!empty($args['hidetimes']) ? 'hide_times' : ''),
	(!empty($args['toggle']) ? 'r34ics_toggle' : ''),
	(count((array)$ics_data['urls']) > 1 ? 'multi-feed' : ''),
);

// Special handling for instances where limitdays and/or startdate are set
$fixed_dates = false;
if ((!empty($args['limitdays']) && $args['limitdays'] > 0 && $args['limitdays'] <= 7) || !empty($args['startdate'])) {
	$fixed_dates = true;
	// Set limitdays to 7 if not set
	if (!empty($args['startdate']) && empty($args['limitdays']) || $args['limitdays'] > 7) {
		$args['limitdays'] = 7;
	}
	// Set startdate to today if not set
	if (empty($args['startdate'])) {
		$args['startdate'] = $today;
	}
	$enddate = r34ics_date('Ymd', $args['startdate'], null, '+' . intval($args['limitdays'] - 1) . ' days');
}

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

	// Display calendar
	if (empty($fixed_dates)) {
		?>
		<select class="ics-calendar-select" style="display: none;" autocomplete="off">
			<option value="previous-week"><?php _e('Last week', 'r34ics'); ?></option>
			<option value="current-week" selected="selected"><?php _e('This week', 'r34ics'); ?></option>
			<option value="next-week"><?php _e('Next week', 'r34ics'); ?></option>
		</select>
		<?php
	}

	// Toggle show/hide past events on mobile
	if ($args['startdate'] != $today) {
		?>
		<span class="ics-calendar-past-events-toggle phone_only inline_block" aria-hidden="true">&nbsp;<a href="#" data-ics-calendar-action="show-past-events"><?php _e('Show past events','r34ics'); ?></a></span>
		<?php
	}
	?>

	<article class="ics-calendar-week-wrapper" style="display: none;">
		<table class="ics-calendar-month-grid<?php if (!empty($fixed_dates)) { echo ' fixed_dates'; } ?>">
			<thead>
				<tr>
					<?php
					if (!empty($fixed_dates)) {
						$day_for_start = r34ics_date('j', $args['startdate']);
						$day_for_max = $day_for_start + ($args['limitdays'] - 1);
						for ($day = $day_for_start; $day <= $day_for_max; $day++) {
							$w = r34ics_date('w', $args['startdate'], null, '+' . ($day-$day_for_start) . ' days');
							?>
							<th data-dow="<?php echo $w; ?>"><?php echo $days_of_week[$w]; ?></th>
							<?php
						}
					}
					else {
						foreach ((array)$days_of_week as $w => $dow) {
							?>
							<th data-dow="<?php echo $w; ?>"><?php echo $dow; ?></th>
							<?php
						}
					}
					?>
				</tr>
			</thead>

			<tbody><tr>
				<?php
				// Build calendar
				foreach (array_keys((array)$ics_data['events']) as $year) {
					for ($m = 1; $m <= 12; $m++) {
						$month = $m < 10 ? '0' . $m : '' . $m;
						$ym = $year . $month;
						$first_dow = $R34ICS->first_dow($m.'/1/'.$year);
						if ($first_dow < $start_of_week) { $first_dow = $first_dow + 7; }
						if (!isset($start_fill)) {
							if (empty($fixed_dates)) {
								for ($off_dow = $start_of_week; $off_dow < $first_dow; $off_dow++) {
									?>
									<td class="off" data-dow="<?php echo intval($off_dow); ?>"></td>
									<?php
								}
							}
							$start_fill = true;
						}
						if (!empty($fixed_dates)) {
							$day_for_start = r34ics_date('j', $args['startdate']);
							$day_for_max = $day_for_start + ($args['limitdays'] - 1);
						}
						else {
							$day_for_start = 1;
							$day_for_max = r34ics_date('t',$m.'/1/'.$year);
						}
						for ($day = $day_for_start; $day <= $day_for_max; $day++) {
							$date = r34ics_date('Ymd', $m.'/1/'.$year, null, '+' . ($day-1) . ' days');
							// Exclude dates out of range
							if (!empty($fixed_dates)) {
								// Month does not fall within range of start and end dates
								if ($date < $startdate || $date > $enddate) { continue(2); }
							}
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
							if (empty($fixed_dates) && $dow == $start_of_week) {
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

														if (!empty($event['sublabel'])) {
															?>
															<span class="sublabel"><?php
															if (empty($event['start']) && !empty($event['end'])) {
																?>
																<span class="carryover">&#10554;</span>
																<?php
															}
															echo str_replace('/', '/<wbr />',$event['sublabel']);
															?></span>
															<?php
														}
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
					}
				}
				?>
			</tr></tbody>
		</table>

	</article>

	<?php
	// Color code key
	if (!empty($args['legendposition']) && $args['legendposition'] == 'below') {
		echo $R34ICS->color_key_html($args, $ics_data);
	}

	// Actions after rendering calendar wrapper (can include additional template output)
	do_action('r34ics_display_calendar_after_wrapper', $view, $args, $ics_data);
	?>

</section>
