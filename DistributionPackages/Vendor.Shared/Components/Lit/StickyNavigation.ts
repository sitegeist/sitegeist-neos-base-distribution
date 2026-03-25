import { LitElement, css, html } from "lit";
import { customElement } from "lit/decorators.js";

const HEADER_OFFSET = 80;
const SECTION_SWITCH_OFFSET = 10;

type StickyNavigationItem = {
	href: string;
	link: HTMLAnchorElement;
	target: HTMLElement;
};

@customElement("sticky-navigation")
export class StickyNavigation extends LitElement {
	static styles = css`
		.items {
			display: flex;
			overflow-x: auto;
			scrollbar-width: none;
			-ms-overflow-style: none;
			gap: var(--anchor-navigation-gap);
		}

		.items::-webkit-scrollbar {
			display: none;
		}
	`;

	private items: StickyNavigationItem[] = [];
	private activeHref: string | null = null;
	private scrollListenerEnabled = true;
	private reenableScrollTimeout: number | null = null;
	private programmaticScrollListener: (() => void) | null = null;

	override connectedCallback(): void {
		super.connectedCallback();
		if ("neos" in window) {
			return;
		}

		window.addEventListener("hashchange", this.handleHashChange);
		window.addEventListener("scroll", this.handleWindowScroll, { passive: true });
		window.addEventListener("resize", this.handleResize);
	}

	override firstUpdated(): void {
		this.refreshItems();
	}

	override disconnectedCallback(): void {
		window.removeEventListener("hashchange", this.handleHashChange);
		window.removeEventListener("scroll", this.handleWindowScroll);
		window.removeEventListener("resize", this.handleResize);
		this.teardownListeners();
		super.disconnectedCallback();
	}

	private get slotElement(): HTMLSlotElement | null {
		return this.renderRoot.querySelector("slot");
	}

	private get scrollContainer(): HTMLElement | null {
		return this.renderRoot.querySelector<HTMLElement>(".items");
	}

	private readonly handleHashChange = (): void => {
		this.syncActiveHref();
		this.scrollActiveItemIntoView();
	};

	private readonly handleWindowScroll = (): void => {
		if (!this.scrollListenerEnabled) {
			return;
		}

		const currentItem = this.getCurrentItem();
		if (currentItem) {
			this.activateItem(currentItem);
		}
	};

	private readonly handleResize = (): void => {
		this.handleWindowScroll();
		const activeItem = this.items.find((item) => item.href === this.activeHref);
		if (activeItem) {
			this.centerItem(activeItem.link);
		}
	};

	private handleSlotChange = (): void => {
		this.refreshItems();
	};

	private refreshItems(): void {
		const slot = this.slotElement;
		if (!slot) {
			return;
		}

		const links = slot
			.assignedElements({ flatten: true })
			.filter((element): element is HTMLAnchorElement => element instanceof HTMLAnchorElement);

		this.teardownListeners();
		this.items = links
			.map((link) => {
				const href = link.getAttribute("href");
				if (!href || !href.startsWith("#")) {
					return null;
				}

				const identifier = decodeURIComponent(href.slice(1));
				const target = document.getElementById(identifier);
				if (!target) {
					return null;
				}

				return {
					href,
					link,
					target,
				};
			})
			.filter((item): item is StickyNavigationItem => item !== null);

		this.attachListeners();
		this.syncActiveHref();
		this.handleWindowScroll();
		this.scrollActiveItemIntoView();
	}

	private attachListeners(): void {
		for (const item of this.items) {
			item.link.addEventListener("click", this.handleLinkClick);
		}
	}

	private teardownListeners(): void {
		for (const item of this.items) {
			item.link.removeEventListener("click", this.handleLinkClick);
		}

		if (this.programmaticScrollListener) {
			window.removeEventListener("scroll", this.programmaticScrollListener);
			this.programmaticScrollListener = null;
		}

		if (this.reenableScrollTimeout !== null) {
			window.clearTimeout(this.reenableScrollTimeout);
			this.reenableScrollTimeout = null;
		}
	}

