<?php
$tableHTML = "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo $tableHTML;
echo !empty($summary)? $summary: format_notice($this, 'ERROR: The summary could not be resolved.');
?>