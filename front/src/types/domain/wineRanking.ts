import {Wine, WineVintage} from "@/types/domain/wine";

export interface WineRanking {
    id: number | null;
    rank: number;
    wineType: WineVintage;
}

export interface WineRankingFullInfo {
    wineRanking: WineRanking;
    wineVintage: WineVintage;
    wine: Wine;
}