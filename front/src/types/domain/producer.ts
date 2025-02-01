import {Country} from "@/types/domain/country";

export interface Producer {
    id: number | null;
    name: string;
    country: Country;
    description: string;
    url: string | null;
}