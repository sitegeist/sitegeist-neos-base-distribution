import { z } from "zod";

export const appDataSchema = z.object({
	endpointBaseUri: z.string(),
});

export type AppDataType = z.infer<typeof appDataSchema>;

export type Labels = Record<string, string>;
