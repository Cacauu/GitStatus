#GitStatus

[Changelog](https://GitHub.com/cacauu/gitstatus/wiki/changelog/)

![GitStatus](http://cacauu.de/bilder/GitStatus.PNG)

GitStatus is a package of PHP-scripts to display your GitHub commits, issues and commit activity as widgets in [Statusboard](http://panic.com/statusboard). GitStatus uses the [official GitHub API](http://developer.github.com/v3/) and PHP curl to collect the data and display it a way Statusboard can display them.

##Tables

###Issues

To track issues on a specific repo add ```http://cacauu.de/GitStatus/issues.php?username=USERNAME&repo=REPO``` as data-source to Statusboard and replace USERNAME and REPO with your information.

By default this will display all the open issues from your repo. If you want to see closed issues just add ```&state=closed``` the data-source. 

###Commits

GitStatus also allows you to track commits to a repo. To do so just add ```http://cacauu.de/GitStatus/commits.php?username=USERNAME&repo=REPO``` to Statusboard and replace USERNAME and REPO with your information. 

##Graphs

###Commit activity

GitHub provides really cool graphs about commits to a repo and GitStatus brings these graphs to your Statusboard. Add ```http://cacauu.de/gitstatus/commit_activity.php?username=USERNAME&repo=REPO``` as data-source to a graph on your Statusboard and replace USERNAME and REPO with your information. The graph in Statusboard will display commits per week to the specified repo within the last year. 

##Limit output

You're iPads screen is limited and the size of widgets in Statusboard is too. And sometimes you're only looking for the latest information like the last five commits or just the last three issues. To limit the output of GitStatus simply add ```?limit=LIMIT``` (or ```&limit=LIMIT``` if you already set a GET parameter) to the URL you request and replace LIMIT with the number of issues or commits you want to see.

At the moment GitStatus only works with public repos. 

GitStatus is released under BSD 3.0. See LICENSE.txt for more information. 