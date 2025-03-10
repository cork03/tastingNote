import {Country} from "@/types/domain/country";
import {Producer} from "@/types/producer";
import {Appellation} from "@/types/domain/appellation";

export interface WineVariety {
    id: number;
    name: string;
    percentage: number;
}

export interface WineType {
    id: number;
    label: string;
}

export interface ProducerWine {
    id: number | null;
    name: string;
    producerId: number;
    country: Country;
    wineType: WineType;
    appellation: Appellation | null;
}

export interface WineVintage {
    id: number | null;
    wineId: number;
    vintage: number;
    price: number;
    agingMethod: string;
    alcoholContent: number;
    wineBlend: WineVariety[];
    technicalComment: string | null;
    imagePath: string | null;
}

export interface GrapeVariety {
    id: number,
    name: string
}

export interface WineFullInfo {
    id: number;
    name: string;
    producer: Producer;
    wineType: WineType;
    country: Country;
    wineVintages: WineVintage[];
}