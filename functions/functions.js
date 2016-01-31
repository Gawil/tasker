curtodo = 0; curwip = 0; curdone = 0; curdead = 0; id = 0;

function displayNextTodo() {
	$(document).ready(
		function() {
			$("#todo").load("taskdisplayer.php?cursor="+curtodo+"&fold=todo");
			$.ajaxSetup({ cache: false });
		}
	);
}
function displayNextWIP() {
	$(document).ready(
		function() {
			$("#wip").load("taskdisplayer.php?cursor="+curwip+"&fold=wip");
			$.ajaxSetup({ cache: false });
		}
	);
}
function displayNextDone() {
	$(document).ready(
		function() {
			$("#done").load("taskdisplayer.php?cursor="+curdone+"&fold=done");
			$.ajaxSetup({ cache: false });
		}
	);
}
function displayNextDead() {
	$(document).ready(
		function() {
			$("#dead").load("taskdisplayer.php?cursor="+curdead+"&fold=dead");
			$.ajaxSetup({ cache: false });
		}
	);
}
function displayCurrentTask(i, idd) {
	switch(i) {
		case 1:
			document.location.href = "task.php?fold=todo&id="+idd;
			break;
		case 2:
			document.location.href = "task.php?fold=wip&id="+idd;
			break;
		case 3:
			document.location.href = "task.php?fold=done&id="+idd;
			break;
		case 4:
			document.location.href = "task.php?fold=dead&id="+idd;
			break;
		default:
	} 
}
