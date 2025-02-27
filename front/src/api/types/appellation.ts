import {Country} from "@/api/types/country";

export interface Appellation {
    id: number;
    name: string;
    regulation: string;
    appellationType: AppellationType;
}

export interface AppellationType {
    id: number;
    name: string;
    country: Country;
}