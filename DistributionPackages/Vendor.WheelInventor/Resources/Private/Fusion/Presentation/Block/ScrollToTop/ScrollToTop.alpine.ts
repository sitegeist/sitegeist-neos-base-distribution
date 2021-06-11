function ScrollToTop() {
	return {
		button: {
			'x-on:scroll.window'() {
				this.visible = window.scrollY > 0;
			},

			'x-bind:class'() {
				return {
					'opacity-100': this.visible,
					'opacity-0 pointer-events-none': !this.visible
				};
			},

			'x-on:click'() {
				window.scroll({
					top: 0,
					behavior: 'smooth'
				});
			},
		} as any,
		visible: window.scrollY > 0
	};
}

Object.assign(window, {ScrollToTop});
