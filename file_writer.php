﻿<?

echo  "JSON-file writer output \n";

$input_file = 'data.json';
$output_file = 'data.json';

if (isset($_GET['request'])) //change it if POST - check button is clicked and request is sended
{
	$data = $_GET or die ("Error. Request has not contain anything\n"); //change it if POST
	
	$fp = fopen($input_file, 'r');
	
	if ($fp) 
	{
		while (!feof($fp))
		{
			$full_json .= fgets($fp, 9999);
		}
	}
	else
	{
		echo "File1 open error\n";
	}
	
	$decoded_data = json_decode($full_json, true);

	foreach ($data as $key => $value)
	{
		if($key != '_' and $key != 'request')
		{
			$decoded_data[$key] = $value;
		}
	}

	//print_r(urldecode($encoded_data));
	$encoded_data = json_encode($decoded_data) or die("Encoding error \n");
	
	fclose($fp);

	$fp2 = fopen($output_file, 'w') or die('wrong operation1');

	if ($fp2)
	{
		$test = fwrite($fp2,  $encoded_data) or die('wrong operation2'); //old version
		echo 'JSON updated successful';
	}
	else
	{
		echo 'Wrong name';
	}

	fclose($fp2);
}
else
{
	echo "Error! Input array is undefined!\n";
}
?>