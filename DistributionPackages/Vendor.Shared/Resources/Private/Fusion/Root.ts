type ComponentFn = (_el: HTMLElement) => any;

const scriptCache = new Map<string, Promise<boolean>>();

async function dynamicScript(src: string): Promise<boolean> {
	if (!scriptCache.has(src)) {
		const promise = new Promise<boolean>(resolve => {
			const script = document.createElement("script");

			script.src = src;
			script.type = "text/javascript";
			script.async = true;

			document.head.appendChild(script);

			script.onload = () => {
				resolve(true);
				document.head.removeChild(script);
			};

			script.onerror = () => {
				console.error(`Dynamic Script Error: ${src}`);
				resolve(false);
				document.head.removeChild(script);
			};
		});

		scriptCache.set(src, promise);

		return promise;
	}

	return scriptCache.get(src) ?? false;
}

async function loadComponent(identifier: string): Promise<null | ComponentFn> {
	const [packageName, componentName] = identifier.split(":");
	const src = `/_Resources/Static/Packages/${packageName}/Build/JavaScript/components.js`;

	if (await dynamicScript(src)) {
		/* eslint-disable */
		// @ts-expect-error
		await ((__webpack_init_sharing__ as any)('default') as Promise<any>);
		const container = window[packageName.replace(/\./g, '_') as any] as any;

		// @ts-expect-error
		await container.init((__webpack_share_scopes__ as any).default);
		const factory = await container.get(`components/${componentName}`);

		const {default: componentFn} = factory();
		return componentFn;
		/* eslint-enable */
	}

	return null;
}

document.querySelectorAll("[data-esm]").forEach(async el => {
	if (el instanceof HTMLElement) {
		const {esm} = el.dataset;

		if (esm) {
			const componentFn = await loadComponent(esm);
			if (componentFn) {
				componentFn(el);
			}
		}
	}
});
