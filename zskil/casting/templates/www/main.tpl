{include file="incl/header.tpl"}
{include file="incl/top.tpl"}

		<div class="section">
			<div class="row">
				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center"><i class="material-icons">sentiment_very_satisfied</i></h2>
						<h5 class="center">Красота</h5>

						<p class="light">Слова "макияж" и "шоппинг" не являются для тебя непонятными терминами. Ты умеешь и знаешь как следить за красотой и считаешь, что лучшая в этом? Учавствуй в конкурсе!.</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center"><i class="material-icons">fitness_center</i></h2>
						<h5 class="center">Молодость</h5>

						<p class="light">Ты полна жизни и энергии и хочешь поделиться ею с миром? Ты ведешь активный и здоровый образ жизни и мечтаешь донести это до окружающих? Этот конкурс для тебя!</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center"><i class="material-icons">favorite_border</i></h2>
						<h5 class="center">Семья</h5>

						<p class="light">Вы с молодым человеком являетесь примерными образцами молодой семьи? Ваши отношения достигли максимального уровня гармонии? Докажи это в конкурсе!</p>
					</div>
				</div>
			</div>
		</div>

		{if !empty($anket_sended)}
			<div class="section anket">
				<div class="row">
					<div class="col s12 m12 l12 xl8 offset-xl2">
						<ul>
							<li class="green-text">Ваше личное дело принято к рассмотрению. Ожидайте повестку!</li>
						</ul>
					</div>
				</div>
			</div>
		{else}
			{include file="incl/anket.tpl"}
		{/if}

{include file="incl/bottom.tpl"}
{include file="incl/footer.tpl"}
