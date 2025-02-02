import {Producer} from "@/types/domain/producer";
import {Country} from "@/types/domain/country";

export interface WineVariety {
    grapeVarietyId: number;
    name: string;
    percentage: number;
}

export interface WineType {
    id: number;
    label: string;
}

export interface Wine {
    id: number | null;
    name: string;
    producerId: number;
    country: Country;
    wineType: WineType;
}