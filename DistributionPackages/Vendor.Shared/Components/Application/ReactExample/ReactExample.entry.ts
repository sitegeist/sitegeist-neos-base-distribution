import { createElement } from "react";
import { createRoot } from "react-dom/client";
import { ExampleReactApp } from "./src";
import "@shoelace-style/shoelace/dist/components/drawer/drawer.js";

export default (el: HTMLElement) => {
	const root = el.querySelector<HTMLElement>("[data-root]");

	if (!root) return;

	const data = root.dataset.appData;
	const appData = JSON.parse(data ?? "");
	const labels = JSON.parse(root.dataset.labels ?? "");

	delete root.dataset.appData;
	delete root.dataset.labels;

	createRoot(root).render(createElement(ExampleReactApp, { ...appData, labels }));
};
