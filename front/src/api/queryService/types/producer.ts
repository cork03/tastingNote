import {Country} from "@/api/queryService/types/country";
import {Appellation} from "@/api/queryService/types/appellation";
import {WineType} from "@/api/queryService/types/wine";

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