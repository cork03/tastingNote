"use server"
import {ProducerWine} from "@/types/domain/wine";
import {redirect} from "next/navigation";

interface WineCreateBody {
    "producerId": number,
    "name": string,
    "countryId": number,
    "wineTypeId": number,
    "appellationId": number | null
}

export const createWine = async (wine: ProducerWine, prefix: string) => {
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
