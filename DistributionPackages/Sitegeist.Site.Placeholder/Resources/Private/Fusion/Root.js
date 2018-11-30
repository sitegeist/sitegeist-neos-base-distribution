export default function main(components) {
	function initializeComponent(el, componentName) {
		if (componentName in components) {
			const {script, prototypeName, styles} = components[componentName];

			return script(el, {prototypeName, styles});
		}

		if (process.env.NODE_ENV === 'development') {
			console.warn(`Component "${componentName}" was not found.`);
		}
	}

	Array.from(document.querySelectorAll('[data-component]')).forEach(el => {
		el.dataset.component.split(' ').forEach(
			componentName => initializeComponent(el, componentName)
		);
	});
}
