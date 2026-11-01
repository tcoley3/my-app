<!doctype html>




<head>
	<title>Zoo Analysis</title>
	<link rel="stylesheet" href="style.css">
</head>

<?php

//Variables
$adult = 0;
$child = 0;
$seniors = 0;
$events = 0;
$groups = 0;
$avgAM = 0;
$avgPM = 0;
$avgMembers = 0;
$highestAttend = 0;
$dateOfHA = 0;
$total = 0;
$totalDays = 0;
$currDate = "";


//Read File and put into accessible format

$file = readfile($_POST);
$data = json_decode($file);


//Anaylze data
	
	foreach($day as $data){
		foreach($id as $key => $value){
			//Averages
			if($key == "adult") $adult += $value;
			if($key == "child") $child += $value;
			if($key == "senior") $seniors += $value;
			if($key == "event") $events += $value;
			if($key == "groups") $groups += $value;
			if($key == "am") $avgAM += $value;
			if($key == "pm") $avgPM += $value;
			if($key == "memberships") $avgMembers += $value;
			
			//Day with the highest attendance & Overall total attendees
			if($key == "date") $currDate = $value;
			if($key == "total") {
				$total += $value;
				if($highestAttend < $value) $dateOfHA = $value;
			}
			
		}
		//Total Days
		$totalDays++;
		
	}
	
	
//Average out the averages_vars
$adult /= $totalDays;
$child /= $totalDays;
$seniors /= $totalDays;
$events /= $totalDays;
$groups /= $totalDays;
$avgAM /= $totalDays;
$avgPM /= $totalDays;
$avgMembers /= $totalDays;

//Print data into file

	print "<h2>Questions:</h2>"
	
	print "<div> How many adults went to the zoo? " . $adult . "</div>" 
	print "<div> How many childern went to the zoo? " . $child . "</div>" 
	print "<div> How many seniors went to the zoo? " . $seniors . "</div>" 
	print "<div> How many groups went to the zoo? " . $groups . "</div>" 
	print "<div> On average, How many people went to the zoo in the morning? " . $avgAM . "</div>" 
	print "<div> On average, How many people went to the zoo in the afternoon? " . $avgPM . "</div>" 
	print "<div> How many events did the zoo host? " . $events . "</div>" 
	print "<div> On average, How many memberships occured? " . $avgMembers . "</div>" 
	print "<div> How many people total went to the zoo? " . $total . "</div>" 
	print "<div> What day had the highest attendance? " . $dateOfHA . "</div>" 

?>


<body>

<h1>Zoo Adimissions Analysis</h1>


<form class="file" method="post">

	<input type="file" id="zooFile" accept=".json">
	<input type="submit">


</form>


</body>
