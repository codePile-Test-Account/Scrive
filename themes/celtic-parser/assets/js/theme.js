var snapper = new Snap({
	element: document.getElementById('content'),
	easing: 'ease'
});

var addEvent = function addEvent(element, eventName, func) {
	if (element.addEventListener) {
		return element.addEventListener(eventName, func, false);
	}
	else if (element.attachEvent) {
		return element.attachEvent("on" + eventName, func);
	}
};

addEvent(document.getElementById('open-right'), 'click', function() {
	snapper.open('right');
});

/* Prevent Safari opening links when viewing as a Mobile App */
(function(a, b, c) {
	if (c in b && b[c]) {
		var d, e = a.location,
			f = /^(a|html)$/i;
		a.addEventListener("click", function(a) {
			d = a.target;
			while (!f.test(d.nodeName)) d = d.parentNode;
			"href" in d && (d.href.indexOf("http") || ~d.href.indexOf(e.host)) && (a.preventDefault(), e.href = d.href);
		}, !1);
	}
})(document, window.navigator, "standalone");

var toggleMyRightMenu = document.getElementById('open-right');
var toggleMyLeftMenu = document.getElementById('open-left');

toggleMyRightMenu.addEventListener('click', function(){

	if( snapper.state().state=="right" ){
		snapper.close();
	} else {
		snapper.open('right');
	}

});

toggleMyLeftMenu.addEventListener('click', function(){

	if( snapper.state().state=="left" ){
		snapper.close();
	} else {
		snapper.open('left');
	}

});


/*
 * Social button click events
 */

/*
 * Gogle Analytics event listener for when the Contribute IDE Factory is launched
 */
var contributeFactory = document.getElementById('contribute-factory');
addListener(contributeFactory, 'click', function() {
  ga('send', 'event', 'button', 'click', 'contribute-ide-launched', {'nonInteraction': 1});
});

/**
 * Utility to wrap the different behaviors between W3C-compliant browsers
 * and IE when adding event handlers.
 *
 * @param {Object} element Object on which to attach the event listener.
 * @param {string} type A string representing the event type to listen for
 *     (e.g. load, click, etc.).
 * @param {function()} callback The function that receives the notification.
 */
function addListener(element, type, callback) {
 if (element.addEventListener) element.addEventListener(type, callback);
 else if (element.attachEvent) element.attachEvent('on' + type, callback);
}