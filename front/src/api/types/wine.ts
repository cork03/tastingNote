import {Producer} from "@/api/types/producer";
import {Country} from "@/api/types/country";
import {Appellation} from "@/api/types/appellation";

export interface Wine {
    id: number;
    name: string;
    producer: Producer;
    wineType: WineType;
    country: Country;
    appellation: Appellation | null;
    imagePath: string | null;
}

export interface WineWithVintages {
    id: number;
    name: string;
    producerId: number;
    wineType: WineType;
    country: Country;
    wineVintages: WineVintage[];
    appellation: Appellation | null;
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
    imagePath: string | null;
}

export interface WineVariety {
    id: number;
    name: string;
    percentage: number;
}

export interface WineType {
    id: number;
    name: string;
}

export interface WineDetail {
    producer: Producer;
    wine: WineWithVintages;
}