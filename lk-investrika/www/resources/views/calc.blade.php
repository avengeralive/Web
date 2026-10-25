@extends('layouts.old_insideapp')

@section('content')
<div class="container" style="padding-top: 6.75rem;">

    <div class="row justify-content-center pt-2 pb-5">
		<div class="col-12">
			<h1 class="header">Личный кабинет</h1>
		</div>
	</div>
    <div class="row justify-content-center" id="products">

		@if(Auth::check())

			<div class="col-lg-4 pr-lg-5">
				<ul style="list-style: none; padding-left: 0;">
					<li class="mb-2 rounded">
						<a href="{{route('account')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item pl-3 py-2">Перечень инвестиций</div></a>
					</li>
					<li class="mb-2 rounded">
						<a href="{{route('calc')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item active pl-3 py-2">Инвестиционный калькулятор</div></a>
					</li>
					<li class="mb-2 rounded">
						<a href="{{route('level')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item pl-3 py-2">Шкала инвестора</div></a>
					</li>
					<li class="mb-2 rounded">
						<a href="{{route('manager')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item pl-3 py-2">Личный менеджер</div></a>
					</li>
				</ul>
			</div>
			<div class="col-lg-8 rounded">
				<div class="row">
					<div class="col-lg-6 col-xl-6 d-flex align-self-stretch text-white py-2">
						<span class="text-dark" style="font-weight: 600;">Выберите компании{{--<span style="color: #03849f; border-bottom: 1px dashed #03849f;">перечень компаний</span> --}} для рассчета прибыли:</span>
					</div>
					<div class="col-lg-6 col-xl-6 d-flex align-self-stretch text-white">
						<div class="form-group w-100">
						
						<!-- Build your select: -->
						<multiselect :limit="0" :limit-text="displayText"  v-on:input="reRender" v-model="value" :multiple="true" :options="options" :searchable="false" :close-on-select="false" :show-labels="false" label="name" track-by="id" placeholder="Наименование компании">
						{{--<template slot="option" :click="doFocus" slot-scope="props">
							
							  <div class="input-group">
								<div class="input-group-prepend">
								  <div class="input-group-text">@{{ props.option.name }}</div>
								</div>
								<input type="number" v-model="props.option.summ" :id="'investmentSumm'+props.option.id" class="form-control" placeholder="Сумма">
							  </div>
							
							</template>--}}
						</multiselect>

							<!--<select id="example-getting-started" multiple="multiple">
								@foreach (App\Product::all() as $index => $product)
									<option>
										{{$product->name}}
									</option>
								@endforeach
							</select>-->
						</div>
					</div>
				</div>
				<div class="row mt-4 pt-3 bg-white rounded">
					<div class="col-12">
					  <div class="form-group row px-3">
						<label for="inputEmail3" class="col-lg-3 col-form-label font-weight-bold" style="color: #03849f;">Сумма (руб.):</label>
						<div class="col-lg-3">
						  <input type="number" class="form-control" id="invSumm" placeholder="Сумма" v-model="summ" v-on:input="reRender"  style="border-radius: 1.25rem;">
						</div>
						<label for="fromto" class="col-lg-3 col-form-label font-weight-bold" style="color: #03849f;">Срок (мес.):</label>
						<div class="col-lg-3">
							<div class="input-group" id="fromto">
								<input type="number" class="form-control" id="time" v-model="time" v-on:input="reRender"  placeholder="Срок" style="border-radius: 1.5rem;">
							</div>
						</div>
						
					  </div>
					</div>
					<div class="col-12">
						<line-chart :options="{responsive: true, maintainAspectRatio: false, legend: {labels: { fontColor: 'white' } }, animation: { duration: 0 }}"></line-chart>
					</div>
				</div>
			</div>
	
		@endif

    </div>
</div>

<script>

