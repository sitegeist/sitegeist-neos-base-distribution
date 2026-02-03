/// <reference types="vite/client" />

const components = import.meta.glob("../../Components/**/*.ts");

async function mountComponents(root: ParentNode = document) {
	const nodes = root.querySelectorAll<HTMLElement>("[data-component]");

	for (const el of nodes) {
		const name = el.dataset.component;
		if (!name) continue;

		const loader = Object.entries(components).find(([path]) =>
			path.endsWith(`/${name}.ts`)
		)?.[1];

		if (!loader) {
			console.warn(`[components] Not found: ${name}`);
			continue;
		}

		if ((el as any).__mounted) continue;
		(el as any).__mounted = true;

		const mod: any = (await loader());
		mod.default?.(el);
	}
}

document.addEventListener("DOMContentLoaded", () => {
	mountComponents();
});
