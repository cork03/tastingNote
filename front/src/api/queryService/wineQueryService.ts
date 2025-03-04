'use server'

import {Wine, WineDetail, WineType} from "@/api/queryService/types/wine";

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

export const getWineTypes = async (): Promise<WineType[]> => {
    const data = await fetch(`${process.env.API_URL}/wine-types`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }

    return await data.json() as WineType[];
}