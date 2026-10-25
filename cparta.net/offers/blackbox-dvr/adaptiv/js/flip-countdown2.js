function CountdownTracker(label, value) {

  var el = document.createElement('span');

  el.className = 'flip-clock__piece';
  el.innerHTML = '<b class="flip-clock__card card"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b>' +
    '<span class="flip-clock__slot">' + label + '</span>';

  this.el = el;

  var top = el.querySelector('.card__top'),
    bottom = el.querySelector('.card__bottom'),
    back = el.querySelector('.card__back'),
    backBottom = el.querySelector('.card__back .card__bottom');

  this.update = function (val) {
    val = ('0' + val).slice(-2);
    if (val !== this.currentValue) {

      if (this.currentValue >= 0) {
        back.setAttribute('data-value', this.currentValue);
        bottom.setAttribute('data-value', this.currentValue);
      }
      this.currentValue = val;
      top.innerText = this.currentValue;
      backBottom.setAttribute('data-value', this.currentValue);

      this.el.classList.remove('flip');
      void this.el.offsetWidth;
      this.el.classList.add('flip');
    }
  }

  this.update(value);
}

// Calculation adapted from https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/

function getTimeRemaining() {
  let t = new Date();
  return {
    'часов': 23 - t.getHours(),
    'минут': 59 - t.getMinutes(),
    'секунд': 60 - t.getSeconds()
  };
}

function Clock(box) {
  this.el = document.getElementsByClassName(box);
  this.el.className = 'flip-clock';

  var trackers = {},
    t = getTimeRemaining(),
    key, timeinterval;


    for ( key in t ){
      trackers[key] = new CountdownTracker(key, t[key]);
      this.el[0].appendChild(trackers[key].el);
    }

  function updateClock() {
    timeinterval = requestAnimationFrame(updateClock);

    var t = getTimeRemaining();

    for (key in trackers) {
      trackers[key].update(t[key]);
    }
  }

  setTimeout(updateClock, 500);
}

Clock('clock2');