import {WineComment as DomainWineComment} from "@/types/domain/blindTasting";

interface WineComment {
    wineVintageId: number;
    appearance: string;
    aroma: string;
    taste: string;
    anotherComment: string | null;
}

interface CreateWineCommentPost {
    wineComment: WineComment
}

interface CreateWineComment {
    wineComment: DomainWineComment
}

export const createWineComment = async ({wineComment}: CreateWineComment) => {
    if (!wineComment.wineVintageId) {
        throw new Error('wineVintageId is required');
    }
    const payload: CreateWineCommentPost = {
        wineComment: {
            wineVintageId: wineComment.wineVintageId,
            appearance: wineComment.appearance,
            aroma: wineComment.aroma,
            taste: wineComment.taste,
            anotherComment: wineComment.anotherComment
        },
    }
    const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/wine-comment`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(payload)
    });

    if (!response.ok) {
        throw new Error('Failed to create producer');
    }
}