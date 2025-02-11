"use server"

import {redirect} from "next/navigation";

interface LinkToWineVintageBody {
    wineVintageId: number
}

export const linkToWineVintage = async (wineCommentId: number, wineVintageId: number) => {
    console.log(wineVintageId);
    const body = {
        wineVintageId: wineVintageId
    } as LinkToWineVintageBody;
    const response = await fetch(`${process.env.API_URL}/wine-comment/${wineCommentId}/link-wine-vintage`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to link wine vintage');
    }
}
