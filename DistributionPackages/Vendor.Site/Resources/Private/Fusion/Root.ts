interface GlobalDependencies {
	prototypeName: string;
	styles: {[key: string]: string};
}

type Component = (el: Element, dependencies: GlobalDependencies) => void;

type ComponentsDefinition = {
	[key: string]: {
		script: Component;
		prototypeName: string;
		styles: { [key: string]: string };
	};
};

export default function main(components: ComponentsDefinition) {
	function initializeComponent(el: Element, componentName: string): void {
		if (componentName in components) {
			const {script, prototypeName, styles} = components[componentName];

			script(el, {prototypeName, styles});
			return;
		}

		if (process.env.NODE_ENV === 'development') {
			console.error(el);
			console.error(componentName);

			throw new Error(`Component "${componentName}" was not found.`);
		}
	}

	Array.from(document.querySelectorAll('[data-component]')).forEach(el => {
		const componentName = el.getAttribute('data-component');

		if (typeof componentName !== 'string') {
			if (process.env.NODE_ENV === 'development') {
				console.error(el);
				console.error(componentName);
				throw new Error(
					`Expected string is componentName, got: ${typeof componentName}`
				);
			} else {
				return;
			}
		}

		if (!componentName) {
			if (process.env.NODE_ENV === 'development') {
				console.error(el);
				console.error(componentName);
				throw new Error(
					'Component name was empty.'
				);
			} else {
				return;
			}
		}

		componentName.split(' ').forEach(
			componentName => initializeComponent(el, componentName)
		);
	});
}
