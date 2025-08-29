/* easing functions from: https://github.com/gdsmith/jquery.easing/blob/master/jquery.easing.js
*/

var easeOutBounce = function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
}

function Animate(elem, propName, duration, start, end)  {
    var start_time = new Date().getTime();
    var interval = setInterval(function() {
      var current_time = new Date().getTime(),
        remaining = Math.max(0, start_time + duration - current_time),
        temp = remaining / duration || 0,
        percent = 1 - temp;

      if (start_time + duration < current_time) clearInterval(interval);

      var pos = easeOutBounce(null, duration * percent, 0, 1, duration),
        current = (end - start) * pos + start;

      elem.style[propName] = current + 'px';
    }, 1);
  }

var elem = document.getElementById('contactform');
var opened = false; 

document.getElementById('contact-button').onclick = function() {
  if (opened) {
    Animate(elem, 'right', 800, 0, -405);    
    opened = false;
  } else {
    Animate(elem, 'right', 800, -405, -60);
    opened = true;  
  }  
}