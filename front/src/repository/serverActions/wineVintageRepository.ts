"use server"
import {WineVintage} from "@/types/domain/wine";

interface CreateWineVintageAndLinkCommentBody {
    wineVintage: {
        wineId: number,
        vintage: number,
        price: number,
        agingMethod: string,
        alcoholContent: number,
        wineBlend: {
            grapeVarietyId: number,
            percentage: number
        }[],
        technicalComment: string | null,
        base64Image: string | null
    }
}

export async function createWineVintageAndLinkComment(wineVintage: WineVintage, bae64Image: string | null, commentId: number) {
    const body = {
        wineVintage: {
            wineId: wineVintage.wineId,
            vintage: wineVintage.vintage,
            price: wineVintage.price,
            agingMethod: wineVintage.agingMethod,
            alcoholContent: wineVintage.alcoholContent,
            wineBlend: wineVintage.wineBlend.map((wineVariety) => {
                return {
                    grapeVarietyId: wineVariety.id,
                    percentage: wineVariety.percentage
                }
            }),
            technicalComment: wineVintage.technicalComment,
            base64Image: bae64Image
        }
    } as CreateWineVintageAndLinkCommentBody;
    const response = await fetch(`${process.env.API_URL}/wine-comment/${commentId}/wine-vintage`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to create wine vintage');
    }
    return await response.json();
}

export async function getAllByWineId(wineId: number) {
    const response = await fetch(`${process.env.API_URL}/wine/${wineId}/wine-vintages`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    });
    if (!response.ok) {
        throw new Error('Failed to get wine vintages');
    }
    return await response.json() as WineVintage[];
}