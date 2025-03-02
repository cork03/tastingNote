'use server'

import {Wine, WineDetail} from "@/api/types/wine";

export const getWineList = async (): Promise<Wine[]> => {
    const data = await fetch(`${process.env.API_URL}/wines`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }
    return await data.json() as Wine[];
}

export const getWineDetail = async (id: number): Promise<WineDetail> => {
    const data = await fetch(`${process.env.API_URL}/wine/${id}`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }
    return await data.json() as WineDetail;
}