export default (el: HTMLElement): void => {
	const formWrapper = el.querySelector("[data-form-wrapper]") as HTMLElement | null;

	if (!formWrapper) {
		return;
	}

	const form = formWrapper.querySelector("form") as HTMLFormElement | null;
	if (form?.dataset.formMode === "async") {
		return;
	}

	const formFields = formWrapper.querySelectorAll("[data-form-field]") as NodeListOf<HTMLElement>;

	formFields.forEach((field) => {
		const fieldType = field.querySelector("[data-fieldtype]") as HTMLElement | null;
		const selector = fieldType?.dataset.fieldtype;
		const fieldInput = selector ? (field.querySelector(selector) as HTMLElement | null) : null;

		if (!fieldInput) {
			return;
		}

		fieldInput.addEventListener("focusout", () => {
			field.classList.add("showInvalid");
		});

		fieldInput.addEventListener("invalid", () => {
			field.classList.add("showInvalid");
		});
	});
};
