var API_URL = 'http://174.138.100.146:83/';
	
var app = angular.module('menuman', ['ngRoute', 'ui.bootstrap', 'ngAnimate', 'ngSanitize', 'fancyboxplus', 'slick']);

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};
	
app.controller('globalController', function($scope, $http, $rootScope, $route, $routeParams, $location, $interval) {
	$scope.authorized = false;
	$scope.group = 'guest';
	$scope.$route = $route;
	$scope.$location = $location;
	$scope.$routeParams = $routeParams;
	$scope.user_login = '';
	$scope.user_password = '';
	$scope.user_id = 0;
	$scope.register = {};
	$scope.register.group_name = 'client';
	$scope.register.user_login = '';
	$scope.notifications = 0;
	$scope.notify = [];
	$scope.allnotif = [];
	$scope.search_tab = 1;
	localStorage.setItem("city", 2);
	$rootScope.$on('$routeChangeSuccess', function() {
		document.title = $route.current.title;
	});
	var token = localStorage.getItem("token");
	
	if (token) {
		$http.get(API_URL + 'auth/token?token=' + token).then(function(data) {
            if (data.data.access == true)
			{
				$scope.authorized = true;
				$scope.group = data.data.user.user_type;
				$scope.user_id = data.data.user.id;
				localStorage.setItem("user", JSON.stringify(data.data.user));
				getNotifications();
			}
        }, function(data) {
            console.log(data);
        });
	}
	$interval(getNotifications, 5000);
	
	function getNotifications() {
		$http.get(API_URL + 'notifications/all?user_id=' + $scope.user_id).then(function(data) {
		    for (i = 0; i < data.data.length; i++) {
			data.data[i].create_date = dateFormat(data.data[i].create_date, 'UTC:dddd, d mmmm, yyyy, HH:MM');
		    };
		    $scope.allnotif = data.data;
		});
		$http.get(API_URL + 'notifications?user_id=' + $scope.user_id).then(function(data) {
			if (data.data.length > $scope.notifications) { /* sound notify */ }
			$scope.notifications = data.data.length;
			$scope.notify = [];
			for (i in data.data)
			{
				if ($scope.group == 'company') {
					$scope.notify[data.data[i].place_id] = {};
					$scope.notify[data.data[i].place_id].booking = 0;
					$scope.notify[data.data[i].place_id].reviews = 0;
					$scope.notify[data.data[i].place_id].loyality = 0;
				}
				else if ($scope.group == 'client')
				{
					$scope.notify = {};
					$scope.notify.booking = 0;
					$scope.notify.reviews = 0;
					$scope.notify.loyality = 0;
					$scope.notify.promotions = 0;
				}
			}
			for (i in data.data) {
				if ($scope.group == 'company') {
					if (data.data[i].not_table == 'booking') $scope.notify[data.data[i].place_id].booking = $scope.notify[data.data[i].place_id].booking + 1;
					else if (data.data[i].not_table == 'reviews') $scope.notify[data.data[i].place_id].reviews = $scope.notify[data.data[i].place_id].reviews + 1;
					else if (data.data[i].not_table == 'loyality') $scope.notify[data.data[i].place_id].loyality = $scope.notify[data.data[i].place_id].loyality + 1;
				}
				else if ($scope.group == 'client')
				{
					if (data.data[i].not_table == 'booking') $scope.notify.booking = $scope.notify.booking + 1;
					else if (data.data[i].not_table == 'reviews') $scope.notify.reviews = $scope.notify.reviews + 1;
					else if (data.data[i].not_table == 'loyality') $scope.notify.loyality = $scope.notify.loyality + 1;
					else if (data.data[i].not_table == 'promotions') $scope.notify.promotions = $scope.notify.promotions + 1;
				}
			}
		}, function(data) {
			console.log(data);
		});
	}
	$scope.login = function() {
		$http.get(API_URL + 'auth/login?email=' + $scope.user_login + '&password=' + $scope.user_pass).then(function(data) {
            if (data.data.access == true)
			{
				$scope.authorized = true;
				$scope.group = data.data.user.user_type;
				$scope.user_id = data.data.user.id;
				localStorage.setItem("token", data.data.token);
				localStorage.setItem("user", JSON.stringify(data.data.user));
				$("#login").modal('hide');
			}
        }, function(data) {
            console.log(data);
        });
	}
	$scope.logout = function() {
		localStorage.removeItem("token");
		localStorage.removeItem("user");
		$scope.authorized = false;
	}
	$scope.registration = function() {
		console.log($scope.register);
		var data = {};
		data.email = $scope.register.user_login;
		data.user_type = $scope.register.group_name;
		$http.put(API_URL + 'auth/register', data).then(function(data) {
            if (data.data.id)
			{
				$("#regForm").hide();
				$("#registerSuccess").show();
			}
        }, function(data) {
            console.log(data);
        });
	}
	user = localStorage.getItem("user");
	var nowd = new Date();
	var now = new Date(dateFormat(nowd, 'yyyy-mm-dd'));
	$http.get(API_URL + 'places/get?city=1&order=rating&direction=DESC&limit=6&offset=0&subway_stations=[]&place_types=[]&kitchen_types=[]&search=').then(function(data) {
		for (i in data.data) { 
			begin = new Date(dateFormat(data.data[i].discount_begins, 'yyyy-mm-dd'));
			end = new Date(dateFormat(data.data[i].discount_ends, 'yyyy-mm-dd'));
			if (end < now || begin > now) data.data[i].discount = 0; 
		}
		console.log(data.data);
		$scope.mainplaces = data.data;
	});
	$http.get(API_URL + 'goods/get?city=1&order=rating&direction=DESC&limit=6&offset=0&subway_stations=[]&place_types=[]&kitchen_types=[]&search=').then(function(data) {
		$scope.maingoods = data.data;
	});
});

app.controller('homeController', function($scope, $http) {
});

