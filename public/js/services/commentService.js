angular.module('commentService', [])

	.factory('Comment', function($http) {

		return {
			get : function() {
				return $http.get('/laravel/public/top_albums');
			},
			show : function(id) {
				return $http.get('/rest/index.php/comments/test' + id);
			},
			save : function(commentData) {
				return $http({
					method: 'POST',
					url: '/rest/index.php/comments/test',
					headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
					data: $.param(commentData)
				});
			},
			destroy : function(id) {
				return $http.delete('/rest/index.php/comments/test/' + id);
			}
		}

	});
