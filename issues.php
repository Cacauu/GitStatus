<?php
if (isset($_GET['username']) && isset($_GET['repo'])) {
	$username = $_GET['username'];
	$repo = $_GET['repo'];
}
else {
	$username = 'reevio';
	$repo = 'reevio'; //TODO: Replace with github_statusboard repo
}

if (isset($_GET['limit'])) {
	$per_page = $_GET['limit'];
}
else {
	$per_page = "10";
}

if (isset($_GET['state'])) {
	switch ($_GET['state']) {
		case 'open':
			$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/issues?state=open&page=1&per_page='.$per_page;
			break;

		case 'closed':
			$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/issues?state=closed&page=1&per_page='.$per_page;
			break;

		default:
			$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/issues?state=open&page=1&per_page='.$per_page;
			break;
	}
}

else {
	$url = 'https://api.github.com/repos/'.$username.'/'.$repo.'/issues?page=1&per_page='.$per_page;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//GitHub API request require a user agent, GitStatus uses Chrome UA
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$issues = json_decode(curl_exec($ch), true);
curl_close($ch);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Issues - GitStatus</title>
</head>

<body>
	<table id="issues">
		<?php
		foreach ($issues as $issue) {
		echo '<tr>';
			echo '<td style="width: 40px; height: 30px;"><img style="max-width: 50px; height: auto" src="'.$issue['user']['avatar_url'].'"/></td>';
			echo '<td style="width: 150px;">'.$issue['user']['login'].'</td>';
			echo '<td>'.$issue['title'].'</td>';
		echo '</tr>';
		}
	?>
	</table>
</body>
</html>