$(document).ready(function(){
	
	Vue.component('line-chart', {
	  extends: VueChartJs.Bar,
	  mounted: function () {
		  
		this.renderChart(this.$parent.chartData, this.$parent.chartOptions );

	  }
	});
	
	
	
	
			// Define a plugin to provide data labels
		Chart.plugins.register({
			afterDatasetsDraw: function(chart) {
				var ctx = chart.ctx;

				chart.data.datasets.forEach(function(dataset, i) {
					var meta = chart.getDatasetMeta(i);
					if (!meta.hidden) {
						meta.data.forEach(function(element, index) {
							if (window.innerWidth>=768) {

								// Draw the text in black, with the specified font
								ctx.fillStyle = 'rgb(255, 255, 255)';

								var fontSize = 16;
								var fontStyle = 'bold';
								var fontFamily = 'Helvetica Neue';
								ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

								// Just naively convert to string for now
								var dataString = dataset.data[index].toString();
								
								// Make sure alignment settings are correct
								ctx.textAlign = 'center';
								ctx.textBaseline = 'middle';

								var padding = -20;
								var position = element.tooltipPosition();
								//console.log(chart.data.datasets[0].data[index]+' base '+index);
								//console.log(dataset.data + ' '+i+' index: '+index);
								if (i==1) {
									//console.log(chart.data.datasets[0].data[index]/chart.data.datasets[i].data[index]);
									if (chart.data.datasets[0].data[index]/chart.data.datasets[i].data[index]<=10) ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
								}
								else ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
							}
						});
					}
				});
			}
		});
	
	
	new Vue({
		el: '#products',
		components: {
			multiselect: VueMultiselect.Multiselect
		},
		data: {
			summ: 100000,
			time: 12,
			
			chartOptions: {
				responsive: true,
				scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					},
					stacked: true
				}],
				xAxes: [{
					stacked: true,
				}]
				},
				maintainAspectRatio: false
			},
			chartData: 
			{
				  labels: [],
				  datasets: [
					{
					  label: 'Сумма вложений',
					  backgroundColor: '#03849f',
					  data: []
					},
					{
					  label: 'Заработок',
					  backgroundColor: '#76cbc6',
					  data: []
					}
				  ]
			},
			
			
			investments: [
				@foreach (App\Product::all() as $index => $product)
				{
					id: {{$product->id}},
					name: '{{$product->name}}',
					description: '{{$product->description}}',
					image: 
					@if (isset($product->images[0]))
						{{$product->images[0]->id}}
					@else
						0
					@endif
					{{--@foreach ($product->attributes as $attribute)
								{{$attribute->name}}: <span style="color: #03849f;">{{ $attribute->pivot->value }}</span>
					@endforeach--}}
				}
				@if ($index < App\Product::all()->count()-1)
					,
				@endif
				@endforeach
			],

			value: [],
			options: [
				@foreach (App\Product::all() as $index => $product)
				{
					name: '{{$product->name}}',
					id: {{$product->id}},
					summ: 100,
					percent: {{$product->percent}}
				}
					@if ($index < App\Product::all()->count()-1)
					,
					@endif
				@endforeach			
			]

		},
		methods: {
			displayText: function (count){
				return '';
			},
			
			
			reRender: function(objects) {
				//$('#investmentSumm'+objects[objects.length-1].id).focus();
				var resnames = [];
				for (i=0; i<this.value.length; i++) {
					resnames.push(this.value[i].name);
				}
				
				//this.value[this.value.length-1].summ = $('#invSumm').val();
				
				var resdata = [];
				for (i=0; i<this.value.length; i++) {
					//resdata.push(Math.round(this.value[i].summ));
					resdata.push(Math.round(this.summ));
				}
				
				var respercent = [];
				for (i=0; i<this.value.length; i++) {
					//respercent.push(Math.round(this.value[i].percent/100*this.value[i].summ));
					respercent.push(Math.round(this.value[i].percent/100*this.time/12*this.summ));
					//this.chartData.datasets[0].data[i] = this.value[i].percent;
				}
				
				if (this.$children.length) {
					this.chartData.datasets[0].data = resdata;
					this.chartData.datasets[1].data = respercent;
					this.chartData.labels = resnames;
				}
				if (this.$children[1].$data._chart)	this.$children[1].$data._chart.destroy();
				this.$children[1].renderChart(this.chartData, this.chartOptions );
			},
			// TODO computed values for cart count and cart total
			getProducts: function (category_id) {
				$.ajax({
					type: 'POST',
					url: '{{route('productsOfCategory.ajax')}}',
					data: {
						categoryId: category_id,
						_token: '{{ csrf_token() }}'
					},
					success:function(data) {
						console.log(data);
						this.products = [];
						for (var i=0; i<data.products.length; i++) {
							this.products.push({id: data.products[i].id, name: data.products[i].name, description: data.products[i].description, image: data.products[i].image});
						}
					}.bind(this)
				});
			}
		}
	});
});
</script>


@endsection
