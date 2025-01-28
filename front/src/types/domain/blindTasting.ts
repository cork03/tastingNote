import {WineVariety} from "@/types/domain/wine";

export interface BlindTastingAnswer {
    id: number | null;
    wineCommentId: number | null;
    countryId: number;
    wineBlend: WineVariety[];
    vintage: number;
    price: string;
    alcoholContent: number;
    anotherComment: string | null;
}

export interface WineComment {
    id: number | null;
    wineVintageId: number | null;
    appearance: string;
    aroma: string;
    taste: string;
    anotherComment: string | null;
}