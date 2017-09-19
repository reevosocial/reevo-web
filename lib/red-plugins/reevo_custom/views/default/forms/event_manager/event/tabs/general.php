<?php
/**
 * Form fields for general event information
 */

global $fbevent;
if (!empty($fbevent)) {
	$vars['title'] = $fbevent['name'];

	// Convierte fecha y hora de inicio del evento que viene de FB al formato que maneja event_manager
	$fb_event_start_array = explode('T',$fbevent['start_time']);
	$fb_event_start_time = explode('-',$fb_event_start_array[1]);
	$fb_event_start = $fb_event_start_array[0] . ' ' . $fb_event_start_time[0];
	$vars['event_start'] = strtotime($fb_event_start);
	$gm_event_start = gmmktime(date('H', $vars['event_start']),date('i', $vars['event_start']),date('s', $vars['event_start']),date('m', $vars['event_start']),date('d', $vars['event_start']),date('Y', $vars['event_start']));

	// Convierte fecha y hora de final del evento que viene de FB al formato que maneja event_manager
	$fb_event_end_array = explode('T',$fbevent['end_time']);
	$fb_event_end_time = explode('-',$fb_event_end_array[1]);
	$fb_event_end = $fb_event_end_array[0] . ' ' . $fb_event_end_time[0];
	$vars['event_end'] = strtotime($fb_event_end);
	$gm_event_end = gmmktime(date('H', $vars['event_end']),date('i', $vars['event_end']),date('s', $vars['event_end']),date('m', $vars['event_end']),date('d', $vars['event_end']),date('Y', $vars['event_end']));

} else {
	$gm_event_start = gmmktime(0,0,0,gmdate('m', $vars['event_start']),gmdate('d', $vars['event_start']),gmdate('Y', $vars['event_start']));
	$gm_event_end = gmmktime(0,0,0,gmdate('m', $vars['event_end']),gmdate('d', $vars['event_end']),gmdate('Y', $vars['event_end']));
}


echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('title'),
	'name' => 'title',
	'value' => $vars['title'],
	'required' => true,
]);


// Starting time
$event_start_input = elgg_view('input/date', [
	'name' => 'event_start',
	'id' => 'event_start',
	'timestamp' => true,
	'required' => true,
	'value' => $gm_event_start,
	'class' => 'event_manager_event_edit_date',
]);
$start_time_input = elgg_view('input/time', [
	'name' => 'start_time',
	'value' => $gm_event_start,
]);

$start = elgg_view('elements/forms/field', [
	'label' => elgg_view('elements/forms/label', [
		'label' => elgg_echo('event_manager:edit:form:start'),
		'id' => 'event_start',
		'required' => true,
	]),
	'input' => $event_start_input . $start_time_input,
	'class' => 'event-manager-forms-label-inline man',
]);

// Ending time
$event_end_input = elgg_view('input/date', [
	'name' => 'event_end',
	'id' => 'event_end',
	'timestamp' => true,
	'required' => true,
	'value' => $gm_event_end,
	'class' => 'event_manager_event_edit_date'
]);
$end_time_input = elgg_view('input/time', [
	'name' => 'end_time',
	'value' => $gm_event_end,
]);

$end = elgg_view('elements/forms/field', [
	'label' => elgg_view('elements/forms/label', [
		'label' => elgg_echo('event_manager:edit:form:end'),
		'id' => 'event_end',
		'required' => true,
	]),
	'input' => $event_end_input . $end_time_input,
	'class' => 'event-manager-forms-label-inline man',
]);

echo "<div class='elgg-col elgg-col-1of2'>{$start}</div>";
echo "<div class='elgg-col elgg-col-1of2'>{$end}</div>";
