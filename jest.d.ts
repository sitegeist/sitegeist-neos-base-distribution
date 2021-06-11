declare function createFusionComponentUri(
	prototypeName: string,
	options?: {
		propSet?: string;
		sitePackageKey?: string;
		locales?: string;
		props?: Record<string, any>;
	}
): string;

declare function renderComponent(
	prototypeName: string,
	options?: {
		propSet?: string;
		sitePackageKey?: string;
		locales?: string;
		props?: Record<string, any>;
	},
	previewName?: string,
): Promise<HTMLElement>;

declare namespace jest {
	interface Matchers<R> {
		toContainVisibleElement: (selector: string) => Promise<R>;
	}
}
