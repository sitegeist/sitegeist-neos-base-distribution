import { createElement } from "react";
import { renderToString } from "react-dom/server";
import { ExampleReactApp } from "../ReactExample/src";

const appData = JSON.parse(process.argv[2]);
const labels = JSON.parse(process.argv[3]);

export function renderReactComponent() {
	const comp = createElement(ExampleReactApp, { ...appData, labels });
	return renderToString(comp);
}

console.log(renderReactComponent());
