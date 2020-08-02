<?php



require('controller/frontend.php');


if(isset($_GET['action'])){

	if($_GET['action']=='listEvents'){

		listEvents();
	}
	elseif($_GET['action']=="event"){
		event();
	}
}
else{
	listEvents();
}