	private syncActiveHref(): void {
		const hash = window.location.hash;
		this.activeHref =
			(hash && this.items.some((item) => item.href === hash) ? hash : this.items[0]?.href) ?? null;

		this.updateActiveClasses();
	}

	private updateActiveClasses(): void {
		for (const item of this.items) {
			const isActive = item.href === this.activeHref;
			item.link.dataset.active = String(isActive);
			item.link.classList.toggle("text-highlight", isActive);
			item.link.classList.toggle("hover:text-highlight", !isActive);
		}
	}

	private get navigationOffset(): number {
		return Math.max(this.getBoundingClientRect().height, HEADER_OFFSET);
	}

	private get sectionActivationOffset(): number {
		const scrollMarginTop =
			Number.parseFloat(
				this.items[0] ? window.getComputedStyle(this.items[0].target).scrollMarginTop : "",
			) || 0;

		return Math.max(this.navigationOffset, scrollMarginTop) + SECTION_SWITCH_OFFSET;
	}

	private getCurrentItem(): StickyNavigationItem | null {
		const offset = this.sectionActivationOffset;

		for (let index = this.items.length - 1; index >= 0; index -= 1) {
			const item = this.items[index];
			if (item.target.getBoundingClientRect().top <= offset) {
				return item;
			}
		}

		return this.items[0] ?? null;
	}

	private activateItem(item: StickyNavigationItem): void {
		if (this.activeHref === item.href) {
			return;
		}

		this.activeHref = item.href;
		this.updateActiveClasses();
		this.scrollActiveItemIntoView();
	}

	private centerItem(link: HTMLAnchorElement): void {
		const scrollContainer = this.scrollContainer;
		if (!scrollContainer) {
			return;
		}

		if (scrollContainer.scrollWidth <= scrollContainer.clientWidth) {
			return;
		}

		const containerRect = scrollContainer.getBoundingClientRect();
		const anchorRect = link.getBoundingClientRect();
		const centerOffset =
			anchorRect.left - containerRect.left - containerRect.width / 2 + anchorRect.width / 2;

		scrollContainer.scrollTo({
			left: scrollContainer.scrollLeft + centerOffset,
			behavior: "smooth",
		});
	}

	private readonly handleLinkClick = (event: Event): void => {
		const link = event.currentTarget;
		if (!(link instanceof HTMLAnchorElement)) {
			return;
		}

		const item = this.items.find((entry) => entry.link === link);
		if (!item) {
			return;
		}

		event.preventDefault();
		this.scrollListenerEnabled = false;

		if (this.reenableScrollTimeout !== null) {
			window.clearTimeout(this.reenableScrollTimeout);
		}

		if (this.programmaticScrollListener) {
			window.removeEventListener("scroll", this.programmaticScrollListener);
		}

		window.history.replaceState(null, "", item.href);
		this.activateItem(item);

		item.target.scrollIntoView({
			behavior: "smooth",
			block: "start",
		});

		this.programmaticScrollListener = () => {
			const scrollMarginTop = Number.parseFloat(window.getComputedStyle(item.target).scrollMarginTop) || 0;
			const targetTop = item.target.getBoundingClientRect().top;
			if (Math.abs(targetTop - scrollMarginTop) > 4) {
				return;
			}

			this.scrollListenerEnabled = true;
			if (this.programmaticScrollListener) {
				window.removeEventListener("scroll", this.programmaticScrollListener);
				this.programmaticScrollListener = null;
			}
		};

		window.addEventListener("scroll", this.programmaticScrollListener, { passive: true });
		this.reenableScrollTimeout = window.setTimeout(() => {
			this.scrollListenerEnabled = true;

			if (this.programmaticScrollListener) {
				window.removeEventListener("scroll", this.programmaticScrollListener);
				this.programmaticScrollListener = null;
			}
		}, 1000);
	};

	private scrollActiveItemIntoView(): void {
		const activeItem = this.items.find((item) => item.href === this.activeHref)?.link;
		if (!activeItem) {
			return;
		}

		this.centerItem(activeItem);
	}

	render() {
		return html`
			<div class="items">
				<slot @slotchange=${this.handleSlotChange}></slot>
			</div>
		`;
	}
}
