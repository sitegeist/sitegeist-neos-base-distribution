/// <reference types="vite/client" />

const components = import.meta.glob("../../Components/**/*.entry.ts");

async function mountComponent(el: HTMLElement): Promise<void> {
	const name = el.dataset.component;
	if (!name || (el as any).__mounted) return;

	const loader = Object.entries(components).find(([path]) =>
		path.endsWith(`/${name}.entry.ts`)
	)?.[1];
	if (!loader) return;

	(el as any).__mounted = true;

	let mod: any;
	try {
		mod = await loader();
	} catch (error) {
		// Allow a later mountComponents() run (e.g. Neos.NodeCreated) to retry the import
		(el as any).__mounted = false;
		console.error(`Failed to load component "${name}"`, error);
		return;
	}

	try {
		mod.default?.(el);
	} catch (error) {
		console.error(`Failed to mount component "${name}"`, error);
	}
}

// Each component is loaded and mounted independently, so one failing
// chunk or throwing component can't leave the rest of the page inert
async function mountComponents(root: ParentNode = document) {
	const nodes = root.querySelectorAll<HTMLElement>("[data-component]");
	await Promise.all(Array.from(nodes, mountComponent));
}

if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", () => {
		mountComponents();
	});
} else {
	mountComponents();
}

document.addEventListener("Neos.NodeCreated", () => {
	mountComponents();
});
