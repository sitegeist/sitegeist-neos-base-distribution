import * as React from "react";
import { cn } from "../utils/classnames";

export type IconProps = {
	collectionName?: string;
	iconName: string;
	className?: string;
	style?: React.CSSProperties;
};

const Icon = ({ collectionName = "shared", iconName, className, style }: IconProps) => {
	const url = `/stampede/svgsprite?collection=${collectionName}#${iconName}`;

	return (
		<svg
			version="1.1"
			xmlns="http://www.w3.org/2000/svg"
			xmlnsXlink="http://www.w3.org/1999/xlink"
			className={cn("fill-current", className)}
			style={style}
			height={"1em"}
			width={"1em"}
		>
			<use xlinkHref={url} href={url} />
		</svg>
	);
};

export default Icon;
