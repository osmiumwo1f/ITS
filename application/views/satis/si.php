<?php
if (empty ($ajax)) {
	echo 'No data available.';
}
else {
	foreach($ajax as $a){
	    echo '<div class="si" id="'.$a['id'].'">'.$a['name'].'</div>';
    }
}
?>