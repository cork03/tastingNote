import {WineVariety} from "@/types/domain/wine";
import {Country} from "@/types/domain/country";

export interface BlindTastingAnswer {
    id: number | null;
    wineCommentId: number | null;
    country: Country;
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

export interface TastingComment {
    wineComment: WineComment;
    blindTastingAnswer: BlindTastingAnswer | null;
}