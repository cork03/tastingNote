'use server'

import {ProducerWine} from "@/api/queryService/types/producer";

export const getWines = async (id: number): Promise<ProducerWine[]> => {
    const data = await fetch(`${process.env.API_URL}/producer/${id}/wines`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }
    return await data.json();
}