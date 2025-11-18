export default ($node: HTMLElement): void => {
	if (!($node instanceof HTMLElement)) return;

	const menuButton = $node.querySelector("[data-menu-button]") as HTMLElement | null;
	const offcanvasMenu = $node.querySelector("[data-offcanvas-menu]") as HTMLElement | null;

	if (!menuButton || !offcanvasMenu) return;

	const backdrop = document.createElement("div");
	backdrop.className = "backdrop";

	backdrop.addEventListener("click", (event) => {
		if (event.target === backdrop) {
			closeMenu();
		}
	});

	const onKeyDown = (event: KeyboardEvent) => {
		if (event.key === "Escape") {
			closeMenu();
			menuButton.focus();
		}
	};

	const openMenu = () => {
		$node.setAttribute("data-open", "true");
		document.body.classList.add("overflow-hidden");
		$node.appendChild(backdrop);

		backdrop.classList.remove("animate-fade-out");

		document.addEventListener("keydown", onKeyDown);
	};

	const closeMenu = () => {
		$node.removeAttribute("data-open");
		document.body.classList.remove("overflow-hidden");

		backdrop.classList.add("animate-fade-out");

		backdrop.addEventListener("animationend", () => {
			backdrop.remove();
		}, { once: true });

		document.removeEventListener("keydown", onKeyDown);
	};

	const toggleMenu = () => {
		$node.hasAttribute("data-open") ? closeMenu() : openMenu();
	};

	menuButton.addEventListener("click", toggleMenu);

	const onScroll = () => {
		$node.toggleAttribute("data-scrolled", window.scrollY > 50);
		console.log("scroll");
	};

	document.addEventListener("scroll", onScroll);
};
