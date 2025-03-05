'use server'

import {WineComment} from "@/api/queryService/types/wine";

export const getCommentById = async (id: number): Promise<WineComment> => {
    console.log(id);
    const data = await fetch(`${process.env.API_URL}/wine-comment/${id}`);
    if (!data.ok) {
        throw new Error('Failed to get');
    }
    return await data.json() as WineComment;
}