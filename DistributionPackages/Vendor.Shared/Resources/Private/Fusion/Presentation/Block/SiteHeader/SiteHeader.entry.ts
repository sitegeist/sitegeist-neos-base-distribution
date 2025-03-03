export default ($node:HTMLElement): void => {
	if ($node instanceof HTMLElement) {
		const siteHeader = $node.hasAttribute("data-site-header") ? $node : $node.querySelector("[data-site-header]");
		const menuButton = $node.querySelector("[data-menu-button]");
		const offCanvasMenu = $node.querySelector("[data-off-canvas-menu]");

		if(!siteHeader || !menuButton || !offCanvasMenu) {
			return;
		}

		menuButton.addEventListener("click", () => {
			// siteHeader.classList.toggle("open");
			siteHeader.toggleAttribute("data-open");
		});
	}
};
