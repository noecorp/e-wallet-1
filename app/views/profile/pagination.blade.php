<?php
$appended_array = [];
if( isset($_GET['start_date'])){
	$appended_array['start_date'] = $_GET['start_date'];
}
if( isset($_GET['end_date'])){
	$appended_array['end_date'] = $_GET['end_date'];
}
?>

{{ $models->appends($appended_array)->links() }}