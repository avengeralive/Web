
var reactfix = function(elem) {
    var html_name = '_' + elem + '_html';
    // PJAX FIX
    if (window[html_name] != undefined) {
        var nocache = $(elem).html();
        $(elem).html(window[html_name]);
    } else {
        window[html_name] = $(elem).html();
    }
}

function invest(product_id)
{
    
 $.ajax({
	type: 'POST',
	url: product_url,
	data: {
		id: product_id,
		_token: csrf
	},
	success:function(data) 
	{
    	reactfix('#js-invest_modal');
    	
    	var app = new Vue({
          el: '#js-invest_modal',
          data: {
            product: data,
            price: 0,
            time: 0
          },
          created: function(){
              Vue.nextTick(function(){
                  $('#invest_modal').modal('show');
                  $('#invest_modal .close').one('click', function(){
                      $('#invest_modal').hide();
                      $('.modal-backdrop').remove();
                      $('body').removeClass('modal-open');
                  });
              });
          },
          methods: {
              send: function(){
                  var self = this;
                  
                  $.ajax({
					type: 'POST',
					url: '/invest',
					data: {
						id: product_id,
						summ: self.price,
						time: self.time,  
						_token: csrf
					},
					success:function(data) {
						console.log(data);
						if (data.success) {
							$('#invest_modal').hide();
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
				
							$('#completeModal').modal('show');
						}
						else {
							$('#invest_modal').hide();
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
							$('#errorInvest').modal('show');
						}
					},
					error: function (error) {
                        $('#invest_modal').hide();
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
						$('#errorInvest').modal('show');
					}
				});
              }
          }
        });
    }
});

}


var ctx = null;
var chart = null;

function build_chart()
{ //console.log("!!!");
  var summ = parseInt($('#calc_sum').val());
    var month = parseInt($('#calc_month').val());
  am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

 // Create chart instance
var chart = am4core.create("chartdiv3", am4charts.XYChart);
chart.data = [];
$('.calculator__select-items li.active').each(function( index, value ) {
  chart.data.push({"year": $(this).text(), "income": Math.round(summ), "expenses": Math.round($(this).data('percent')/100*month*summ*0.87/12) });
    });

// Add data
/*chart3.data = [{
  "year": 2005,
  "income": 23.5,
  "expenses": 18.1
},{
  "year": 2006,
  "income": 26.2,
  "expenses": 22.8
},{
  "year": 2007,
  "income": 30.1,
  "expenses": 23.9
},{
  "year": 2008,
  "income": 29.5,
  "expenses": 25.1
},{
  "year": 2009,
  "income": 24.6,
  "expenses": 25
}];*/

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.numberFormatter.numberFormat = "#";
categoryAxis.renderer.inversed = true;
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.cellStartLocation = 0.1;
categoryAxis.renderer.cellEndLocation = 0.9;

var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis()); 
valueAxis.renderer.opposite = true;

// Create series
function createSeries(field, name) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueX = field;
  series.dataFields.categoryY = "year";
  series.name = name;
  series.columns.template.tooltipText = "{name}: [bold]{valueX}[/]";
  series.columns.template.height = am4core.percent(100);
  series.sequencedInterpolation = true;

  var valueLabel = series.bullets.push(new am4charts.LabelBullet());
  valueLabel.label.text = "{valueX}";
  valueLabel.label.horizontalCenter = "left";
  valueLabel.label.dx = 10;
  valueLabel.label.hideOversized = false;
  valueLabel.label.truncate = false;

  var categoryLabel = series.bullets.push(new am4charts.LabelBullet());
  categoryLabel.label.text = "{name}";
  categoryLabel.label.horizontalCenter = "right";
  categoryLabel.label.dx = -10;
  categoryLabel.label.fill = am4core.color("#fff");
  categoryLabel.label.hideOversized = false;
  categoryLabel.label.truncate = false;
}

createSeries("income", "Вклад");
createSeries("expenses", "Выплаты");

});

/*
    var company_name = [];
    var company_percent = [];
    var company_sum = [];
    
    var summ = parseInt($('#calc_sum').val());
    var month = parseInt($('#calc_month').val());
    
    $('.calculator__select-items li.active').each(function( index, value ) {
  
        company_name.push($(this).text());
        company_sum.push(Math.round(summ));
        company_percent.push(Math.round($(this).data('percent')/100*month/12*summ));
        
    });
    
    if(chart !== null) chart.destroy();
    
    chart = new Chart(ctx, {
        type: 'bar',
        height: 260,
        data: {
          labels: company_name,
          datasets: [{
            label: 'Сумма вложений',
            data: company_sum,
            backgroundColor: 'rgb(0, 127, 154)'
          },
            {
              label: 'Заработок',
              data: company_percent,
              backgroundColor: 'rgb(0, 193, 234)',
            },
          ]
        },
        options: {
          scales: {
            xAxes: [{
              stacked: true
            }],
            yAxes: [{
              stacked: true
            }]
          },
          tooltips: {
    
          },
        }
      }); 

    */
}

