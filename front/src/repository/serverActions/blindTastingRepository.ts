"use server"
import {
    BlindTastingAnswer as DomainBlindTastingAnswer,
    WineComment as DomainWineComment
} from "@/types/domain/blindTasting";
import {redirect} from "next/navigation";

interface WineComment {
    appearance: string;
    aroma: string;
    taste: string;
    anotherComment: string | null;
}

interface BlindTastingAnswer {
    countryId: number;
    wineBlend: WineVariety[];
    vintage: number;
    price: string;
    alcoholContent: number;
    anotherComment: string | null;
}

interface WineVariety {
    grapeVarietyId: number;
    percentage: number;
}

interface CreateBlindTastingPost {
    wineComment: WineComment
    blindTastingAnswer: BlindTastingAnswer;
}

interface CreateBlindTasting {
    wineComment: DomainWineComment
    blindTastingAnswer: DomainBlindTastingAnswer;
}

export const createBlindTasting = async ({wineComment, blindTastingAnswer}: CreateBlindTasting) => {
    const wineVarieties: WineVariety[] = blindTastingAnswer.wineBlend.map((wineVariety) => {
        return {
            grapeVarietyId: wineVariety.id,
            percentage: wineVariety.percentage
        }
    });

    const payload: CreateBlindTastingPost = {
        wineComment: {
            appearance: wineComment.appearance,
            aroma: wineComment.aroma,
            taste: wineComment.taste,
            anotherComment: wineComment.anotherComment
        },
        blindTastingAnswer: {
            countryId: blindTastingAnswer.country.id,
            wineBlend: wineVarieties,
            vintage: blindTastingAnswer.vintage,
            price: blindTastingAnswer.price,
            alcoholContent: blindTastingAnswer.alcoholContent,
            anotherComment: blindTastingAnswer.anotherComment
        }
    }
    const response = await fetch(`${process.env.API_URL}/blind-tasting`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(payload)
    });

    if (!response.ok) {
        throw new Error('Failed to create producer');
    }
    const responseJson: { id: number } = await response.json();
    redirect(`/wine-comment/${responseJson.id}/add-wine-vintage`);
}