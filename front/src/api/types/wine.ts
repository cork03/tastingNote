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

export interface WineType {
    id: number;
    name: string;
}