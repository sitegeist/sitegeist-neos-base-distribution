declare var process: NodeJS.Process;

declare namespace NodeJS {
    export interface Process {
        env: ProcessEnv;
    }

    export interface ProcessEnv {
        [key: string]: string | undefined;
    }
}