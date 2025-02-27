import {Producer} from "@/api/types/producer";
import {Country} from "@/api/types/country";

export interface ListWine {
    id: number;
    name: string;
    producer: Producer;
    wineType: WineType;
    country: Country;
    imagePath: string | null;
}

export interface WineType {
    id: number;
    name: string;
}