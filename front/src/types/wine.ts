import {Producer} from "@/types/producer";

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

export interface WineVintage {
    id: number;
    wineId: number;
    vintage: number;
    price: number;
    agingMethod: string;
    alcoholContent: number;
    wineBlend: WineVariety[];
    technicalComment: string | null;
}

export interface WineFullInfo {
    id: number;
    name: string;
    producer: Producer;
    wineType: WineType;
    country: Country;
    wineVintages: WineVintage[];
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
}
