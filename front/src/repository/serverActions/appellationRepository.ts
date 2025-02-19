"use server"

import {redirect} from "next/navigation";
import {Appellation} from "@/types/domain/appellation";

interface CreateAppellationBody {
    name: string;
    appellationType: {
        id: number | null;
        name: string;
        countryId: number;
    };
    regulation: string;
}

export const createAppellation = async (appellation: Appellation) => {
    const body = {
        name: appellation.name,
        appellationType: {
            id: appellation.appellationType.id,
            name: appellation.appellationType.name,
            countryId: appellation.appellationType.country.id
        },
        regulation: appellation.regulation
    } as CreateAppellationBody;
    const response = await fetch(`${process.env.API_URL}/appellation`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to link wine vintage');
    }
}
