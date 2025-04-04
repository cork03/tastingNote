import {WineVintage} from "@/types/domain/wine";

interface WineVintagePostBody {
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

export async function postWineVintage(wineVintage: WineVintage, bae64Image: string | null) {
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
    } as WineVintagePostBody;
    const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/wine-vintage`, {
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

interface WineVintageUpdateBody {
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

export async function updateWineVintage(wineVintage: WineVintage, bae64Image: string | null) {
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
    } as WineVintageUpdateBody;
    const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/wine-vintage/${wineVintage.id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to update wine vintage');
    }
    return await response.json();
}