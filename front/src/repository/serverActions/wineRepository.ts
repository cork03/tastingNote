"use server"
import {Wine} from "@/types/domain/wine";
import {redirect} from "next/navigation";

interface WineCreateBody {
    "producerId": number,
    "name": string,
    "countryId": number,
    "wineTypeId": number,
    "appellationId": number | null
}

export const createWine = async (wine: Wine, prefix: string) => {
    const body: WineCreateBody = {
        "producerId": wine.producerId,
        "name": wine.name,
        "countryId": wine.country.id,
        "wineTypeId": wine.wineType.id,
        "appellationId": wine.appellation?.id ?? null
    }
    const response = await fetch(`${process.env.API_URL}/wine`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to create wine');
    }
    const responseJson: { id: number } = await response.json();

    redirect(`${prefix}/wine/${responseJson.id}/vintage/create`);
}

export const getWinesByProducerId = async (producerId: number): Promise<Wine[]> => {
    const response = await fetch(`${process.env.API_URL}/producer/${producerId}/wines`);
    if (!response.ok) {
        throw new Error('Failed to get wines');
    }
    const winesResponse: Wine[] = await response.json();
    // wineの型に整形して親のstateを更新
    return winesResponse.map((wine: Wine) => {
        return {
            id: wine.id,
            name: wine.name,
            producerId: wine.producerId,
            wineType: {
                id: wine.wineType.id,
                label: wine.wineType.label,
            },
            country: {
                id: wine.country.id,
                name: wine.country.name,
            },
            appellation: null
        }
    });
}
