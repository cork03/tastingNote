import {Producer} from "@/api/queryService/types/producer";
import {Country} from "@/api/queryService/types/country";
import {Appellation} from "@/api/queryService/types/appellation";

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

export interface WineComment {
    id: number;
    wineVintageId: number;
    appearance: string;
    aroma: string;
    taste: string;
    anotherComment: string | null;
}