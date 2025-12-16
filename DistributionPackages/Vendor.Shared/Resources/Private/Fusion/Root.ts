// type ComponentFn = (_el: HTMLElement) => any;

const scriptCache = new Map<string, Promise<boolean>>();

window.componentFn = {};

async function dynamicScript(src: string): Promise<boolean> {
	if (scriptCache.has(src)) return scriptCache.get(src)!;

	const promise = new Promise<boolean>((resolve) => {
		const script = document.createElement("script");

		script.src = src + "?cb=" + BUILD_DATE;
		script.type = "module";
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

async function loadComponent(packageName: string, componentName: string): Promise<any> {
	const scriptUrl = `/_Resources/Static/Packages/${packageName}/Build/JavaScript/components/${componentName}.js`;

	const script = await dynamicScript(scriptUrl);

	if (!script) {
		throw new Error(`Failed to load component: ${packageName}: ${componentName}`);
	}

	return script;
}

document.querySelectorAll("[data-esm]").forEach(async (el) => {
	if (el instanceof HTMLElement) {
		const { esm } = el.dataset;

		if (!esm) return;

		const [packageName, componentName] = esm.split(":");
		await loadComponent(packageName, componentName);

		const componentFn = window.componentFn[componentName];
		if (componentFn) {
			componentFn(el);
		}
	}
});
