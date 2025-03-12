export default ($node: HTMLElement): void => {
	const toggleButton = $node.querySelector("[data-toggle-submenu]") as HTMLElement | null;
	const submenu = $node.querySelector("[data-submenu]") as HTMLElement | null;

	if (!toggleButton || !submenu) return;

	toggleButton.addEventListener("click", () => {
		submenu.style.height = `${submenu.scrollHeight}px`;

		requestAnimationFrame(() => {
			$node.toggleAttribute("data-open");
		});
	});
};
