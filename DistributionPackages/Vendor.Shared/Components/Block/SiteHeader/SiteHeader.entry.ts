import "@shoelace-style/shoelace/dist/components/drawer/drawer.js";
import "@shoelace-style/shoelace/dist/components/menu/menu.js";
import "@shoelace-style/shoelace/dist/components/menu-item/menu-item.js";
import "@shoelace-style/shoelace/dist/components/details/details.js";

export default (el: HTMLElement): void => {
	if (!(el instanceof HTMLElement)) return;

	const menuButton = el.querySelector("[data-menu-button]") as HTMLElement | null;
	const drawer = el.querySelector("sl-drawer") as any;

	if (menuButton && drawer) {
		const openMenu = () => {
			el.setAttribute("data-open", "true");
			drawer.show();
		};

		const closeMenu = () => {
			el.removeAttribute("data-open");
			drawer.hide();
		};

		menuButton.addEventListener("click", () => {
			el.hasAttribute("data-open") ? closeMenu() : openMenu();
		});

		drawer.addEventListener("sl-hide", (event: Event) => {
			if (event.target === drawer) {
				el.removeAttribute("data-open");
			}
		});
	}
};