$(function () {

  //chart
  
  //if($('#chart').length > 0)
  //{
      
      //ctx = document.getElementById("chart");
      
      $('.calculator__select-items li').click(function(){
         console.log("!");
          $(this).toggleClass('active');
          build_chart();
      });
      
      
      $('#calc_sum,#calc_month').keyup(build_chart);
  //}


  //chart end


  $('.toggle').click(function (e) {
    e.preventDefault();

    var $this = $(this);

    if ($this.hasClass('show')) {
      $this.removeClass('show');
    }else{
      $this.parent().parent().find('.questions__title').removeClass('show');
      $this.toggleClass('show');
    }

    if ($this.next().hasClass('show')) {
      $this.next().removeClass('show');
      $this.next().slideUp(350);
    } else {
      $this.parent().parent().find('.questions__item .inner').removeClass('show');
      $this.parent().parent().find('.questions__item .inner').slideUp(350);
      $this.next().toggleClass('show');
      $this.next().slideToggle(350);
    }
  });
  
 
  $('.catalog__items a').click(function(){
      
      var cat_id = $(this).data('id');
      
      $('.catalog__items a').removeClass('active');
      
      $(this).addClass('active');
      
      $('.catalog-content .product').hide();
      $('.catalog-content .cat_' + cat_id).show();
  });


  $(".inputs-number").keyup(function () {
    if (this.value.length === this.maxLength) {
      var $next = $(this).next('.inputs-number');
      if ($next.length)
        $(this).next('.inputs-number').focus();
      else
        $(this).blur();
    }
  });

  //Dropdown
  window.dropdownMenuHeader = function () {
    document.getElementById("dropdown-menu").classList.toggle("show");
  };
  //close dropdown
  window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {

      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };

  var container = $('.container-img'), inputFile = $('#file'), img, btn, txt = 'Выбрать',
    txtAfter = 'Выбрать другую картинку';

/*
  if (!container.find('#upload').length) {
    container.find('.input').append('<input type="button" value="' + txt + '" class="upload" id="upload">');
    btn = $('#upload');
    container.prepend('<img src="" class="hidden upload-img" alt=" " id="uploadImg">');
    img = $('#uploadImg');
  }

  btn.on('click', function () {
    //img.animate({opacity: 0}, 300);
    inputFile.click();
  });
*/

  inputFile.on('change', function (e) {
    //container.find('label').html( inputFile.val() );

    var i = 0;
    for (i; i < e.originalEvent.srcElement.files.length; i++) {
      var file = e.originalEvent.srcElement.files[i],
        reader = new FileReader();

      reader.onloadend = function () {
        img.attr('src', reader.result).animate({opacity: 1}, 700);
      };
      reader.readAsDataURL(file);
      img.removeClass('hidden');
    }
    btn.val(txtAfter);

  });


//scroll pages
  var jump = function (e) {
    if (e) {
      e.preventDefault();
      var target = $(this).className('nav-target').attr("href");
    } else {
      var target = location.hash;
    }

    $('html,body').animate(
      {
        scrollTop: $(target).offset().top
      }, 2000, function () {
        location.hash = target;
      });
  };

  $('html, body').hide();
  $(document).ready(function () {
    $('a[href^=\\#].nav-target').bind("click", jump);
    if (location.hash) {
      setTimeout(function () {
        $('html, body').scrollTop(0).show();
        jump();
      }, 0);
    } else {
      $('html, body').show();
    }
  });
//scroll pages end


//open list
  $('.calculator__select-container').on('click', function (e) {
    $(this).toggleClass("open");
    e.preventDefault();
  });
//open list end

//range slider
  var slider = document.getElementById("range-invested");
  var output = document.getElementById("range-value");
  if (slider != null && output != null) {
    output.innerHTML = slider.value;
  } else {
    return;
  }

  slider.oninput = function () {
    output.innerHTML = this.value;
    var width = this.value / (this.max / 100);
    
    document.getElementById("range-slider-width").style.width = width + '%';
  };
//range slider end

});



$(document).ready(function(){
    if($(".owl-carousel").length > 0)
    {
      $(".owl-carousel").owlCarousel({
          loop: true,
          autoplay: true,
          autoplayTimeout: 15000,
          autoplayHoverPause: true,
          items: 1
      });
    }
    
    if($('.catalog__items').length > 0)
    {
       $('.catalog__items a[data-id=12]').click();
    }
    

});
