import {Country} from "@/types/domain/country";

export interface AppellationType {
    id: number | null;
    name: string;
    country: Country
}

export interface Appellation {
    id: number | null;
    name: string;
    appellationType: AppellationType;
    regulation: string;
}