app.controller('placesController', function($scope, $http) {
	$scope.tab = 1;
	$scope.order = 'rating';
	$scope.city = localStorage.getItem("city");
	$scope.subway_stations = [];
	$scope.place_types = [];
	$scope.kitchen_types = [];
	$scope.subwayStationList = {};
	$scope.placeTypesList = {};
	$scope.kitchenTypesList = {};
	$scope.subwayStationChecks = {};
	$scope.placeTypesChecks = {};
	$scope.kitchenTypesChecks = {};
	$scope.search = '';
	$scope.addr = '';
	$scope.radius = '50';
	$scope.page = 0;
	$scope.places = [];
	var locations = [];
	var nowd = new Date();
	var now = new Date(dateFormat(nowd, 'yyyy-mm-dd'));
	var map;
	var markerCluster = false;
	var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$http.get(API_URL + 'assets/subwayStations?city_ID=' + $scope.city).then(function(data) {
		$scope.subwayStations = data.data;
		for (i in $scope.subwayStations) { 
			$scope.subwayStationList[$scope.subwayStations[i].id] = $scope.subwayStations[i].station_name; 
			$scope.subwayStationChecks[$scope.subwayStations[i].id] = false;
		};
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/placeTypes').then(function(data) {
		$scope.placeTypes = data.data;
		for (i in $scope.placeTypes) { 
			$scope.placeTypesList[$scope.placeTypes[i].id] = $scope.placeTypes[i].slug; 
			$scope.placeTypesChecks[$scope.placeTypes[i].id] = false;
		};
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/kitchenTypes').then(function(data) {
		$scope.kitchenTypes = data.data;
		for (i in $scope.kitchenTypes) { 
			$scope.kitchenTypesList[$scope.kitchenTypes[i].id] = $scope.kitchenTypes[i].slug; 
			$scope.kitchenTypesChecks[$scope.kitchenTypes[i].id] = false;
		};
	}, function(data) {
		console.log(data);
	});
	
	var defaultBounds = new google.maps.LatLngBounds(
	new google.maps.LatLng(55.519302117174405, 37.26287841796876),
	new google.maps.LatLng(55.93074077571185, 38.001708984375));

	var input = document.getElementById('map_addr');
	var options = {
	  bounds: defaultBounds
	};

	$scope.autocomplete = new google.maps.places.Autocomplete(input, options);
	//console.log(autocomplete);
	
	$scope.initMap = function() {
        map = new google.maps.Map(document.getElementById('map'), {
			zoom: 10,
			center: new google.maps.LatLng(55.4507, 37.3656),
			mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var markers = locations.map(function(location, i) {
			return new google.maps.Marker({
				position: location,
				label: labels[i % labels.length]
			});
        });
		map.setCenter(new google.maps.LatLng(40.3943872, 49.8542179));
        markerCluster = new MarkerClusterer(map, markers, { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });

        google.maps.event.addListener(markers, 'click', function() {
		    window.location.href = this.url;
		});
	}
	
	$scope.getResultByLocation = function() {
		if ($scope.page == 0) $scope.places = [];
		var place = $scope.autocomplete.getPlace();
		if ($scope.addr == '') { $scope.getResult(); return; }
		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		$http.get(API_URL + 'places/getByLocation?lat=' + lat + '&lng=' + lng + '&radius=' + $scope.radius + '&city=' + $scope.city + '&order=' + $scope.order + '&direction=DESC&limit=12&offset=' + $scope.page + '&subway_stations=' + JSON.stringify($scope.subway_stations) + '&place_types=' + JSON.stringify($scope.place_types) + '&kitchen_types=' + JSON.stringify($scope.kitchen_types)).then(function(data) {
			for (i in data.data)
			{
				begin = new Date(dateFormat(data.data[i].discount_begins, 'yyyy-mm-dd'));
				end = new Date(dateFormat(data.data[i].discount_ends, 'yyyy-mm-dd'));
				if (end < now || begin > now) data.data[i].discount = 0; 
			}
			$scope.places = $scope.places.concat(data.data);
			//console.log(markerCluster);
			if (markerCluster) 
			{
				markerCluster.clearMarkers();
				//markerCluster.getMarkers();
				//for (i in marks) markerCluster.removeMarker(marks[i]);
			}
			marker = new google.maps.Marker({
				position: {
					lat: lat,
					lng: lng
				},
				label: $scope.addr,
				icon: {
			      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
			    }
			});
			markerCluster.addMarker(marker);
			for (i in $scope.places)
			{
				if ($scope.places[i].lat && $scope.places[i].lng)
				{
					coord = {};
					coord.lat = Number($scope.places[i].lat);
					coord.lng = Number($scope.places[i].lng);
					locations.push(coord);
					if (markerCluster)
					{
						marker = new google.maps.Marker({
							position: coord,
							label: $scope.places[i].name,
							url: '/' + $scope.places[i].slug
						});
						markerCluster.addMarker(marker);
					}
					google.maps.event.addListener(marker, 'click', function() {
					    window.location.href = this.url;
					});
				}			
			}
			
		}, function(data) {
			console.log(data);
		});
	}

	$scope.getResult = function() {
		if ($scope.page == 0) $scope.places = [];
		$http.get(API_URL + 'places/get?city=' + $scope.city + '&order=' + $scope.order + '&direction=DESC&limit=100&offset=' + $scope.page + '&subway_stations=' + JSON.stringify($scope.subway_stations) + '&place_types=' + JSON.stringify($scope.place_types) + '&kitchen_types=' + JSON.stringify($scope.kitchen_types) + '&search=' + $scope.search.toLowerCase()).then(function(data) {
			//$scope.page += 12;
			for (i in data.data)
			{
				begin = new Date(dateFormat(data.data[i].discount_begins, 'yyyy-mm-dd'));
				end = new Date(dateFormat(data.data[i].discount_ends, 'yyyy-mm-dd'));
				if (end < now || begin > now) data.data[i].discount = 0; 
			}
			//console.log($scope.places);
			$scope.places = $scope.places.concat(data.data);
			//console.log($scope.places);
			if (markerCluster) 
			{
				markerCluster.clearMarkers();
				/*marks = markerCluster.getMarkers();
				console.log(marks);
				for (i in marks) { console.log(i); markerCluster.removeMarker(marks[i]); }*/
			}
			for (i in $scope.places)
			{
				if ($scope.places[i].lat && $scope.places[i].lng)
				{
					coord = {};
					coord.lat = Number($scope.places[i].lat);
					coord.lng = Number($scope.places[i].lng);
					locations.push(coord);
					if (markerCluster)
					{
						marker = new google.maps.Marker({
							position: coord,
							label: $scope.places[i].name,
							url: '/' + $scope.places[i].slug
						});
						markerCluster.addMarker(marker);
					}
					google.maps.event.addListener(marker, 'click', function() {
					    window.location.href = this.url;
					});
				}			
			}
			
		}, function(data) {
			console.log(data);
		});
	}
	$scope.push_subway_station = function(station) {
		if ($scope.subway_stations.indexOf(station) == -1) 
		{
			$scope.subway_stations.push(station);
			$scope.subwayStationChecks[station] = true;
		}
		else 
		{
			$scope.subway_stations.remove(station);
			$scope.subwayStationChecks[station] = false;
		}
		$scope.page = 0;
		$scope.places = [];
		$scope.getResult();
	}
	$scope.push_place_type = function(place_type) {
		if ($scope.place_types.indexOf(place_type) == -1) 
		{
			$scope.place_types.push(place_type);
			$scope.placeTypesChecks[place_type] = true;
		}
		else 
		{
			$scope.place_types.remove(place_type);
			$scope.placeTypesChecks[place_type] = false;
		}
		$scope.page = 0;
		$scope.places = [];
		$scope.getResult();
	}
	$scope.push_kitchen_type = function(kitchen_type) {
		if ($scope.kitchen_types.indexOf(kitchen_type) == -1) 
		{
			$scope.kitchen_types.push(kitchen_type);
			$scope.kitchenTypesChecks[kitchen_type] = true;
		}
		else 
		{
			$scope.kitchen_types.remove(kitchen_type);
			$scope.kitchenTypesChecks[kitchen_type] = false;
		}
		$scope.page = 0;
		$scope.places = [];
		$scope.getResult();
	}
	
	$scope.getResult();
	$scope.initMap();
	$scope.resizeMap = function() {
		if (!$scope.flag)
		{
			$scope.initMap();
			map.setCenter(new google.maps.LatLng(40.3943872, 49.8542179));
			window.setTimeout(function() { 
				google.maps.event.trigger(map, 'resize'); 
			}, 1);
		}
		$scope.flag = 1;
	}
	$scope.flag = 0;
	$scope.resizeMap();
	$scope.deleteMap = function()
	{
		//map = {};
		//document.getElementById('map').html('');
	}
});

app.controller('goodsController', function($scope, $http) {
	$scope.tab = 1;
	$scope.page = 1;
	$scope.order = 'rating';
	$scope.city = localStorage.getItem("city");
	$scope.subway_stations = [];
	$scope.place_types = [];
	$scope.kitchen_types = [];
	$scope.subwayStationList = {};
	$scope.placeTypesList = {};
	$scope.kitchenTypesList = {};
	$scope.subwayStationChecks = {};
	$scope.placeTypesChecks = {};
	$scope.kitchenTypesChecks = {};
	$scope.search = '';
	$scope.goods = [];
	var locations = [];
	var map;
	var markerCluster = false;
	var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$http.get(API_URL + 'assets/subwayStations?city_ID=' + $scope.city).then(function(data) {
		$scope.subwayStations = data.data;
		for (i in $scope.subwayStations) { 
			$scope.subwayStationList[$scope.subwayStations[i].id] = $scope.subwayStations[i].station_name; 
			$scope.subwayStationChecks[$scope.subwayStations[i].id] = false;
		};
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/placeTypes').then(function(data) {
		$scope.placeTypes = data.data;
		for (i in $scope.placeTypes) { 
			$scope.placeTypesList[$scope.placeTypes[i].id] = $scope.placeTypes[i].slug; 
			$scope.placeTypesChecks[$scope.placeTypes[i].id] = false;
		};
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/kitchenTypes').then(function(data) {
		$scope.kitchenTypes = data.data;
		for (i in $scope.kitchenTypes) { 
			$scope.kitchenTypesList[$scope.kitchenTypes[i].id] = $scope.kitchenTypes[i].slug; 
			$scope.kitchenTypesChecks[$scope.kitchenTypes[i].id] = false;
		};
	}, function(data) {
		console.log(data);
	});
	
	$scope.initMap = function() {
        map = new google.maps.Map(document.getElementById('map'), {
			zoom: 10,
			center: new google.maps.LatLng(55.75803177, 37.6171875),
			mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var markers = locations.map(function(location, i) {
			return new google.maps.Marker({
				position: location,
				label: labels[i % labels.length]
			});
        });
		map.setCenter(new google.maps.LatLng(40.3943872, 49.8542179));
        markerCluster = new MarkerClusterer(map, markers, { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });
	}
	
	$scope.incpage = function() {
	    $scope.page++;
	}
	
	$scope.getResult = function() {
		$http.get(API_URL + 'goods/get?city=' + $scope.city + '&order=' + $scope.order + '&direction=DESC&limit=12&offset=' + (($scope.page - 1)*12) + '&subway_stations=' + JSON.stringify($scope.subway_stations) + '&place_types=' + JSON.stringify($scope.place_types) + '&kitchen_types=' + JSON.stringify($scope.kitchen_types) + '&search=' + $scope.search.toLowerCase()).then(function(data) {
			$scope.goods = $scope.goods.concat(data.data);
			console.log($scope.goods);
			if (markerCluster) 
			{
				markerCluster.getMarkers();
				for (i in marks) markerCluster.removeMarker(marks[i]);
			}
			for (i in $scope.goods)
			{
				if ($scope.goods[i].lat && $scope.goods[i].lng)
				{
					coord = {};
					coord.lat = Number($scope.goods[i].lat);
					coord.lng = Number($scope.goods[i].lng);
					locations.push(coord);
					if (markerCluster)
					{
						marker = new google.maps.Marker({
							position: coord,
							label: labels[i % labels.length]
						});
						markerCluster.addMarker(marker);
					}
				}			
			}
			
		}, function(data) {
			console.log(data);
		});
	}
	$scope.push_subway_station = function(station) {
		if ($scope.subway_stations.indexOf(station) == -1) 
		{
			$scope.subway_stations.push(station);
			$scope.subwayStationChecks[station] = true;
		}
		else 
		{
			$scope.subway_stations.remove(station);
			$scope.subwayStationChecks[station] = false;
		}
		$scope.page = 1;
		$scope.goods = [];
		$scope.getResult();
	}
	$scope.push_place_type = function(place_type) {
		if ($scope.place_types.indexOf(place_type) == -1) 
		{
			$scope.place_types.push(place_type);
			$scope.placeTypesChecks[place_type] = true;
		}
		else 
		{
			$scope.place_types.remove(place_type);
			$scope.placeTypesChecks[place_type] = false;
		}
		$scope.page = 1;
		$scope.goods = [];
		$scope.getResult();
	}
	$scope.push_kitchen_type = function(kitchen_type) {
		if ($scope.kitchen_types.indexOf(kitchen_type) == -1) 
		{
			$scope.kitchen_types.push(kitchen_type);
			$scope.kitchenTypesChecks[kitchen_type] = true;
		}
		else 
		{
			$scope.kitchen_types.remove(kitchen_type);
			$scope.kitchenTypesChecks[kitchen_type] = false;
		}
		$scope.page = 1;
		$scope.goods = [];
		$scope.getResult();
	}
	
	$scope.getResult();
	$scope.flag = 0;
	$scope.resizeMap = function() {
		if (!$scope.flag)
		{
			$scope.initMap();
			map.setCenter(new google.maps.LatLng(40.3943872, 49.8542179));
			window.setTimeout(function() { 
				google.maps.event.trigger(map, 'resize'); 
			}, 1);
		}
		$scope.flag = 1;
	}
	$scope.deleteMap = function()
	{
		//map = {};
		//document.getElementById('map').html('');
	}
});

app.controller('dashboardController', function($scope, $http) {
	$scope.tab = 1;
	var token = localStorage.getItem("token");
	if (token) {
		$http.get(API_URL + 'dashboard/places?token=' + token).then(function(data) {		
            $scope.places = data.data;
        }, function(data) {
            console.log(data);
        });
		$http.get(API_URL + 'dashboard/network?token=' + token).then(function(data) {
            $scope.networks = data.data;
			
        }, function(data) {
            console.log(data);
        });
	}
	$scope.deleteNetwork = function(id) {
	    if (confirm('Вы действительно хотите удалить эту сеть заведений?')) {
	    $http.delete(API_URL + 'dashboard/network?token=' + token + '&id=' + id).then(function(data) {
		    $http.get(API_URL + 'dashboard/network?token=' + token).then(function(data) {
			$scope.networks = data.data;

		    }, function(data) {
			console.log(data);
		    });
		    
		}, function(data) {
		    console.log(data);
		});
	}
    }
});

app.controller('dashboardAddPlaceController', function($scope, $http, $location) {
	$scope.place = {};
	var token = localStorage.getItem("token");
	$scope.place.token = token;
	$scope.place.subway_stations = [];
	$scope.place.place_types = [];
	$scope.place.kitchen_types = [];
	$scope.place.images = [];
	$scope.place.cover_image = '';
	$scope.place.name = '';
	$scope.place.address = '';
	$scope.place.city = '';
	$scope.place.lat = '';
	$scope.place.lng = '';
	$scope.place.phone = '';
	$scope.place.web = '';
	$scope.place.about = '';
	$scope.place.additional = [];
	$scope.place.middle = 0;
	$scope.place.planing = [];
	$scope.place.logo = '';
	$scope.subwayStationChecks = {};
	$scope.placeTypesChecks = {};
	$scope.kitchenTypesChecks = {};
	
	$scope.apiurl = API_URL;
	var token = localStorage.getItem("token");
	
	$scope.city = localStorage.getItem("city");
	$http.get(API_URL + 'assets/subwayStations?city_ID=' + $scope.city).then(function(data) {
		$scope.subwayStations = data.data;
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/placeTypes').then(function(data) {
		$scope.placeTypes = data.data;
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/kitchenTypes').then(function(data) {
		$scope.kitchenTypes = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$http.get(API_URL + 'assets/cities?country_ID=2').then(function(data) {
		$scope.place.city = data.data[0].id;
		$scope.cities = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$scope.push_subway_station = function(station) {
		station = parseInt(station);
		if ($scope.place.subway_stations.indexOf(station) == -1) $scope.place.subway_stations.push(station);
		else $scope.place.subway_stations.remove(station);
	}
	$scope.push_place_type = function(place_type) {
		place_type = parseInt(place_type);
		if ($scope.place.place_types.indexOf(place_type) == -1) $scope.place.place_types.push(place_type);
		else $scope.place.place_types.remove(place_type);
	}
	$scope.push_kitchen_type = function(kitchen_type) {
		kitchen_type = parseInt(kitchen_type);
		if ($scope.place.kitchen_types.indexOf(kitchen_type) == -1) $scope.place.kitchen_types.push(kitchen_type);
		else $scope.place.kitchen_types.remove(kitchen_type);
	}
	
	$scope.save = function() {
		$http.put(API_URL + 'places/add', $scope.place).then(function(data) {
			console.log(data);
            alert('Заведение успешно добавлено в систему');
			$location.path('/dashboard').replace();
        }, function(data) {
            console.log(data);
        });
	};
	
	$scope.deleteImage = function(image) {
		if ($scope.place.cover_image == image) $scope.place.cover_image = '';
		if ($scope.place.images.indexOf(image) == -1) $scope.place.images.push(image);
		else $scope.place.images.remove(image);
	};
	
	$scope.addAditional = function() {
		$scope.place.additional.push('');
	};
	
	$scope.deleteAdditional = function(key)
	{
		$scope.place.additional.splice(key, 1);
	}
	
	Dropzone.autoDiscover = false;
	
	$("#object-photo").dropzone({
		url: 'http://139.59.151.232:83/upload',
		acceptedFiles: 'image/*',
		timeout: 1000000,
		method: "post",
		success: function (file, response) {  console.log($scope.subwayStations);
			file.previewElement.classList.add("dz-success");
			$scope.$apply(function() {
				$scope.place.images.push(response.originalname);
			});
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});
	
	$(function(){var k=0;function initialize_map(){if(document.getElementById("map")){var latValue="40.3943872";var lngValue="49.8542179";var haightAshbury=new google.maps.LatLng(latValue,lngValue);var mapOptions={zoom:13,center:haightAshbury,mapTypeId:google.maps.MapTypeId.ROADMAP};mapAddMark=new google.maps.Map(document.getElementById("map"),mapOptions);google.maps.event.addListener(mapAddMark,'click',function(event){if(k<1){addMarker(event.latLng);}});}else if(document.getElementById("map_show")){var latValue=$scope.place.lat;var lngValue=$scope.place.lng;var haightAshbury=new google.maps.LatLng(latValue,lngValue);var mapOptions={zoom:13,center:haightAshbury,mapTypeId:google.maps.MapTypeId.ROADMAP};mapAddMark=new google.maps.Map(document.getElementById("map_show"),mapOptions);console.log(mapAddMark);marker=new google.maps.Marker({position:haightAshbury,map:mapAddMark,title:""});}else if(document.getElementById("map_admin")){var latValue=$scope.place.lat?$scope.place.lat:"55.753950543675224";var lngValue=$scope.place.lng?$scope.place.lng:"37.620792388916016";var lat=$scope.place.lat;var lng=$scope.place.lng;var haightAshbury=new google.maps.LatLng(latValue,lngValue);var mapOptions={zoom:13,center:haightAshbury,mapTypeId:google.maps.MapTypeId.ROADMAP};mapAddMark=new google.maps.Map(document.getElementById("map_admin"),mapOptions);if((lat!="")&&(lng!="")){marker=new google.maps.Marker({position:haightAshbury,map:mapAddMark,title:"",draggable:true});google.maps.event.addListener(marker,'dragend',function(event){if(confirm('Изменить маркер?')){latlng=event.latLng.toString().split(",");lat=latlng[0].split("(")[1];lng=latlng[1].split(")")[0];
	$scope.$apply(function() { $scope.place.lat = lat; $scope.place.lng = lng; console.log($scope.place); });
	document.getElementById('gmap_msg').innerHTML="Данные изменены.";}})}else{google.maps.event.addListener(mapAddMark,'click',function(event){if(k<1){addMarker(event.latLng);}});}}}function addMarker(location){k++;marker=new google.maps.Marker({position:location,map:mapAddMark,title:"",draggable:true});google.maps.event.addListener(marker,'click',function(event){if(confirm('Добавить маркер?')){latlng=event.latLng.toString().split(",");lat=latlng[0].split("(")[1];lng=latlng[1].split(")")[0];document.getElementById('lat').value=lat;document.getElementById('lng').value=lng;document.getElementById('gmap_msg').innerHTML="Данные добавлены.";}})
	google.maps.event.addListener(marker,'dragend',function(event){if(confirm('Изменить маркер?')){latlng=event.latLng.toString().split(",");lat=latlng[0].split("(")[1];lng=latlng[1].split(")")[0];$scope.$apply(function() { $scope.place.lat = lat; $scope.place.lng = lng;  });document.getElementById('gmap_msg').innerHTML="Данные изменены.";}})}initialize_map();});
});

app.controller('dashboardEditPlaceController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.place = {};
	var token = localStorage.getItem("token");
	$scope.place.slug = $scope.$routeParams.slug;
	$scope.place.token = token;
	$scope.place.subway_stations = [];
	$scope.place.place_types = [];
	$scope.place.kitchen_types = [];
	$scope.place.images = [];
	$scope.place.cover_image = '';
	$scope.place.name = '';
	$scope.place.address = '';
	$scope.place.city = '';
	$scope.place.lat = '';
	$scope.place.lng = '';
	$scope.place.phone = '';
	$scope.place.web = '';
	$scope.place.about = '';
	$scope.place.additional = [];
	$scope.place.middle = 0;
	$scope.place.planing = [];
	$scope.place.logo = '';
	$scope.subwayStationChecks = {};
	$scope.placeTypesChecks = {};
	$scope.kitchenTypesChecks = {};
	$scope.city = localStorage.getItem("city");
	
	$http.get(API_URL + 'assets/subwayStations?city_ID=' + $scope.city).then(function(data) {
		$scope.subwayStations = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place = data.data[0];
		if ($scope.place.subway_stations == null) $scope.place.subway_stations = [];
		if ($scope.place.place_types == null) $scope.place.place_types = [];
		if ($scope.place.kitchen_types == null) $scope.place.kitchen_types = [];
		for (i in $scope.place.subway_stations) $scope.subwayStationChecks[$scope.place.subway_stations[i]] = true;
		for (i in $scope.place.place_types) $scope.placeTypesChecks[$scope.place.place_types[i]] = true;
		for (i in $scope.place.kitchen_types) $scope.kitchenTypesChecks[$scope.place.kitchen_types[i]] = true;
		console.log($scope.place);
	}, function(data) {
		console.log(data);
	});
	$scope.city = localStorage.getItem("city");
	
	$http.get(API_URL + 'assets/placeTypes').then(function(data) {
		$scope.placeTypes = data.data;
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'assets/kitchenTypes').then(function(data) {
		$scope.kitchenTypes = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$http.get(API_URL + 'assets/cities?country_ID=2').then(function(data) {
		$scope.place.city = data.data[0].id;
		$scope.cities = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$scope.push_subway_station = function(station) {
		station = parseInt(station);
		if ($scope.place.subway_stations.indexOf(station) == -1) $scope.place.subway_stations.push(station);
		else $scope.place.subway_stations.remove(station);
		console.log($scope.place.subway_stations);
	}
	$scope.push_place_type = function(place_type) {
		place_type = parseInt(place_type);
		if ($scope.place.place_types.indexOf(place_type) == -1) $scope.place.place_types.push(place_type);
		else $scope.place.place_types.remove(place_type);
	}
	$scope.push_kitchen_type = function(kitchen_type) {
		kitchen_type = parseInt(kitchen_type);
		if ($scope.place.kitchen_types.indexOf(kitchen_type) == -1) $scope.place.kitchen_types.push(kitchen_type);
		else $scope.place.kitchen_types.remove(kitchen_type);
	}
	
	$scope.save = function() { console.log($scope.place);
		$scope.place.token = token;
		$scope.place.slug = $scope.$routeParams.slug;
		$http.post(API_URL + 'places/edit', $scope.place).then(function(data) {
			console.log(data);
            alert('Заведение успешно обновлено');
			$location.path('/dashboard').replace();
        }, function(data) {
            console.log(data);
        });
	};
	
	$scope.deleteAdditional = function(key)
	{
		$scope.place.additional.splice(key, 1);
	}
	
	$scope.deleteImage = function(image) {
		if ($scope.place.cover_image == image) $scope.place.cover_image = '';
		if ($scope.place.images.indexOf(image) == -1) $scope.place.images.push(image);
		else $scope.place.images.remove(image);
	};
	
	$scope.addAditional = function() {
		if ($scope.place.additional == null) $scope.place.additional = [];
		$scope.place.additional.push('');
	};
	
	Dropzone.autoDiscover = false;
	
	$("#object-photo").dropzone({
		url: 'http://139.59.151.232:83/upload',
		acceptedFiles: 'image/*',
		timeout: 1000000,
		method: "post",
		success: function (file, response) {  console.log($scope.subwayStations);
			file.previewElement.classList.add("dz-success");
			$scope.$apply(function() {
				$scope.place.images.push(response.originalname);
			});
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});
	
	$(function() {
		var k=0;
		function initialize_map() {
			if (document.getElementById("map")) {
				var latValue="40.3943872";
				var lngValue="49.8542179";
				var haightAshbury = new google.maps.LatLng(latValue,lngValue);
				var mapOptions={zoom:13,center:haightAshbury,mapTypeId:google.maps.MapTypeId.ROADMAP};
				mapAddMark=new google.maps.Map(document.getElementById("map"),mapOptions);
				google.maps.event.addListener(mapAddMark,'click',function(event) {
					if(k<1) {
						addMarker(event.latLng);
					}
				});
			} else if (document.getElementById("map_show")) {
				var latValue=$scope.place.lat;
				var lngValue=$scope.place.lng;
				var haightAshbury=new google.maps.LatLng(latValue,lngValue);
				var mapOptions={zoom:13,center:haightAshbury,mapTypeId:google.maps.MapTypeId.ROADMAP};
				mapAddMark=new google.maps.Map(document.getElementById("map_show"),mapOptions);
				console.log(mapAddMark);
				marker=new google.maps.Marker({position:haightAshbury,map:mapAddMark,title:""});
			}
			else if(document.getElementById("map_admin")) { 
				var latValue=$scope.place.lat?$scope.place.lat:"40.3943872";
				var lngValue=$scope.place.lng?$scope.place.lng:"49.8542179";
				var lat=$scope.place.lat;
				var lng=$scope.place.lng;
				var haightAshbury=new google.maps.LatLng(latValue,lngValue);
				var mapOptions={zoom:13,center:haightAshbury,mapTypeId:google.maps.MapTypeId.ROADMAP};
				mapAddMark=new google.maps.Map(document.getElementById("map_admin"),mapOptions);
				if((lat!="")&&(lng!="")) {
					marker=new google.maps.Marker({position:haightAshbury,map:mapAddMark,title:"",draggable:true});
					google.maps.event.addListener(marker,'dragend',function(event){
						if(confirm('Изменить маркер?')) {
							latlng=event.latLng.toString().split(",");
							lat=latlng[0].split("(")[1];lng=latlng[1].split(")")[0];
							$scope.$apply(function() { 
								$scope.place.lat = lat; 
								$scope.place.lng = lng; 
								console.log($scope.place);
							 });
							document.getElementById('gmap_msg').innerHTML="Данные изменены.";
						}
					});
				} else { 
					google.maps.event.addListener(mapAddMark,'click',function(event) { 
						if(k<1) { 
							addMarker(event.latLng);
						}
					});
				}
			}
		}
		function addMarker(location){ 
			k++;
			marker=new google.maps.Marker({position:location,map:mapAddMark,title:"",draggable:true});
			google.maps.event.addListener(marker,'click',function(event) {
				if(confirm('Добавить маркер?')) { 
					latlng=event.latLng.toString().split(",");
					lat=latlng[0].split("(")[1];
					lng=latlng[1].split(")")[0];
					document.getElementById('lat').value=lat;
					document.getElementById('lng').value=lng;
					document.getElementById('gmap_msg').innerHTML="Данные добавлены.";
				}
			});
			google.maps.event.addListener(marker,'dragend',function(event) {
				if(confirm('Изменить маркер?')){
					latlng=event.latLng.toString().split(",");
					lat=latlng[0].split("(")[1];
					lng=latlng[1].split(")")[0];
					$scope.$apply(function() { 
						$scope.place.lat = lat; 
						$scope.place.lng = lng;  
					});
					document.getElementById('gmap_msg').innerHTML="Данные изменены.";
				}
			})
		}
		initialize_map();
	});
});

app.controller('dashboardMenuController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.place = [];
	$scope.place.slug = $scope.$routeParams.slug;
	$scope.menu = [];
	$scope.places = [];
	$scope.menuforcopy = 0;
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/places?token=' + token).then(function(data) {		
            $scope.places = data.data;
	    for (i in $scope.places) if ($scope.places[i].slug == $scope.$routeParams.slug) $scope.places.splice(i, 1);
        }, function(data) {
            console.log(data);
        });
	$scope.getnewmenu = function() {
	    $http.get(API_URL + 'menu?search=&place_id=' + $scope.menuforcopy).then(function(data) {
			for (i in data.data)
			{
			    delete data.data[i].id;
			    data.data[i].place_id = $scope.place_id; 
				if (!data.data[i].groups) data.data[i].groups = [];
				for (j in data.data[i].groups)
				{
				    data.data[i].groups[j].menu_id = 0;
				    delete data.data[i].groups[j].id;
					if (!data.data[i].groups[j].subgroups) data.data[i].groups[j].subgroups = [];
					if (!data.data[i].groups[j].goods) data.data[i].groups[j].goods = [];
					for (k in data.data[i].groups[j].subgroups)
					{
					    delete data.data[i].groups[j].subgroups[k].id;
					    data.data[i].groups[j].subgroups[k].group_id = 0;
						if (!data.data[i].groups[j].subgroups[k].goods) data.data[i].groups[j].subgroups[k].goods = [];
						for (l in data.data[i].groups[j].subgroups[k].goods) {
						    delete data.data[i].groups[j].subgroups[k].goods[l].id;
						    data.data[i].groups[j].subgroups[k].goods[l].group_id = 0;
						}
					}
					for (l in data.data[i].groups[j].goods) {
					    delete data.data[i].groups[j].goods[l].id;
					    data.data[i].groups[j].goods[l].group_id = 0;
					}
				}
			}
			for (i in $scope.menu) {
			    $scope.menu[i].place_id = -1;
			}
			$scope.menu = $scope.menu.concat(data.data);
			var z = $scope.menu;
			console.log(z);
			//for (i in $scope.menu) $scope.menu[i].place_id = $scope.place_id;
			console.log(data);
		}, function(data) {
			console.log(data);
		});
	}
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$http.get(API_URL + 'menu?search=&place_id=' + $scope.place_id).then(function(data) {
			for (i in data.data)
			{
				if (!data.data[i].groups) data.data[i].groups = [];
				for (j in data.data[i].groups)
				{
					if (!data.data[i].groups[j].subgroups) data.data[i].groups[j].subgroups = [];
					if (!data.data[i].groups[j].goods) data.data[i].groups[j].goods = [];
					for (k in data.data[i].groups[j].subgroups)
					{
						if (!data.data[i].groups[j].subgroups[k].goods) data.data[i].groups[j].subgroups[k].goods = [];
					}
				}
			}
			$scope.menu = data.data;
			console.log(data);
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.changeMenuVisibility = function(key) {
	    for (i in $scope.menu[key].groups) {
		$scope.menu[key].groups[i].visibility = $scope.menu[key].visibility;
		for (j in $scope.menu[key].groups[i].goods) {
		    $scope.menu[key].groups[i].goods[j].visibility = $scope.menu[key].visibility;
		}
		for (j in $scope.menu[key].groups[i].subgroups) {
		    $scope.menu[key].groups[i].subgroups[j].visibility = $scope.menu[key].visibility;
		    for (k in $scope.menu[key].groups[i].subgroups[j].goods) {
			$scope.menu[key].groups[i].subgroups[j].goods[k].visibility = $scope.menu[key].visibility;
		    }
		}
	    }
	}
	
	$scope.changeGroupVisibility = function(key, key2) {
	    for (j in $scope.menu[key].groups[key2].goods) {
		$scope.menu[key].groups[key2].goods[j].visibility = $scope.menu[key].groups[key2].visibility;
	    }
	    for (j in $scope.menu[key].groups[key2].subgroups) {
		$scope.menu[key].groups[key2].subgroups[j].visibility = $scope.menu[key].groups[key2].visibility;
		for (k in $scope.menu[key].groups[key2].subgroups[j].goods) {
		    $scope.menu[key].groups[key2].subgroups[j].goods[k].visibility = $scope.menu[key].groups[key2].visibility;
		}
	    }
	}
	
	$scope.addMenu = function()
	{
		var tempMenu = {};
		tempMenu.name = '';
		tempMenu.groups = [];
		tempMenu.place_id = $scope.place_id;
		tempMenu.ordering = $scope.menu.length;
		tempMenu.visibility = true;
		$scope.menu.push(tempMenu);
	}
	$scope.addGroup = function(key)
	{
		var tempGroup = {};
		tempGroup.name = '';
		tempGroup.group_id = 0;
		tempGroup.subgroups = [];
		tempGroup.goods = [];
		tempGroup.ordering = $scope.menu[key].groups.length;
		tempGroup.visibility = $scope.menu[key].visibility;
		$scope.menu[key].groups.push(tempGroup);
	}
	$scope.addSubgroup = function(key, key2)
	{
		var tempSubgroup = {};
		tempSubgroup.name = '';
		tempSubgroup.group_id = $scope.menu[key].groups[key2].id;
		tempSubgroup.goods = [];
		tempSubgroup.ordering = $scope.menu[key].groups[key2].subgroups.length;
		tempSubgroup.visibility = $scope.menu[key].groups[key2].visibility;
		if (!$scope.menu[key].groups[key2].subgroups) $scope.menu[key].groups[key2].subgroups = [];
		$scope.menu[key].groups[key2].subgroups.push(tempSubgroup);
	}
	$scope.addGood = function(key, key2)
	{
		var tempGood = {};
		tempGood.name = '';
		tempGood.group_id = $scope.menu[key].groups[key2].id;
		tempGood.price = 0;
		tempGood.composition = '';
		tempGood.portion = {};
		tempGood.portion.value = 0;
		tempGood.portion.measure = 'гр';
		tempGood.photo = '';
		tempGood.ordering = $scope.menu[key].groups[key2].goods.length;
		tempGood.visibility = $scope.menu[key].groups[key2].visibility;
		if (!$scope.menu[key].groups[key2].goods) $scope.menu[key].groups[key2].goods = [];
		$scope.menu[key].groups[key2].goods.push(tempGood);
	}
	
	$scope.addGoodToSub = function(key, key2, key3)
	{
		var tempGood = {};
		tempGood.name = '';
		tempGood.group_id = $scope.menu[key].groups[key2].subgroups[key3].id;
		tempGood.price = 0;
		tempGood.composition = '';
		tempGood.portion = {};
		tempGood.portion.value = 0;
		tempGood.portion.measure = 'гр';
		tempGood.photo = '';
		tempGood.ordering = $scope.menu[key].groups[key2].subgroups[key3].goods.length;
		tempGood.visibility = $scope.menu[key].groups[key2].subgroups[key3].visibility;
		$scope.menu[key].groups[key2].subgroups[key3].goods.push(tempGood);
	}
	
	$scope.deleteMenu = function(key) {
		if (typeof($scope.menu[key].id) == 'undefined')
		{
			$scope.menu.splice(key, 1);
		}
		else $scope.menu[key].place_id = -1;
	}
	
	$scope.deleteGroup = function(key, key2) {
		if (typeof($scope.menu[key].groups[key2].id) == 'undefined')
		{
			$scope.menu[key].groups.splice(key2, 1);
		}
		else $scope.menu[key].groups[key2].menu_id = -1;
	}
	
	$scope.deleteSubgroup = function(key, key2, key3) {
		if (typeof($scope.menu[key].groups[key2].subgroups[key3].id) == 'undefined')
		{
			$scope.menu[key].groups[key2].subgroups.splice(key3, 1);
		}
		else 
		{
			$scope.menu[key].groups[key2].subgroups[key3].menu_id = -1;
			$scope.menu[key].groups[key2].subgroups[key3].group_id = -1;
		}
	}
	
	$scope.deleteGood = function(key, key2, key3, key4) {
		if (typeof($scope.menu[key].groups[key2].subgroups[key3].goods[key4].id) == 'undefined')
		{
			$scope.menu[key].groups[key2].subgroups[key3].goods.splice(key4, 1);
		}
		else $scope.menu[key].groups[key2].subgroups[key3].goods[key4].group_id = -1;
	}
	
	$scope.deleteGoodGr = function(key, key2, key4) {
		if (typeof($scope.menu[key].groups[key2].goods[key4].id) == 'undefined')
		{
			$scope.menu[key].groups[key2].goods.splice(key4, 1);
		}
		else $scope.menu[key].groups[key2].goods[key4].group_id = -1;
	}
	
	$scope.save = function() {
		var data = {};
		data.menu = $scope.menu;
		data.place_id = $scope.place_id;
		data.token = token;
		console.log(data);
		$http.post(API_URL + 'menu/save', data).then(function(data) {
            alert('Меню успешно обновлено');
			$location.path('/dashboard').replace();
        }, function(data) {
            console.log(data);
        });
	};
});

app.controller('bookingsController', function($scope, $http, $location, $routeParams) {
	$scope.pase_page = 0;
	$scope.gtab = 1;
	$scope.fpr = 0;
	$scope.ppr = 0;
	$scope.bookcomment = '';
	$scope.booknum = '';
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'place?slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place = data.data;
		var mydata = {};
		mydata.token = token;
		mydata.not_table = 'booking';
		mydata.place_id = $scope.place.id;
		mydata.target_id = 0;
		$http.post(API_URL + 'notifications', mydata);
		$http.get(API_URL + 'dashboard/futureBooks?place_id=' + $scope.place.id).then(function(data) {
			for (i = 0; i < data.data.length; i++) {
				data.data[i].book_date = dateFormat(data.data[i].book_date, 'UTC:dddd, d mmmm, yyyy, HH:MM');
			};
			$scope.fbooks = data.data;
		}, function(data) {
			console.log(data);
		});
		$http.get(API_URL + 'dashboard/pastBooks?place_id=' + $scope.place.id + '&limit=10&offset=' + $scope.pase_page).then(function(data) {
			$scope.pase_page = 10;
			for (i = 0; i < data.data.length; i++) {
				data.data[i].book_date = dateFormat(data.data[i].book_date, 'UTC:dddd, d mmmm, yyyy, HH:MM');
			};
			$scope.pbooks = data.data;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.setbookinfo = function(name, comment) {
	    $scope.bookcomment = comment;
	    $scope.booknum = name;
	}
	$scope.approve = function(id, key)
	{
		if (confirm('Вы уверены, что хотите подтвердить бронь?')) 
		{
			var data = {};
			data.id = id;
			data.place_id = $scope.place.id;
			data.token = localStorage.getItem("token");
			$http.post(API_URL + 'dashboard/approveBooking', data).then(function(data) { 
				var mydata = {};
				mydata.user_id = $scope.fbooks[key].user_id;
				mydata.place_id = $scope.fbooks[key].place_id;
				mydata.target_id = id;
				mydata.not_table = 'booking';
				mydata.notification = 'Заведение подтвердило бронь ' + $scope.place.name;
				$http.put(API_URL + 'notifications', mydata).then(function(data) { console.log(data);
					$scope.fbooks[key].approved = true;
					alert('Бронь успешно подтверждена!');
				}, function(data) {
					console.log(data);
				});
			}, function(data) {
				console.log(data);
			});
		}
	}
	$scope.reject = function(id, key)
	{
		if (confirm('Вы уверены, что хотите отменить бронь?')) 
		{
			var data = {};
			data.id = id;
			data.place_id = $scope.place.id;
			data.token = localStorage.getItem("token");
			$http.post(API_URL + 'dashboard/rejectBooking', data).then(function(data) { 
				var mydata = {};
				mydata.user_id = $scope.fbooks[key].user_id;
				mydata.place_id = $scope.fbooks[key].place_id;
				mydata.target_id = id;
				mydata.not_table = 'booking';
				mydata.notification = 'Заведение отменило бронь ' + $scope.place.name;
				$http.put(API_URL + 'notifications', mydata).then(function(data) { console.log(data);
					$scope.fbooks[key].reject = true;
					alert('Бронь отменена!');
				}, function(data) {
					console.log(data);
				});		
			}, function(data) {
				console.log(data);
			});
		}
	}
	$scope.checkPromo = function() {
		$http.get(API_URL + 'dashboard/checkBookingCode?place_id=' + $scope.place.id + '&token=' + localStorage.getItem("token") + '&code=' + $scope.code).then(function(data) { 
			if (data.data == true) 
			{
				alert('Верный промокод!');
			}
			else
			{
				alert('Неверный промокод!');
			}
		}, function(data) {
			console.log(data);
		});
	}
});

app.controller('promocodesController', function($scope, $http, $location, $routeParams) {
	$scope.promo = {};
	$scope.ppromos = [];
	$http.get(API_URL + 'place?slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place = data.data;
		$http.get(API_URL + 'dashboard/usedPromos?place_id=' + $scope.place.id + '&token=' + localStorage.getItem("token")).then(function(data) {
			for (i = 0; i < data.data.length; i++) {
				data.data[i].used_date = dateFormat(data.data[i].used_date, 'UTC:dddd, d mmmm, yyyy, HH:MM');
			};
			$scope.ppromos = $scope.ppromos.concat(data.data);
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	$scope.checkPromo = function() {
		$http.get(API_URL + 'dashboard/checkPromo?place_id=' + $scope.place.id + '&token=' + localStorage.getItem("token") + '&code=' + $scope.promo.code).then(function(data) { 
			if (data.data == true) 
			{
				alert('Верный промокод!');
			}
			else
			{
				alert('Неверный промокод!');
			}
		}, function(data) {
			console.log(data);
		});
	}
	
});

app.controller('placeController', function($scope, $timeout, $http, $location, $routeParams, $anchorScroll) {
	if ($location.hash() != '') $scope.tab = 2;
	else $scope.tab = 1;
	$scope.netws = 0;
	$scope.booking = {};
	$scope.newreview = {};
	$scope.rating = {};
	$scope.promo = {};
	$scope.search = '';
	$scope.promo.code = false;
	$scope.rating.kitchen = 0;
	$scope.rating.place = 0;
	$scope.rating.service = 0;
	$scope.booking.persons_number = 1;
	$scope.booking.name = '';
	$scope.booking.phone = '';
	$scope.booking.comment = '';
	$scope.booking.time = '';
	$scope.collapse = [];
	$scope.scrollTo = function(id) {
		$timeout(function() {
			$location.hash(id);
			$anchorScroll();		
		});
    }
	$scope.getDiscount = function() {
		$scope.promo.place_id = $scope.place.id;
		$scope.promo.token = localStorage.getItem("token");
		var data = $scope.promo;
		$http.put(API_URL + 'place/promocode', data).then(function(data) { console.log(data);
            alert('Вы успешно получили скидку. Ваш промокод: ' + data.data.code);
			$("#booking").modal('hide');
        }, function(data) {
            console.log(data);
        });
	}
	$scope.submitbooking = function() {
		$scope.booking.book_date = $('.date').attr('date') + " " + $scope.booking.time;
		$scope.booking.token = localStorage.getItem("token");
		$scope.booking.place_id = $scope.place.id;
		var data = $scope.booking;
		$http.put(API_URL + 'place/addBook', data).then(function(data) {
			var code = data.data.code;
			var mydata = {};
			mydata.place_id = $scope.place.id;
			mydata.user_id = $scope.place.owner_id;
			mydata.target_id = data.data.id;
			mydata.not_table = 'booking';
			mydata.notification = 'Новая бронь в ресторане ' + $scope.place.name;	
			$http.put(API_URL + 'notifications', mydata).then(function(data) {
				alert('Вы успешно оставили заявку на бронирование. Администрация заведения вскоре свяжется с Вами для уточнения деталей. Ваш код брони: ' + code);
				$("#booking").modal('hide');
				$scope.booking.name = '';
				$scope.booking.phone = '';
				$scope.booking.persons_number = 1;
			}, function(data) {
				console.log(data);
			});
        }, function(data) {
            console.log(data);
        });
	}
	$scope.sendreview = function() {
		$scope.newreview.token = localStorage.getItem("token");
		$scope.newreview.place_id = $scope.place.id;
		var data = $scope.newreview;
		$http.put(API_URL + 'place/addReview', data).then(function(data) {
			var mydata = {};
			mydata.place_id = $scope.place.id;
			mydata.user_id = $scope.place.owner_id;
			mydata.target_id = data.data.id;
			mydata.not_table = 'reviews';
			mydata.notification = 'Новый отзыв о ресторане ' + $scope.place.name;
			$http.put(API_URL + 'notifications', mydata).then(function(data) { console.log(data);
				alert('Вы успешно оставили отзыв! Он будет опубликован после проверки модераторами! Спасибо!');
				$("#review").modal('hide');
			}, function(data) {
				console.log(data);
			});
        }, function(data) {
            console.log(data);
        });
	}
	$scope.rate = function(elem, rate) {
		$scope.rating.token = localStorage.getItem("token");
		$scope.rating.place_id = $scope.place.id;
		if (elem == 'kitchen') $scope.rating.kitchen = rate;
		if (elem == 'place') $scope.rating.place = rate;
		if (elem == 'service') $scope.rating.service = rate;
		var data = $scope.rating; console.log(data);
		$http.post(API_URL + 'place/rate', data).then(function(data) { 
			console.log(data);
        }, function(data) {
            console.log(data);
        });
	}
	$scope.plus = function() {
		$scope.booking.persons_number++;
	}
	$scope.minus = function() {
		if ($scope.booking.persons_number > 1) $scope.booking.persons_number--;
	}
	$scope.settime = function(time) {
		$scope.booking.time = time;
	}
	$scope.searchGood = function() {
		$http.get(API_URL + 'menu?visibility=TRUE&place_id=' + $scope.place.id + '&search=' + $scope.search.toLowerCase()).then(function(data) {
			$scope.menu = data.data;
			for (i in $scope.menu) {
				f = 0;
				for (j in $scope.menu[i].groups) {
					ff = 0;
					for (k in $scope.menu[i].groups[j].subgroups) {
						if ($scope.menu[i].groups[j].subgroups[k].goods == null) {
							$scope.menu[i].groups[j].subgroups[k].visibility = false;
						}
						else {
							ff = 1;
						}
					}
					if ($scope.menu[i].groups[j].goods != null) ff = 1;
					if (!ff) $scope.menu[i].groups[j].visibility = false;
					else f = 1;
				}
				if (!f) $scope.menu[i].visibility = false;
			}
		}, function(data) {
			console.log(data);
		});
	}
	var nowd = new Date();
	var now = new Date(dateFormat(nowd, 'yyyy-mm-dd'));
	$scope.now = nowd.getHours() + ":" + nowd.getMinutes();
	$scope.day = now;
	$http.get(API_URL + 'place?slug=' + $scope.$routeParams.slug).then(function(data) {
	    var mydata = {};
	    mydata.place_id = data.data.id;
	    $http.post(API_URL + 'visitors/page', mydata);
		begin = new Date(dateFormat(data.data.discount_begins, 'yyyy-mm-dd'));
		end = new Date(dateFormat(data.data.discount_ends, 'yyyy-mm-dd'));
		if (end < now || begin > now) data.data.discount = 0; 
		$scope.place = data.data;
		var latValue = $scope.place.lat;
		var lngValue = $scope.place.lng;
		var haightAshbury = new google.maps.LatLng(latValue,lngValue);
		var mapOptions = {
			zoom:13,
			center:haightAshbury,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		mapAddMark = new google.maps.Map(document.getElementById("map_show"),mapOptions);
		marker = new google.maps.Marker({position:haightAshbury,map:mapAddMark,title:""});
		$http.get(API_URL + 'menu?visibility=TRUE&place_id=' + $scope.place.id + '&search=').then(function(data) {
			$scope.menu = data.data;
			for (i in data.data) $scope.collapse[data.data[i].id] = 1;
		}, function(data) {
			console.log(data);
		});
		$http.get(API_URL + 'place/getUserRate?place_id=' + $scope.place.id + '&token=' + localStorage.getItem("token")).then(function(data) {
			if (data.data && data.data.length != 0) $scope.rating = data.data[0];
		}, function(data) {
			console.log(data);
		});
		$http.get(API_URL + 'place/getUserPromo?place_id=' + $scope.place.id + '&token=' + localStorage.getItem("token")).then(function(data) {
			if (data.data && data.data.length != 0) $scope.promo = data.data[0];
		}, function(data) {
			console.log(data);
		});
		$http.get(API_URL + 'reviews?limit=12&offset=0&place_id=' + $scope.place.id).then(function(data) {
			$scope.reviews = data.data;
			$scope.reviews_page = 12;
		}, function(data) {
			console.log(data);
		});
		$http.get(API_URL + 'news?limit=12&offset=0&place_id=' + $scope.place.id).then(function(data) {
			$scope.news = data.data;
			$scope.news_page = 12;
		}, function(data) {
			console.log(data);
		});
		$http.get(API_URL + 'promotions?limit=12&offset=0&place_id=' + $scope.place.id).then(function(data) {
			$scope.promotions = data.data;
			$scope.promotions_page = 12;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.getReviews = function() {
		$http.get(API_URL + 'reviews?limit=12&offset=' + $scope.reviews_page + '&place_id=' + $scope.place.id).then(function(data) {
			$scope.reviews = $scope.reviews.concat(data.data);
			$scope.reviews_page += 12;
			console.log($scope.reviews);
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.getNews = function() {
		$http.get(API_URL + 'news?limit=12&offset=' + $scope.reviews_page + '&place_id=' + $scope.place.id).then(function(data) {
			$scope.news = $scope.news.concat(data.data);
			$scope.news_page += 12;
			console.log($scope.news);
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.getPromotions = function() {
		$http.get(API_URL + 'promotions?limit=12&offset=' + $scope.reviews_page + '&place_id=' + $scope.place.id).then(function(data) {
			$scope.promotions = $scope.promotions.concat(data.data);
			$scope.promotions_page += 12;
			console.log($scope.promotions);
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.hidemenu = function(id) {
	    for (i in $scope.menu) {
		if ($scope.collapse[$scope.menu[i].id] % 2 == 0) $scope.collapse[$scope.menu[i].id] = $scope.collapse[$scope.menu[i].id] + 1;
		if ($scope.menu[i].id != id) $scope.menu[i].visibility = false;
		else $scope.menu[i].visibility = true;
		for (j in $scope.menu[i].groups) {
		    $scope.menu[i].groups[j].visibility = true;
		    for (k in $scope.menu[i].groups[j].subgroups) {
			$scope.menu[i].groups[j].subgroups[k].visibility = true;
		    }
		    for (k in $scope.menu[i].groups[j].goods) {
			$scope.menu[i].groups[j].goods[k].visibility = true;
		    }
		}
	    }
	    for (i in $scope.menu) {
			f = 0;
			for (j in $scope.menu[i].groups) {
				ff = 0;
				for (k in $scope.menu[i].groups[j].subgroups) {
					if ($scope.menu[i].groups[j].subgroups[k].goods == null) {
						$scope.menu[i].groups[j].subgroups[k].visibility = false;
					}
					else {
						ff = 1;
					}
				}
				if ($scope.menu[i].groups[j].goods != null) ff = 1;
				if (!ff) $scope.menu[i].groups[j].visibility = false;
				else f = 1;
			}
			if (!f) $scope.menu[i].visibility = false;
		}
	}
	
	$scope.hidegroup = function(id) {
	    for (i in $scope.menu) {
		if ($scope.collapse[$scope.menu[i].id] % 2 == 0) $scope.collapse[$scope.menu[i].id] = $scope.collapse[$scope.menu[i].id] + 1;
		$scope.menu[i].visibility = true;
		for (j in $scope.menu[i].groups) {
		    for (k in $scope.menu[i].groups[j].subgroups) {
			$scope.menu[i].groups[j].subgroups[k].visibility = true;
		    }
		}
	    }
	    var flag = 0;
	    for (i in $scope.menu) {
		flag = 0;
		for (j in $scope.menu[i].groups) {
		    if ($scope.menu[i].groups[j].id != id) $scope.menu[i].groups[j].visibility = false;
		    else {
			flag = 1;
			$scope.menu[i].groups[j].visibility = true;
			for (k in $scope.menu[i].groups[j].goods) {
			    $scope.menu[i].groups[j].goods[k].visibility = true;
			}
		    }
		}
		if (!flag) $scope.menu[i].visibility = false;
	    }
	    for (i in $scope.menu) {
			f = 0;
			for (j in $scope.menu[i].groups) {
				ff = 0;
				for (k in $scope.menu[i].groups[j].subgroups) {
					if ($scope.menu[i].groups[j].subgroups[k].goods == null) {
						$scope.menu[i].groups[j].subgroups[k].visibility = false;
					}
					else {
						ff = 1;
					}
				}
				if ($scope.menu[i].groups[j].goods != null) ff = 1;
				if (!ff) $scope.menu[i].groups[j].visibility = false;
				else f = 1;
			}
			if (!f) $scope.menu[i].visibility = false;
		}
	}
	
	$scope.hidesub = function(id) {
	    for (i in $scope.menu) {
	    	if ($scope.collapse[$scope.menu[i].id] % 2 == 0) $scope.collapse[$scope.menu[i].id] = $scope.collapse[$scope.menu[i].id] + 1;
			$scope.menu[i].visibility = true;
			for (j in $scope.menu[i].groups) {
			    $scope.menu[i].groups[j].visibility = true;
			}
	    }
	    var flag = 0;
	    var ff = 0;
	    for (i in $scope.menu) {
		ff = 0;
		for (j in $scope.menu[i].groups) {
		    flag = 0;
		    for (k in $scope.menu[i].groups[j].subgroups) {
			if ($scope.menu[i].groups[j].subgroups[k].id != id) $scope.menu[i].groups[j].subgroups[k].visibility = false;
			else { flag = 1; ff = 1; $scope.menu[i].groups[j].subgroups[k].visibility = true; }
		    }
		    if (!flag) $scope.menu[i].groups[j].visibility = false;
		    else {
			for (k in $scope.menu[i].groups[j].goods) {
			    $scope.menu[i].groups[j].goods[k].visibility = false;
			}
		    }
		}
		if (!ff) $scope.menu[i].visibility = false;
	    }
	    for (i in $scope.menu) {
			f = 0;
			for (j in $scope.menu[i].groups) {
				ff = 0;
				for (k in $scope.menu[i].groups[j].subgroups) {
					if ($scope.menu[i].groups[j].subgroups[k].goods == null) {
						$scope.menu[i].groups[j].subgroups[k].visibility = false;
					}
					else {
						ff = 1;
					}
				}
				if ($scope.menu[i].groups[j].goods != null) ff = 1;
				if (!ff) $scope.menu[i].groups[j].visibility = false;
				else f = 1;
			}
			if (!f) $scope.menu[i].visibility = false;
		} 
	}
});

app.controller('dashboardReviewsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.place = [];
	$scope.place.slug = $scope.$routeParams.slug;
	$scope.reviews = [];
	$scope.filter = 1;
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		var mydata = {};
		mydata.token = token;
		mydata.not_table = 'reviews';
		mydata.place_id = $scope.place_id;
		mydata.target_id = 0;
		$http.post(API_URL + 'notifications', mydata);
		$http.get(API_URL + 'dashboard/reviews?place_id=' + $scope.place_id).then(function(data) {
			$scope.reviews = data.data;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.all = function() {
		$http.get(API_URL + 'dashboard/reviews?limit=1000&offset=0&place_id=' + $scope.place_id).then(function(data) {
			$scope.reviews = data.data;
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.answered = function() {
		$http.get(API_URL + 'reviews/answered?limit=1000&offset=0&place_id=' + $scope.place_id).then(function(data) {
			$scope.reviews = data.data;
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.notanswered = function() {
		$http.get(API_URL + 'reviews/notanswered?limit=1000&offset=0&place_id=' + $scope.place_id).then(function(data) {
			$scope.reviews = data.data;
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.unpublish = function(id, key) {
		if (confirm('Вы действительно хотите удалить этот отзыв?')) {
		    var data = {};
		    data.id = id;
		    data.place_id = $scope.place_id;
		    data.token = token;
		    $http.post(API_URL + 'reviews/unpublish', data);
		    $scope.reviews.splice(key, 1);
		}
	}
	
	$scope.publish = function(id) {
		var data = {};
		data.id = id;
		data.place_id = $scope.place_id;
		data.token = token;
		$http.post(API_URL + 'reviews/publish', data);
	}
	
	$scope.saveanswer = function(id, answer)
	{
		var data = {};
		data.id = id;
		data.place_id = $scope.place_id;
		data.token = token;
		data.answer = answer;
		$http.post(API_URL + 'reviews/saveanswer', data);
	}
});

app.controller('dashboardDiscountController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.reviews = [];
	$scope.filter = 1;
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place = data.data[0];
		$scope.place.discount_begins = new Date(dateFormat($scope.place.discount_begins, 'yyyy-mm-dd'));
		$scope.place.discount_ends = new Date(dateFormat($scope.place.discount_ends, 'yyyy-mm-dd'));
	}, function(data) {
		console.log(data);
	});
	
	$scope.savediscount = function()
	{
		var data = {};
		data.place = $scope.place;
		data.token = token;
		$http.post(API_URL + 'places/savediscount', data);
		alert('Скидка успешно сохранена');
		$location.path('/dashboard').replace();
	}
	
});

app.controller('goodiconsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.place = [];
	$scope.place.slug = $scope.$routeParams.slug;
	$scope.goods = [];
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$http.get(API_URL + 'dashboard/goods?place_id=' + $scope.place_id).then(function(data) {
			$scope.goods = data.data;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.deleteimg = function(key)
	{
		$scope.goods[key].photo = '';
	}
		
	$scope.save = function()
	{
		var data = {};
		data = $scope.goods;
		$http.post(API_URL + 'menu/images', data).then(function(data) {
            alert('Меню успешно обновлено');
			$location.path('/dashboard').replace();
        }, function(data) {
            console.log(data);
        });
	}
});

app.controller('loyalityController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.loyality = {};
	$scope.place = {};
	$scope.loyalitydata = {};
	$scope.slug = $scope.$routeParams.slug;
	$scope.code = '';
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$scope.place = data.data[0];
		$http.get(API_URL + 'loyality?place_id=' + $scope.place_id).then(function(data) {
			$scope.loyality = data.data;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.checkusers = function() {
		$http.get(API_URL + 'dashboard/userbyphone?phone=' + $scope.loyalitydata.phone + '&card=' + $scope.loyalitydata.card_id).then(function(data) {
			if (data.data.length > 0) 
			{
				$scope.usersbyphone = data.data;
			}
			else
			{
				alert('Пользователя с таким телефоном не существует!');
			}
		}, function(data) {
			console.log(data);
		});	
	}
	
	$scope.giveloyality = function() {
	    var data = $scope.loyalitydata;
	    console.log($scope.loyalitydata);
	    data.token = token;
	    data.place_id = $scope.place_id;
	    $http.put(API_URL + 'dashboard/loyalityuser', data).then(function(data) {
		var mydata = {};
		mydata.token = token;
		mydata.user_id = $scope.loyalitydata.user_id;
		mydata.target_id = $scope.loyalitydata.card_id;
		mydata.not_table = 'loyality';
		mydata.place_id = $scope.place_id;
		mydata.notification = "Заведением <a href='/" + $scope.place.slug + "'>" + $scope.place.name + "</a> выдана карта лояльности " + $scope.loyalitydata.title;;
		$http.put(API_URL + 'notifications', mydata).then(function(data){
		    alert('Пользователь успешно добавлен!');
		    $scope.loyalitydata = {};
		    $scope.usersbyphone = {};
		    $("#giveloyality").modal('hide');
		});
		
	    }, function(data) {
		console.log(data);
	    });
	}
	
	$scope.delete = function(id, key) {
	    if (confirm("Вы уверены, что хотите удалить карту лояльности?")) {
		$http.delete(API_URL + 'dashboard/loyality?token=' + token + '&id=' + id).then(function(data) {
		    $http.get(API_URL + 'loyalityitem?token=' + token + '&id=' + id).then(function(data) {
			    loyal = data.data;
			    $scope.loyality.splice(key,1);
		    }, function(data) {
			    console.log(data);
		    });
		    
		}, function(data) {
		    console.log(data);
		});
	    }
	};
	$scope.checkPromo = function() {
		$http.get(API_URL + 'dashboard/checkloyality?place_id=' + $scope.place_id + '&token=' + localStorage.getItem("token") + '&code=' + $scope.code).then(function(data) { 
			if (data.data != true) 
			{
				alert('Владелец карты лояльности: ' + data.data.first_name + ' '+ data.data.last_name + ', e-mail: '+ data.data.email + ', телефон: '+ data.data.phone);
			}
			else
			{
				alert('Неверный промокод!');
			}
		}, function(data) {
			console.log(data);
		});
	}
});

app.controller('newsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.place = [];
	$scope.place.slug = $scope.$routeParams.slug;
	$scope.slug = $scope.$routeParams.slug;
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$http.get(API_URL + 'allnews?limit=10&offset=0&place_id=' + $scope.place_id).then(function(data) {
			$scope.news = data.data;
			$scope.news_page = 10;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
});

app.controller('profileController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.id = $scope.$routeParams.id;
	$scope.user = {};
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'user?id=' + $scope.id).then(function(data) {
		$scope.user = data.data;
		$scope.user.registration_date = dateFormat($scope.user.registration_date, 'yyyy-mm-dd');
		console.log($scope.user.registration_date);
	}, function(data) {
		console.log(data);
	});
});

app.controller('promotionsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.place = [];
	$scope.place.slug = $scope.$routeParams.slug;
	$scope.slug = $scope.$routeParams.slug;
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$http.get(API_URL + 'allpromotions?limit=10&offset=0&place_id=' + $scope.place_id).then(function(data) {
			$scope.promotions = data.data;
			$scope.promotions_page = 10;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	$scope.delete = function(id) {
	    if (confirm('Вы уверены, что хотите удалить акцию?')) {
		$http.delete(API_URL + 'dashboard/promotions?token=' + token + '&place_id=' + $scope.place_id + '&id=' + id).then(function(data) {
			$http.get(API_URL + 'allpromotions?limit=10&offset=0&place_id=' + $scope.place_id).then(function(data) {
				$scope.promotions = data.data;
				$scope.promotions_page = 10;
			}, function(data) {
				console.log(data);
			});
		}, function(data) {
			console.log(data);
		});
	    }
	}
});

app.controller('promotionsController2', function($scope, $http, $location, $routeParams) {
	$scope.tab = 1;
	$scope.order = 'rating';
	$scope.city = localStorage.getItem("city");
	$scope.search = '';
	$scope.addr = '';
	$scope.radius = '50';
	$scope.page = 0;
	$scope.places = [];
	$scope.promotions = [];
	var locations = [];
	var nowd = new Date();
	var now = new Date(dateFormat(nowd, 'yyyy-mm-dd'));
	var map;
	var markerCluster = false;
	var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$scope.availability = ['0', '0', '0', '0', '0', '0', '0'];
	var token = localStorage.getItem("token");
	
	$http.get(API_URL + 'promotions/get?search=&limit=10&offset=0&token=' + token + '&a0=' + $scope.availability[0] + '&a1=' + $scope.availability[1] + '&a2=' + $scope.availability[2] + '&a3=' + $scope.availability[3] + '&a4=' + $scope.availability[4] + '&a5=' + $scope.availability[5] + '&a6=' + $scope.availability[6]).then(function(data) {
		$scope.promotions = data.data;
		console.log(data.data);
		$scope.promotions_page = 10;
	}, function(data) {
		console.log(data);
	});

	$scope.more = function() {
		$http.get(API_URL + 'promotions/get?search=' + $scope.search.toLowerCase() + '&limit=10&offset=' + $scope.promotions_page + '&token=' + token + '&a0=' + $scope.availability[0] + '&a1=' + $scope.availability[1] + '&a2=' + $scope.availability[2] + '&a3=' + $scope.availability[3] + '&a4=' + $scope.availability[4] + '&a5=' + $scope.availability[5] + '&a6=' + $scope.availability[6]).then(function(data) {
			$scope.promotions = $scope.promotions.concat(data.data);
			$scope.promotions_page += 10;
		}, function(data) {
			console.log(data);
		});
	}

	$scope.getResult = function() {
		$scope.promotions_page = 0;
		$scope.promotions = [];
		$http.get(API_URL + 'promotions/get?search=' + $scope.search.toLowerCase() + '&limit=10&offset=' + $scope.promotions_page + '&token=' + token + '&a0=' + $scope.availability[0] + '&a1=' + $scope.availability[1] + '&a2=' + $scope.availability[2] + '&a3=' + $scope.availability[3] + '&a4=' + $scope.availability[4] + '&a5=' + $scope.availability[5] + '&a6=' + $scope.availability[6]).then(function(data) {
			$scope.availability = ['0', '0', '0', '0', '0', '0', '0'];
			$scope.promotions = $scope.promotions.concat(data.data);
			$scope.promotions_page += 10;
		}, function(data) {
			console.log(data);
		});
	}
	var defaultBounds = new google.maps.LatLngBounds(
	new google.maps.LatLng(40.3943872, 49.8542179),
	new google.maps.LatLng(40.3943872, 49.8542179));

	var input = document.getElementById('map_addr');
	var options = {
	  bounds: defaultBounds
	};

	$scope.autocomplete = new google.maps.places.Autocomplete(input, options);
	//console.log(autocomplete);
	
	$scope.initMap = function() {
        map = new google.maps.Map(document.getElementById('map'), {
			zoom: 10,
			center: new google.maps.LatLng(40.3943872, 49.8542179),
			mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var markers = locations.map(function(location, i) {
			return new google.maps.Marker({
				position: location,
				label: labels[i % labels.length]
			});
        });
		map.setCenter(new google.maps.LatLng(40.3943872, 49.8542179));
        markerCluster = new MarkerClusterer(map, markers, { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });

        google.maps.event.addListener(markers, 'click', function() {
		    window.location.href = this.url;
		});
	}
	
	$scope.getResultByLocation = function() {
		if ($scope.page == 0) $scope.promotions = [];
		var place = $scope.autocomplete.getPlace();
		if ($scope.addr == '') { $scope.getResult(); return; }
		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		$http.get(API_URL + 'promotions/getByLocation?lat=' + lat + '&lng=' + lng + '&radius=' + $scope.radius + '&city=' + $scope.city + '&limit=12&offset=' + $scope.page + '&a0=' + $scope.availability[0] + '&a1=' + $scope.availability[1] + '&a2=' + $scope.availability[2] + '&a3=' + $scope.availability[3] + '&a4=' + $scope.availability[4] + '&a5=' + $scope.availability[5] + '&a6=' + $scope.availability[6]).then(function(data) {
			for (i in data.data)
			{
				begin = new Date(dateFormat(data.data[i].discount_begins, 'yyyy-mm-dd'));
				end = new Date(dateFormat(data.data[i].discount_ends, 'yyyy-mm-dd'));
				if (end < now || begin > now) data.data[i].discount = 0; 
			}
			$scope.promotions = $scope.places.concat(data.data);
			//console.log(markerCluster);
			if (markerCluster) 
			{
				markerCluster.clearMarkers();
				//markerCluster.getMarkers();
				//for (i in marks) markerCluster.removeMarker(marks[i]);
			}
			marker = new google.maps.Marker({
				position: {
					lat: lat,
					lng: lng
				},
				label: $scope.addr,
				icon: {
			      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
			    }
			});
			markerCluster.addMarker(marker);
			for (i in $scope.places)
			{
				if ($scope.places[i].lat && $scope.places[i].lng)
				{
					coord = {};
					coord.lat = Number($scope.places[i].lat);
					coord.lng = Number($scope.places[i].lng);
					locations.push(coord);
					if (markerCluster)
					{
						marker = new google.maps.Marker({
							position: coord,
							label: $scope.places[i].name,
							url: '/' + $scope.places[i].slug
						});
						markerCluster.addMarker(marker);
					}
					google.maps.event.addListener(marker, 'click', function() {
					    window.location.href = this.url;
					});
				}			
			}
			
		}, function(data) {
			console.log(data);
		});
	}

	//$scope.getResult();
	$scope.initMap();
	$scope.resizeMap = function() {
		if (!$scope.flag)
		{
			$scope.initMap();
			map.setCenter(new google.maps.LatLng(40.3943872, 49.8542179));
			window.setTimeout(function() { 
				google.maps.event.trigger(map, 'resize'); 
			}, 1);
		}
		$scope.flag = 1;
	}
	$scope.flag = 0;
	$scope.resizeMap();
	$scope.deleteMap = function()
	{
		//map = {};
		//document.getElementById('map').html('');
	}

});

app.controller('newsController2', function($scope, $http, $location, $routeParams) {
	$http.get(API_URL + 'news/get?limit=10&offset=0').then(function(data) {
		$scope.news = data.data;
		console.log(data.data);
		$scope.news_page = 10;
	}, function(data) {
		console.log(data);
	});
	$scope.more = function() {
		$http.get(API_URL + 'news/get?limit=10&offset=' + $scope.news_page).then(function(data) {
			$scope.news = $scope.news.concat(data.data);
			$scope.news_page += 10;
		}, function(data) {
			console.log(data);
		});
	}
});

app.controller('addnewsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.news = {};
	$scope.news.title = '';
	$scope.news.content = '';
	$scope.news.cover_image = '';
	$scope.news.images = [];
	$scope.news.visibility = true;
	
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$scope.news.place_id = $scope.place_id;
	}, function(data) {
		console.log(data);
	});
	
	$scope.deleteImage = function(image) {
		if ($scope.news.cover_image == image) $scope.news.cover_image = '';
		if ($scope.news.images.indexOf(image) == -1) $scope.news.images.push(image);
		else $scope.news.images.remove(image);
	};
	
	Dropzone.autoDiscover = false;
	
	$("#object-photo").dropzone({
		url: 'http://139.59.151.232:83/upload',
		acceptedFiles: 'image/*',
		timeout: 1000000,
		method: "post",
		success: function (file, response) {  console.log($scope.subwayStations);
			file.previewElement.classList.add("dz-success");
			$scope.$apply(function() {
				$scope.news.images.push(response.originalname);
			});
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});
	
	$scope.save = function() {
		var data = $scope.news;
		data.token = token;
		$http.put(API_URL + 'dashboard/news', data).then(function(data) {
            alert('Новость успешно добавлена');
			$location.path('/dashboard/news/' + $scope.slug).replace();
        }, function(data) {
            console.log(data);
        });
	}
});

app.controller('editnewsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.news = {};
	$scope.news.title = '';
	$scope.news.content = '';
	$scope.news.cover_image = '';
	$scope.news.images = [];
	$scope.news.visibility = true;
	
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$http.get(API_URL + 'dashboard/news?token=' + token + '&id=' + $scope.$routeParams.id).then(function(data) {
			$scope.news = data.data;
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.deleteImage = function(image) {
		if ($scope.news.cover_image == image) $scope.news.cover_image = '';
		if ($scope.news.images.indexOf(image) == -1) $scope.news.images.push(image);
		else $scope.news.images.remove(image);
	};
	
	Dropzone.autoDiscover = false;
	
	$("#object-photo").dropzone({
		url: 'http://139.59.151.232:83/upload',
		acceptedFiles: 'image/*',
		timeout: 1000000,
		method: "post",
		success: function (file, response) {  console.log($scope.subwayStations);
			file.previewElement.classList.add("dz-success");
			$scope.$apply(function() {
				$scope.news.images.push(response.originalname);
			});
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});
	
	$scope.save = function() {
		var data = $scope.news;
		data.token = token;
		$http.post(API_URL + 'dashboard/news', data).then(function(data) {
            alert('Новость успешно изменена');
			$location.path('/dashboard/news/' + $scope.slug).replace();
        }, function(data) {
            console.log(data);
        });
	}
});

app.controller('addpromotionsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.promotions = {};
	$scope.promotions.title = '';
	$scope.promotions.content = '';
	$scope.promotions.cover_image = '';
	$scope.promotions.images = [];
	$scope.promotions.visibility = true;
	$scope.promotions.starts = '';
	$scope.promotions.ends = '';
	$scope.promotions.only_clients = false;
	$scope.availability = [true, true, true, true, true, true, true];
	
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$scope.promotions.place_id = $scope.place_id;
	}, function(data) {
		console.log(data);
	});
	
	$scope.deleteImage = function(image) {
		if ($scope.promotions.cover_image == image) $scope.promotions.cover_image = '';
		if ($scope.promotions.images.indexOf(image) == -1) $scope.promotions.images.push(image);
		else $scope.promotions.images.remove(image);
	};
	
	Dropzone.autoDiscover = false;
	
	$("#object-photo").dropzone({
		url: 'http://139.59.151.232:83/upload',
		acceptedFiles: 'image/*',
		timeout: 1000000,
		method: "post",
		success: function (file, response) {  console.log($scope.subwayStations);
			file.previewElement.classList.add("dz-success");
			$scope.$apply(function() {
				$scope.promotions.images.push(response.originalname);
				if ($scope.promotions.cover_image == '') $scope.promotions.cover_image = response.originalname;
			});
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});
	
	$scope.save = function() {
	    $scope.promotions.availability = JSON.stringify($scope.availability);
		var data = $scope.promotions;
		data.token = token;
	    if (data.starts == null || data.ends == null) {
		alert('Для создания акции надо заполнить все поля');
	    }
	    else {
		$http.put(API_URL + 'dashboard/promotions', data).then(function(data) {

			alert('Акция успешно добавлена');

			    $location.path('/dashboard/promotions/' + $scope.slug).replace();
		}, function(data) {
		    console.log(data);
		});
	    }
	}
});

app.controller('editpromotionsController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.promotions = {};
	$scope.promotions.title = '';
	$scope.promotions.content = '';
	$scope.promotions.cover_image = '';
	$scope.promotions.images = [];
	$scope.promotions.visibility = true;
	$scope.promotions.starts = '';
	$scope.promotions.ends = '';
	$scope.promotions.only_clients = false;
	$scope.availability = [];
	$scope.enabled = false;
	
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$http.get(API_URL + 'dashboard/promotions?token=' + token + '&id=' + $scope.$routeParams.id).then(function(data) {
			$scope.promotions = data.data;
			$scope.promotions.starts = new Date(dateFormat($scope.promotions.starts, 'yyyy-mm-dd'));
			$scope.promotions.ends = new Date(dateFormat($scope.promotions.ends, 'yyyy-mm-dd'));
			$scope.availability = $.parseJSON($scope.promotions.availability);
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	
	$scope.deleteImage = function(image) {
		if ($scope.promotions.cover_image == image) $scope.promotions.cover_image = '';
		if ($scope.promotions.images.indexOf(image) == -1) $scope.promotions.images.push(image);
		else $scope.promotions.images.remove(image);
		$scope.enabled = true;
	};
	
	$scope.changeCover = function(image) {
	    $scope.promotions.cover_image = image;
	    $scope.enabled = true;	
	}
	
	Dropzone.autoDiscover = false;
	
	$("#object-photo").dropzone({
		url: 'http://139.59.151.232:83/upload',
		acceptedFiles: 'image/*',
		timeout: 1000000,
		method: "post",
		success: function (file, response) {  console.log($scope.subwayStations);
			file.previewElement.classList.add("dz-success");
			$scope.$apply(function() {
			     $scope.enabled = true;
				$scope.promotions.images.push(response.originalname);
			});
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});
	
	$scope.save = function() {
	    $scope.promotions.availability = JSON.stringify($scope.availability);
	    var data = $scope.promotions;
	    data.token = token;
	    if (data.starts == null || data.ends == null) {
		//console.log($scope.promotions.content + " === " + $scope.oldval.content);
		alert('Для изменения акции надо заполнить все поля');
	    }
	    else {
		$http.post(API_URL + 'dashboard/promotions', data).then(function(data) {
		    alert('Акция успешно изменена');
		    $location.path('/dashboard/promotions/' + $scope.slug).replace();
		}, function(data) {
		    console.log(data);
		});
	    }
	}
});

app.directive('dropzoneRepeatDirective', function() {
	return function(scope, element, attrs) {
		if (scope.$last){
			Dropzone.autoDiscover = false;
			$(".dropzone").dropzone({
				url: 'http://139.59.151.232:83/upload',
				acceptedFiles: 'image/*',
				timeout: 1000000,
				method: "post",
				success: function (file, response) {
					file.previewElement.classList.add("dz-success");
					var k = $($(this)[0].element).attr('data-id');
					scope.goods[k].photo = response.originalname;
				},
				error: function (file, response) {
					file.previewElement.classList.add("dz-error");
				}
			});
		}
	};
});

app.controller('addloyalityController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.loyality = {};
	$scope.loyality.title = '';
	$scope.loyality.content = '';
	$scope.loyality.user_id = 0;
	$scope.loyality.activity = true;
	
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/placebyslug?token=' + token + '&slug=' + $scope.$routeParams.slug).then(function(data) {
		$scope.place_id = data.data[0].id;
		$scope.loyality.place_id = $scope.place_id;
	}, function(data) {
		console.log(data);
	});
	
	$scope.save = function() {
		var data = $scope.loyality;
		//if (data.user_id)
		//{
			data.token = token;
			$http.put(API_URL + 'dashboard/loyality', data).then(function(data) {
				alert('Карта лояльности успешно добавлена');
				$location.path('/dashboard/loyality/' + $scope.slug).replace();
			}, function(data) {
				console.log(data);
			});
		//}
		//else
		//{
		//	alert('Не выбран пользователь!');
		//}
	}
});

app.controller('editloyalityController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.loyality = {};
	$scope.loyality.content = '';
	$scope.loyality.user_id = 0;
	$scope.loyality.activity = true;
	$scope.enabled = false;
	
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'loyalityitem?token=' + token + '&id=' + $scope.$routeParams.id).then(function(data) {
		$scope.loyality = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$scope.save = function() {
		var data = $scope.loyality;
		//if (data.user_id)
		//{
			data.token = token;
			$http.post(API_URL + 'dashboard/loyality', data).then(function(data) {
			    $http.get(API_URL + 'loyalityitem?token=' + token + '&id=' + $scope.loyality.id).then(function(data) {
				    loyal = data.data;
					    /*console.log(loyal);
				    var mydata = [];
				    for (i in loyal.card_users)
				    {
					mydata[i] = {};
					mydata[i].token = token;
					mydata[i].user_id = loyal.card_users[i].id;
					mydata[i].not_table = 'loyality';
					mydata[i].place_id = loyal.place_id;
					mydata[i].target_id = loyal.id;
					mydata[i].notification = "Изменение карты лояльности";
					$http.put(API_URL + 'notifications', mydata[i]);
				    }*/
				    alert("Карта лояльности успешно изменена");
				    $location.path('/dashboard/loyality/' + $scope.slug).replace();
			    }, function(data) { 
				    console.log(data);
			    });
			}, function(data) {
				console.log(data);
			});
		//}
		//else
		//{
		//	alert('Не выбран пользователь!');
		//}
	};
	
	$scope.delete = function(user, key) {
	    if (confirm("Вы уверены, что хотите отнять у пользователя карту лояльности?")) {
		$http.delete(API_URL + 'dashboard/loyalityuser?token=' + token + '&user_id=' + user + '&card_id=' + $scope.loyality.id).then(function(data) {
		    alert('Пользователь успешно удален');
		    $scope.loyality.card_users.splice(key,1);
		}, function(data) {
		    console.log(data);
		});
	    }
	};
});

app.controller('networkController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.slug = $scope.$routeParams.slug;
	$scope.network = {};
	$scope.network.places = [];
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/userplaces?token=' + token).then(function(data) {
		$scope.places = data.data;
	}, function(data) {
		console.log(data);
	});
	$scope.addplaceinnet = function(place) {
		if ($scope.network.places.indexOf(place) == -1) 
		{
			$scope.network.places.push(place);
		}
		else 
		{
			$scope.network.places.remove(place);
		}
	}
	$scope.save = function() {
		if ($scope.network.places.length >= 2)
		{
			var data = $scope.network;
			data.token = token;
			console.log(data);
			$http.put(API_URL + 'dashboard/network', data).then(function(data) {
				alert('Сеть заведений успешно создана');
				$location.path('/dashboard').replace();
			}, function(data) {
				console.log(data);
			});
		}
		else
		{
			alert('В сети должно быть как минимум 2 заведения');
		}
	}
});

app.controller('editnetworkController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.network = {};
	$scope.network.places = [];
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/userplacesall?token=' + token + '&id=' + $scope.$routeParams.id).then(function(data) {
		$scope.places = data.data;
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'dashboard/networkbyid?token=' + token + '&id=' + $scope.$routeParams.id).then(function(data) {
		$scope.network = data.data;
		$http.get(API_URL + 'dashboard/networkplaces?token=' + token + '&network_id=' + $scope.network.id).then(function(data) {
			$scope.network.places = [];
			for (i in data.data) $scope.network.places.push(data.data[i].id); 
		}, function(data) {
			console.log(data);
		});
	}, function(data) {
		console.log(data);
	});
	$scope.addplaceinnet = function(place) {
		if ($scope.network.places.indexOf(place) == -1) 
		{
			$scope.network.places.push(place);
		}
		else 
		{
			$scope.network.places.remove(place);
		}
	}
	$scope.save = function() {
		if ($scope.network.places.length >= 2)
		{
			var data = $scope.network;
			data.token = token;
			$http.post(API_URL + 'dashboard/network', data).then(function(data) {
				alert('Сеть заведений успешно изменена');
				$location.path('/dashboard').replace();
			}, function(data) {
				console.log(data);
			});
		}
		else
		{
			alert('В сети должно быть как минимум 2 заведения');
		}
	}
});

app.controller('settingsController', function($scope, $http, $location, $routeParams) {
	$scope.user = {};
	$scope.password = {};
	$scope.user.first_name = '';
	$scope.user.last_name = '';
	$scope.user.phone = '';
	$scope.user.agree = '';
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/user?token=' + token).then(function(data) {
		$scope.user = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$scope.personalsave = function() {
		var data = $scope.user;
		data.token = token;
		$http.post(API_URL + 'dashboard/user', data).then(function(data) {
			alert('Информация пользователя успешно изменена');
		}, function(data) {
			console.log(data);
		});
	}
	
	$scope.savepassword = function() {
		if ($scope.password.new == $scope.password.confirm && $scope.password.new != '')
		{
			$http.get(API_URL + 'dashboard/password?token=' + token + '&password=' + $scope.password.old).then(function(data) {
				if (data.data.user_id)
				{
					var xdata = $scope.password;
					xdata.token = token;
					$http.post(API_URL + 'dashboard/password', xdata).then(function(data) {
						alert('Пароль успешно изменён');
					}, function(data) {
						console.log(data);
					});
				}
				else alert('Старый пароль неверен!');
			}, function(data) {
				console.log(data);
			});
		}
		else alert('Новый пароль не совпадает со своим подтверждением');
	}
});


app.controller('myloyalityController', function($scope, $http, $location, $routeParams) {
	$scope.loyalities = [];
	$scope.info = '';
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/myloyality?token=' + token).then(function(data) {
	    $scope.loyalities = data.data;
	}, function(data) {
		console.log(data);
	});
	$scope.tab = 1;
	
	$scope.getcards = function() {
	    $http.get(API_URL + 'dashboard/myloyality?token=' + token).then(function(data) {
		$scope.loyalities = data.data;
	    }, function(data) {
		console.log(data);
	    });
	}
	
	$scope.clear = function() {
	    var mydata = {};
	    mydata.token = token;
	    mydata.not_table = 'loyality';
	    mydata.place_id = 0;
	    mydata.target_id = 0;
	    $http.post(API_URL + 'notifications', mydata);
	}
	
	var mydata = {};
	mydata.token = token;
	mydata.not_table = 'loyality';
	mydata.place_id = 0;
	mydata.target_id = 0;
	$http.post(API_URL + 'notifications', mydata);
	
	$scope.delete = function(card, place_id, owner_id, key) {
	    if (confirm("Вы уверены, что хотите удалить карту лояльности?")) {
		$http.delete(API_URL + 'dashboard/loyalityfromuser?token=' + token + '&card_id=' + card).then(function(data) {
		    $scope.loyalities.splice(key,1);
		}, function(data) {
		    console.log(data);
		});
	    }
	};
	
	$scope.showmore = function(info, target, key) {
	    $scope.info = info;
	    $("#info").modal("show");
	    var mydata = {};
	    mydata.token = token;
	    mydata.not_table = 'loyality';
	    mydata.target_id = target;
	    mydata.place_id = 0;
	    $http.post(API_URL + 'notifications', mydata);
	    $scope.loyalities[key].notify = null;
	};

	$scope.showqr = function(info, target, key) {
	    $(".qr" + info).modal("show");
	};
	
	$scope.deletenot = function(target) {
	    /*if (confirm("Вы действительно хотите удалить это уведомление?")) {
		var mydata = {};
		mydata.token = token;
		mydata.not_table = 'loyality';
		mydata.place_id = 0;
		mydata.target_id = target;
		$http.post(API_URL + 'notifications', mydata);
	    }*/
	    if (confirm("Вы действительно хотите удалить это уведомление?")) {
			$http.delete(API_URL + 'notifications?token=' + token + '&id=' + target);
			$scope.$parent.allnotif.splice(node, 1);
	    }
	};

	$scope.deleteallnot = function(target) {
	    /*if (confirm("Вы действительно хотите удалить это уведомление?")) {
		var mydata = {};
		mydata.token = token;
		mydata.not_table = 'loyality';
		mydata.place_id = 0;
		mydata.target_id = target;
		$http.post(API_URL + 'notifications', mydata);
	    }*/
	    if (confirm("Вы действительно хотите удалить все уведомления?")) {
			$http.delete(API_URL + 'notifications?token=' + token + '&not_table=loyality');
			$scope.$parent.allnotif = [];
	    }
	};
});

app.controller('myreviewsController', function($scope, $http, $location, $routeParams) {
	$scope.reviews = [];
	$scope.fpr = 0;
	$scope.page = 1;
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'myreviews?token=' + token + '&limit=10&offset=0').then(function(data) {
		$scope.reviews = data.data;
	}, function(data) {
		console.log(data);
	});
	
	$scope.getResult = function() {
	    $http.get(API_URL + 'myreviews?token=' + token + '&limit=10&offset=' + (page * 10)).then(function(data) {
		$scope.reviews = $scope.reviews.concat(data.data);
		$scope.page++;
	    }, function(data) {
		    console.log(data);
	    });
	}
});


app.controller('mypromoController', function($scope, $http, $location, $routeParams) {
	$scope.promos = [];
	$scope.usedpromos = [];
	$scope.tab = 1;
	$scope.showqr = function(info, target, key) {
	    $(".qr" + info).modal("show");
	};
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/mypromo?token=' + token).then(function(data) {
		$scope.promos = data.data;
	}, function(data) {
		console.log(data);
	});
	$http.get(API_URL + 'dashboard/mypromoused?token=' + token).then(function(data) {
		$scope.usedpromos = data.data;
	}, function(data) {
		console.log(data);
	});
});

app.controller('mybooksController', function($scope, $http, $location, $routeParams) {
	$scope.fpr = 0;
	$scope.ppr = 0;
	$scope.gtab = 1;
	$scope.bookcomment = '';
	$scope.booknum = '';
	$scope.books = [];
	$scope.pbooks = [];
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/mybooks?token=' + token).then(function(data) {
		var mydata = {};
		mydata.token = token;
		mydata.not_table = 'booking';
		mydata.place_id = 0;
		mydata.target_id = 0;
		$http.post(API_URL + 'notifications', mydata);
		for (i = 0; i < data.data.length; i++) {
			data.data[i].book_date = dateFormat(data.data[i].book_date, 'UTC:dddd, d mmmm, yyyy, HH:MM');
		};
		$scope.books = data.data;
	}, function(data) {
		console.log(data);
	});
	$scope.setbookinfo = function(name, comment) {
	    $scope.bookcomment = comment;
	    $scope.booknum = name;
	}
	$http.get(API_URL + 'dashboard/mypbooks?token=' + token).then(function(data) {
		for (i = 0; i < data.data.length; i++) {
			data.data[i].book_date = dateFormat(data.data[i].book_date, 'UTC:dddd, d mmmm, yyyy, HH:MM');
		};
		$scope.pbooks = data.data;
	}, function(data) {
		console.log(data);
	});
	$scope.reject = function(id, key)
	{
		if (confirm('Вы уверены, что хотите отменить бронь?')) 
		{
			var data = {};
			data.id = id;
			data.place_id = 0;
			data.token = localStorage.getItem("token");
			$http.post(API_URL + 'dashboard/rejectBooking', data).then(function(data) { 
				$scope.books[key].reject_user = $scope.books[key].user_id;
				var mydata = {};
				mydata.place_id = data.data.place_id;
				mydata.user_id = data.data.user_id;
				mydata.target_id = id;
				mydata.not_table = 'booking';
				mydata.notification = 'Отмена брони в ресторане';
				$http.put(API_URL + 'notifications', mydata).then(function(data) { console.log(data);
					$scope.books[key].reject = true;
					alert('Бронь отменена!');
				}, function(data) {
					console.log(data);
				});			
			}, function(data) {
				console.log(data);
			});
		}
	}
});

app.controller('mypromotionsController', function($scope, $http, $location, $routeParams) {
	$scope.promotions = [];
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'dashboard/mypromotions?search=&token=' + token).then(function(data) {
		$scope.promotions = data.data;
	}, function(data) {
		console.log(data);
	});
	$scope.tab = 1;
	
	$scope.getpromos = function() {
	    $http.get(API_URL + 'dashboard/mypromotions?search=&token=' + token).then(function(data) {
		$scope.promotions = data.data;
	    }, function(data) {
		    console.log(data);
	    });
	}
	
	$scope.clear = function() {
	    var mydata = {};
	    mydata.token = token;
	    mydata.not_table = 'promotions';
	    mydata.place_id = 0;
	    mydata.target_id = 0;
	    $http.post(API_URL + 'notifications', mydata);
	}
	
	$scope.getResult = function() {
		$scope.promotions_page = 0;
		$scope.promotions = [];
		$http.get(API_URL + 'dashboard/mypromotions?token=' + token + '&search=' + $scope.search.toLowerCase()).then(function(data) {
			$scope.promotions = $scope.promotions.concat(data.data);
			$scope.promotions_page += 10;
		}, function(data) {
			console.log(data);
		});
	}
	$scope.deletenot = function(target, node) {
	    if (confirm("Вы действительно хотите удалить это уведомление?")) {
		$http.delete(API_URL + 'notifications?token=' + token + '&id=' + target);
		$scope.$parent.allnotif.splice(node, 1);
	    }
	};

	$scope.deleteallnot = function(target) {
	    /*if (confirm("Вы действительно хотите удалить это уведомление?")) {
		var mydata = {};
		mydata.token = token;
		mydata.not_table = 'loyality';
		mydata.place_id = 0;
		mydata.target_id = target;
		$http.post(API_URL + 'notifications', mydata);
	    }*/
	    if (confirm("Вы действительно хотите удалить все уведомления?")) {
			$http.delete(API_URL + 'notifications?token=' + token + '&not_table=promotions');
			$scope.$parent.allnotif = [];
	    }
	};
});

app.controller('promotionController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.promotion = {};
	var token = localStorage.getItem("token");
	var mydata = {};
	mydata.item_id = $scope.$routeParams.id;
	$http.post(API_URL + 'visitors/article', mydata);
	var mydata = {};
	mydata.token = token;
	mydata.not_table = 'promotions';
	mydata.place_id = 0;
	mydata.target_id = $scope.$routeParams.id;
	$http.post(API_URL + 'notifications', mydata);
	$http.get(API_URL + 'promotion?id=' + $scope.$routeParams.id).then(function(data) {
		data.data[0].starts = dateFormat(data.data[0].starts, 'd.mm.yyyy');
		data.data[0].ends = dateFormat(data.data[0].ends, 'd.mm.yyyy');
		data.data[0].availability = JSON.parse(data.data[0].availability);
		var av = [];
		if (data.data[0].availability[0] == true) av.push('понедельник');
		if (data.data[0].availability[1] == true) av.push('вторник');
		if (data.data[0].availability[2] == true) av.push('среда');
		if (data.data[0].availability[3] == true) av.push('четверг');
		if (data.data[0].availability[4] == true) av.push('пятница');
		if (data.data[0].availability[5] == true) av.push('суббота');
		if (data.data[0].availability[6] == true) av.push('воскресенье');
		data.data[0].availability = av.join(', ');
		$scope.promotion = data.data[0];
	}, function(data) {
		console.log(data);
	});
});

app.controller('newController', function($scope, $http, $location, $routeParams) {
	$scope.$routeParams = $routeParams;
	$scope.promotion = {};
	var token = localStorage.getItem("token");
	$http.get(API_URL + 'new?id=' + $scope.$routeParams.id).then(function(data) {
		$scope.promotion = data.data[0];
	}, function(data) {
		console.log(data);
	});
});

/*app.directive('fancybox', function($compile) {
  return {
    restrict: 'A',
    replace: false,
    link: function($scope, element, attrs) {

      $scope.open_fancybox = function() {
        
        var el = angular.element(element.html()),

        compiled = $compile(el);
        
        $.fancybox.open(el);

        compiled($scope);
     
      };
    }
  };
});*/


app.directive('makeQrcodes', function() {
	return function(scope, element, attrs) {
		console.log(element);
		console.log(attrs);
		element.qrcode(attrs.fingerprint);
	};
});

app.directive('makeQrcodesPromo', function() {
	return function(scope, element, attrs) {
		console.log(element);
		console.log(attrs);
		element.qrcode(attrs.code);
	};
});

app.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
		title: 'Menuman - система управления заведениями',
		templateUrl: 'assets/templates/index.html'
	})
	.when('/news', {
		title: "Новости",
		templateUrl: 'assets/templates/news.html'
	})
	.when('/promotions', {
		title: "Акции",
		templateUrl: 'assets/templates/promotions.html'
	})
	.when('/places', {
		title: "Заведения",
		templateUrl: 'assets/templates/places.html'
	})
	.when('/goods', {
		title: "Блюда",
		templateUrl: 'assets/templates/goods.html'
	})
	.when('/dashboard', {
		title: "Личный кабинет",
		templateUrl: 'assets/templates/dashboard/dashboard.html'
	})
	.when('/dashboard/add-place', {
		title: "Добавить заведение",
		templateUrl: 'assets/templates/dashboard/addplace.html'
	})
	.when('/dashboard/edit-place/:slug', {
		title: "Редактировать заведение",
		templateUrl: 'assets/templates/dashboard/editplace.html'
	})
	.when('/dashboard/menu/:slug', {
		title: "Меню заведения",
		templateUrl: 'assets/templates/dashboard/menu.html'
	})
	.when('/dashboard/goodicons/:slug', {
		title: "Фотографии блюд",
		templateUrl: 'assets/templates/dashboard/goodicons.html'
	})
	.when('/dashboard/reviews/:slug', {
		title: "Отзывы",
		templateUrl: 'assets/templates/dashboard/reviews.html'
	})
	.when('/dashboard/discount/:slug', {
		title: "Скидки для посетителей",
		templateUrl: 'assets/templates/dashboard/discount.html'
	})
	.when('/dashboard/booking/:slug', {
		title: "Забронированные столы",
		templateUrl: 'assets/templates/dashboard/bookings.html'
	})
	.when('/dashboard/promo/:slug', {
		title: "Проверка промокода",
		templateUrl: 'assets/templates/dashboard/promo.html'
	})
	.when('/dashboard/news/:slug', {
		title: "Новости",
		templateUrl: 'assets/templates/dashboard/news.html'
	})
	.when('/dashboard/news/add/:slug', {
		title: "Добавить новость",
		templateUrl: 'assets/templates/dashboard/addnews.html'
	})
	.when('/dashboard/news/edit/:slug/:id', {
		title: "Редактировать новость",
		templateUrl: 'assets/templates/dashboard/editnews.html'
	})
	.when('/dashboard/promotions/:slug', {
		title: "Акции",
		templateUrl: 'assets/templates/dashboard/promotions.html'
	})
	.when('/dashboard/promotions/add/:slug', {
		title: "Добавить акцию",
		templateUrl: 'assets/templates/dashboard/addpromotions.html'
	})
	.when('/dashboard/promotions/edit/:slug/:id', {
		title: "Редактировать акцию",
		templateUrl: 'assets/templates/dashboard/editpromotions.html'
	})
	.when('/dashboard/loyality/:slug/', {
		title: "Карты лояльности",
		templateUrl: 'assets/templates/dashboard/loyality.html'
	})
	.when('/dashboard/loyality/add/:slug/', {
		title: "Создать карту лояльности",
		templateUrl: 'assets/templates/dashboard/addloyality.html'
	})
	.when('/dashboard/loyality/edit/:slug/:id', {
		title: "Изменить карту лояльности",
		templateUrl: 'assets/templates/dashboard/editloyality.html'
	})
	.when('/dashboard/settings', {
		title: "Настройки пользователя",
		templateUrl: 'assets/templates/dashboard/settings.html'
	})
	.when('/dashboard/add-network', {
		title: "Добавить сеть заведений",
		templateUrl: 'assets/templates/dashboard/addnetwork.html'
	})
	.when('/dashboard/edit-network/:id', {
		title: "Изменить сеть заведений",
		templateUrl: 'assets/templates/dashboard/editnetwork.html'
	})
	.when('/dashboard/grants/:slug', {
		title: "Изменить сеть заведений",
		templateUrl: 'assets/templates/dashboard/editnetwork.html'
	})
	.when('/dashboard/visitors/:slug', {
		title: "Посетители",
		templateUrl: 'assets/templates/dashboard/visitors.html'
	})
	.when('/dashboard/my-loyality', {
		title: "Мои карты лояльности",
		templateUrl: 'assets/templates/dashboard/myloyality.html'
	})
	.when('/dashboard/my-promo', {
		title: "Мои карты лояльности",
		templateUrl: 'assets/templates/dashboard/mypromo.html'
	})
	.when('/dashboard/my-books', {
		title: "Мои карты лояльности",
		templateUrl: 'assets/templates/dashboard/mybooks.html'
	})
	.when('/dashboard/my-promotions', {
		title: "Мои карты лояльности",
		templateUrl: 'assets/templates/dashboard/mypromotions.html'
	})
	.when('/dashboard/my-reviews', {
		title: "Мои отзывы",
		templateUrl: 'assets/templates/dashboard/myreviews.html'
	})
	.when('/news/:id', {
		title: "Новость",
		templateUrl: 'assets/templates/new.html'
	})
	.when('/profile/:id', {
		title: "Профиль пользователя",
		templateUrl: 'assets/templates/profile.html'
	})
	.when('/promotions/:id', {
		title: "Акция",
		templateUrl: 'assets/templates/promotion.html'
	})
	.when('/:slug', {
		title: "Ресторан",
		templateUrl: 'assets/templates/card.html'
	});
	$locationProvider.html5Mode(true);
});