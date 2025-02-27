'use server'

import {ListWine} from "@/api/types/wine";

export const getWineList = async (): Promise<ListWine[]> => {
    const data = await fetch(`${process.env.API_URL}/wines`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }
    return await data.json();
}