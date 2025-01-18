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
    wineType: WineType;
    country: Country;
}