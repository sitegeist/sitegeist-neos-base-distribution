import React, { createContext, useContext, ReactNode } from "react";
import { AppDataType } from "../types";

type AppDataContextType = {
	appData: AppDataType;
};

const AppDataContext = createContext<AppDataContextType | undefined>(undefined);

export const useAppData = () => {
	const context = useContext(AppDataContext);
	if (!context)
		throw new Error(
			"[Application.ExampleReact]: useAppData must be used within AppDataProvider"
		);
	return context;
};

type AppDataProviderProps = {
	children: ReactNode;
	appData: AppDataType;
};

export const AppDataContextProvider = ({ children, appData }: AppDataProviderProps) => {
	return <AppDataContext.Provider value={{ appData }}>{children}</AppDataContext.Provider>;
};
