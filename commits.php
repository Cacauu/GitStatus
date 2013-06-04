<?php
if (isset($_GET['username']) && isset($_GET['repo'])) {
	$username = $_GET['username'];
	$repo = $_GET['repo'];
}
else {
	$username = 'cacauu';
	$repo = 'gitstatus';
}

if (isset($_GET['limit'])) {
	$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/commits?page=1&per_page='.$_GET['limit'];
}
else {
	$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/commits';
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//GitHub API request require a user agent, GitStatus uses Chrome UA
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$commits = json_decode(curl_exec($ch), true);
curl_close($ch);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Commits - GitStatus</title>
</head>

<body>
	<table id="commits">
		<?php
		foreach ($commits as $commit) {
		echo '<tr>';
			echo '<td style="width: 40px; height: 30px"><img style="max-width: 50px; height: auto;" src="'.$commit['author']['avatar_url'].'"/></td>';
			//echo '<td style="width: 200px;">'.$commit['committer']['name'].'</td>';
			//echo '<td>'.$commit['commit']['committer']['date'].'</td>';
			echo '<td>'.$commit['commit']['message'].'</td>';
		echo '</tr>';
		//print $commit['commit']['committer']['name'];
		}
		//var_dump($commits);
	?>
	</table>
</body>
</html>