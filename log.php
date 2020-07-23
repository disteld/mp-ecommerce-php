<?php
	$data = file_get_contents('php://input');
	$f = fopen('raw.txt', 'a');
	fwrite($f, $data);
	fclose($f);
