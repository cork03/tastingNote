import {Producer} from "@/types/producer";
import {WineVintage} from "@/types/domain/wine";

export interface WineType {
    id: number;
    label: string;
}

export interface Country {
    id: number;
    name: string;
}

export interface Wine {
    id: number;
    name: string;
    producerId: number;
    wineType: WineType;
    country: Country;
}

export interface WineWithProducer {
    id: number;
    name: string;
    producer: Producer;
    wineType: WineType;
    country: Country;
}

export interface WineVariety {
    id: number;
    name: string;
    percentage: number;
}

export interface WineVintageFullInfo {
    id: number;
    producer: Producer;
    wine: Wine;
    vintage: number;
    price: number;
    agingMethod: string;
    alcoholContent: number;
    wineBlend: WineVariety[];
    technicalComment: string | null;
    imagePath: string | null;
}

export interface GrapeVariety {
    "id": number,
    "name": string
}

