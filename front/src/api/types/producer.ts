import {Country} from "@/api/types/country";
import {Appellation} from "@/api/types/appellation";
import {WineType} from "@/api/types/wine";

export interface Producer {
    id: number;
    name: string;
    country: Country;
    description: string;
    url: string | null;
}

export interface ProducerWine {
    id: number;
    name: string;
    producerId: number;
    wineType: WineType;
    country: Country;
    appellation: Appellation | null;
    imagePath: string | null;
}