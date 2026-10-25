<div class="container content" ng-controller="myreviewsController as drCntr" ng-show="group === 'admin' || group === 'company'">
	<div class="row">
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h1>Отзывы</h1>
			<nav class="nav nav-pills flex-column flex-sm-row col-12" style="margin-bottom: 20px;" id="futbok">
			    <a ng-click="fpr = 0" class="nav-link active" onclick="$('#futbok .nav-link').removeClass('active'); $(this).addClass('active');">Все</a> <a ng-click="fpr = 1" class="nav-link" onclick="$('#futbok .nav-link').removeClass('active'); $(this).addClass('active');">Отвеченные</a> <a ng-click="fpr = 2" class="nav-link" onclick="$('#futbok .nav-link').removeClass('active'); $(this).addClass('active');">Неотвеченные</a>
			</nav>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" ng-if="reviews.length == 0">
			<h2 class="text-center">На данный момент отзывов нет</h2>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 30px; margin-top: 30px;">
			<div class="reviewcard mdl-card mdl-shadow--2dp row col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" ng-repeat="review in reviews track by $index" ng-class="{ 'notans': review.answer_date == null, 'ans': review.answer_date != null}" style="margin-bottom: 15px;" ng-show="(review.answer_date != null && (fpr == 0 || fpr == 1)) || (review.answer_date == null && (fpr == 0 || fpr == 2))">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mdl-card__title" ng-class="{ 'notanswered': review.answer_date == null, 'answered': review.answer_date != null}" style="color: #fff; width: 100%;">
				    <h2 class="mdl-card__title-text">Вы оставили отзыв заведению <a href="{{ review.slug }}">{{ review.name }}</a></h2>
				</div>
			</div>
		</div>
	</div>
</div>