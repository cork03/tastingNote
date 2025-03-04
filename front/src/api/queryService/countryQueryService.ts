'use server'

import {Country} from "@/api/queryService/types/country";

export const getCountries = async (): Promise<Country[]> => {
    const data = await fetch(`${process.env.API_URL}/countries`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }
    return await data.json() as Country[];
}