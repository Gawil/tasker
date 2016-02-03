<!DOCTYPE html>
<html>
<?php
	if (!file_exists("database"))
		mkdir("database", 0755);
	if (!file_exists("database/dead"))
		mkdir("database/dead", 0755);
	if (!file_exists("database/done"))
		mkdir("database/done", 0755);
	if (!file_exists("database/todo"))
		mkdir("database/todo", 0755);
	if (!file_exists("database/users"))
		mkdir("database/users", 0755);
	if (!file_exists("database/wip"))
		mkdir("database/wip", 0755);
	if (!file_exists("database/config")) {
		$file = fopen("database/config", "w");
		if ($file) {
			fprintf($file, "1\n");
			fclose($file);
		}
	}
	if (!file_exists("database/email")) {
		$file = fopen("database/email", "w");
		if ($file) {
			fprintf($file, "\n");
			fclose($file);
		}
	}
	if (!file_exists("database/passwd")) {
		$file = fopen("database/passwd", "w");
		if ($file) {
			fprintf($file, "\n");
			fclose($file);
		}
	}
	echo "<script>self.location.href='index.php'</script>";
?>
</html>
