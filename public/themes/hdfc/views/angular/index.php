<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
<script src="js/services/commentService.js"></script> <!-- load our service -->
<script src="js/app.js"></script> <!-- load our application -->


<!-- declare our angular app and controller -->
<body class="container" ng-app="commentApp" ng-controller="mainController">
<div class="col-md-8 col-md-offset-2">

	
	
	<pre>
	{{ commentData }}
	</pre>

	
	<div class="comment" ng-hide="loading" ng-repeat="comment in comments">
		<h3>Comment #{{ comment.contents.album_id }} <small>by {{ comment.contents.album_title }}</h3>
		<p>{{ comment.text }}</p>
	</div>

</div>
</body>
</html>
