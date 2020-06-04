<?php
/**
 * This is just an example of how a file could be processed from the
 * upload script. It should be tailored to your own requirements.
 */

// Only accept files with these extensions
$whitelist = array('dox');
$blacklist = array('csv');
$csv      = null;
$vids      = null;
$error     = 'No file uploaded.';

$acceptList = array_merge($whitelist, $blacklist);


if (isset($_FILES)) {
	if (isset($_FILES['file'])) {
		$tmp_name = $_FILES['file']['tmp_name'];
		$cFile = basename($_FILES['file']['name']);
		$csv     = "../../WIMedia/Docs/csv/" . basename($_FILES['file']['name']);
		$docs     = "../../WIMedia/Docs/" . basename($_FILES['file']['name']);
		$error    = $_FILES['file']['error'];
		
		if ($error === UPLOAD_ERR_OK) {
			$csvextension = pathinfo($csv, PATHINFO_EXTENSION);
			$vidextension = pathinfo($vids, PATHINFO_EXTENSION);

			if (!in_array($csvextension, $acceptList)) {
				$error = 'Invalid file image uploaded.';
			}

			if (!in_array($vidextension, $acceptList)) {
				$error = 'Invalid file csv uploaded.';
			}

			//echo "vid" . $vidextension;
			//echo "black" . $blacklist;

			if (in_array($csvextension,$blacklist)) {
	move_uploaded_file($tmp_name, $csv);
				echo json_encode(array(
	'name'  => $cFile,
	'error' => $error,
));
			}else if(in_array($imgextension, $whitelist)) {
				move_uploaded_file($tmp_name, $imgs);
				//echo $name;
				echo json_encode(array(
	'name'  => $imgs,
	'error' => $error,
));
			}

		}
	}
}


die();
