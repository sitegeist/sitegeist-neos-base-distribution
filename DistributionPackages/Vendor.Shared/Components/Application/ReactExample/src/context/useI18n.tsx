import React, { createContext, useContext, ReactNode } from "react";
import { Labels } from "../types";

type I18nContextType = {
	t: (key: string) => string;
};

const I18nContext = createContext<I18nContextType | undefined>(undefined);

type I18nProviderProps = {
	labels: Labels;
	children: ReactNode;
};

export const I18nProvider = ({ labels, children }: I18nProviderProps) => {
	const t = (key: string) => labels[key] ?? key;

	return <I18nContext.Provider value={{ t }}>{children}</I18nContext.Provider>;
};

export const useI18n = () => {
	const context = useContext(I18nContext);
	if (!context) {
		throw new Error("useI18n must be used within an I18nProvider");
	}
	return context.t;
};
