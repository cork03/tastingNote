"use server"
import {Wine} from "@/types/domain/wine";
import {redirect} from "next/navigation";

interface WineCreateBody {
    "wine": {
        "producerId": number,
        "name": string,
        "countryId": number,
        "wineTypeId": number
    }
}

export const createWine = async (wine: Wine) => {
    const body: WineCreateBody = {
        "wine": {
            "producerId": wine.producerId,
            "name": wine.name,
            "countryId": wine.country.id,
            "wineTypeId": wine.wineType.id
        }
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
    const responseJson: {id: number} = await response.json();

    redirect(`/wine/${responseJson.id}/vintage/create`);
}