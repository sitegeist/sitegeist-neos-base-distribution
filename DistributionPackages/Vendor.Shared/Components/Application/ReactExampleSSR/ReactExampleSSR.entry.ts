import { createElement } from "react";
import { ExampleReactApp } from "../ReactExample/src";
import { hydrateRoot } from "react-dom/client";

export default (el: HTMLElement) => {
	const root = el.querySelector<HTMLElement>("[data-root]");

	if (!root) return;

	const data = root.dataset.appData;
	const appData = JSON.parse(data ?? "");
	const labels = JSON.parse(root.dataset.labels ?? "");

	delete root.dataset.appData;
	delete root.dataset.labels;

	hydrateRoot(root, createElement(ExampleReactApp, { ...appData, labels }));
};
