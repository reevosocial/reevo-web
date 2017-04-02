<?php
/**
 * E-mail display long text
 * Displays a large amount of text, with new lines converted to line breaks
 *
 * @package Elggman
 *
 * @uses $vars['From'] From email
 * @uses $vars['Content-Type'] Content type (optional)
 * @uses $vars['MIME-Version'] MIME Version (optional).
 * @uses $vars['Content-Transfer-Encoding'] Transfer encoding (optional)
 */

global $CONFIG;

$header_eol = "\r\n";
if (isset($CONFIG->broken_mta) && $CONFIG->broken_mta) {
	// Allow non-RFC 2822 mail headers to support some broken MTAs
	$header_eol = "\n";
}

$default_headers = array(
	"From" => $from,
	"Content-Type" => "text/plain; charset=UTF-8; format=flowed",
	"MIME-Version" => "1.0",
	"Content-Transfer-Encoding" => "8bit",
	);

unset($vars['url']);
unset($vars['user']);
unset($vars['config']);

$headers = array_merge($default_headers, $vars);

foreach ($headers as $header => $value) {
	if($value) {
		echo "$header: $value{$header_eol}";
	}
}
