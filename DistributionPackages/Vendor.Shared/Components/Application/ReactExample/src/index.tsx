import React, { StrictMode, useRef } from "react";
import { appDataSchema, AppDataType, Labels } from "./types";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { AppDataContextProvider } from "./context/appContext";
import { I18nProvider } from "./context/useI18n";
import { ZodError } from "zod";
import { cn } from "../../utils/classnames";
import { ShoelaceElement } from "../../types/global";

const queryClient = new QueryClient();

type ExampleReactAppProps = AppDataType & {
	labels: Labels;
};

export const ExampleReactApp = ({ labels, ...rest }: ExampleReactAppProps) => {
	try {
		appDataSchema.parse(rest);

		return (
			<StrictMode>
				<QueryClientProvider client={queryClient}>
					<AppDataContextProvider appData={rest}>
						<I18nProvider labels={labels}>
							<ExampleReact />
						</I18nProvider>
					</AppDataContextProvider>
				</QueryClientProvider>
			</StrictMode>
		);
	} catch (error) {
		if (error instanceof ZodError) {
			console.error(error);
			return (
				<pre>
					<code>{JSON.stringify(error, null, 4)}</code>
				</pre>
			);
		} else {
			console.error("Unexpected error:", error);
		}
	}
};

const ExampleReact = () => {
	const drawerRef = useRef<ShoelaceElement>(null);

	const openDrawer = () => {
		drawerRef.current?.show?.();
	};

	return (
		<div
			className={cn(
				"flex border border-dashed border-brand relative",
				"bg-gray-50 rounded-xl p-24 overflow-hidden"
			)}
		>
			<div className="h-full flex flex-col gap-24 justify-between body-medium w-full">
				<span className="head-hl6">Example React Application</span>
				<div className="bg-gray-200 rounded-xl w-full h-128"></div>
				<div className="bg-gray-200 rounded-xl w-full h-64 -mt-12"></div>
				<button
					onClick={openDrawer}
					className="w-fit border border-brand hover:border-highlight hover:text-highlight py-8 px-24 cursor-pointer"
				>
					Open Drawer
				</button>
			</div>

			<sl-drawer
				ref={drawerRef}
				label="Contained Drawer"
				contained
				className="drawer-contained not-[&:defined]:hidden"
			>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			</sl-drawer>
		</div>
	);
};
