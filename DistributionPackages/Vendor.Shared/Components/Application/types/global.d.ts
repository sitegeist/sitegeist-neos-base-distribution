export type ShoelaceElement<T extends HTMLElement = HTMLElement> = T & {
	show?: () => void;
	hide?: () => void;
};

declare module "react/jsx-runtime" {
	namespace JSX {
		interface IntrinsicElements extends React.JSX.IntrinsicElements {
			"sl-drawer": React.DetailedHTMLProps<React.HTMLAttributes<HTMLElement>, HTMLElement> & {
				label: string;
				contained: boolean;
				show?: () => void;
				hide?: () => void;
			};
		}
	}
}

declare global {
	interface Document {
		addEventListener(
			type: 'Neos.NodeSelected' | 'Neos.NodeRemoved' | 'Neos.NodeCreated',
			listener: (event: NeosUiNodeEvent) => void
		): void
	}
}

interface NeosUiNodeEvent extends Event {
	detail: {
		element: HTMLElement
	}
}