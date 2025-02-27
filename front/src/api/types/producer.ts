import {Country} from "@/api/types/country";

export interface Producer {
    id: number;
    name: string;
    country: Country;
    description: string;
    url: string | null;
}