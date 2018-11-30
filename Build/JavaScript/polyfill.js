import 'promise-polyfill/src/polyfill';
import 'whatwg-fetch';
import 'url-polyfill';

Event.prototype.propagationPath = function () {
	const polyfill = function () {
		let element = this.target || null;
		const pathArr = [element];

		if (!element || !element.parentElement) {
			return [];
		}

		while (element.parentElement) {
			element = element.parentElement;
			pathArr.unshift(element);
		}

		return pathArr;
	}.bind(this);

	return this.path || (this.composedPath && this.composedPath()) || polyfill();
};

(function () {
	if (typeof window.CustomEvent === 'function') {
		return false;
	}

	function CustomEvent(event, params) {
		params = params || {bubbles: false, cancelable: false, detail: undefined};
		const evt = document.createEvent('CustomEvent');
		evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
		return evt;
	}

	CustomEvent.prototype = window.Event.prototype;

	window.CustomEvent = CustomEvent;
})();
