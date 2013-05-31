<?php
header('content-type: application/json');
if (isset($_GET['username']) && isset($_GET['repo'])) {
	$username = $_GET['username'];
	$repo = $_GET['repo'];
}
else {
	$username = 'reevio';
	$repo = 'reevio'; //TODO: Replace with github_statusboard repo
}
$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/stats/commit_activity';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//GitHub API request require a user agent, GitStatus uses Chrome UA
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$commit_activities = json_decode(curl_exec($ch), true);
curl_close($ch);
if (!$commit_activities == "") {
	echo "{";
	echo '"graph" : {';
	echo '"title" : "'.$repo.'",';
	echo '"total" : true,';
	echo '"type" : "bar",';
	echo '"datasequences" : [';
	echo '{';
	echo '"title" : "Commits Per Week",';
	echo '"datapoints" : [';	
	foreach ($commit_activities as $commit_activity) { 
		$week_total = $commit_activity['days']['1'] + $commit_activity['days']['2'] +  $commit_activity['days']['3'] + $commit_activity['days']['4'] + $commit_activity['days']['5'] + $commit_activity['days']['6'] + $commit_activity['days']['0'];
		echo '{ "title" : "'.date('W/Y', $commit_activity['week']).'", "value" : '.$week_total.'},';
	}
	echo ']';
	echo '},';
	echo ']';
	echo '}';
	echo '}';
}
else {
	echo "No commits available";
}
?>