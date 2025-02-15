"use server"

interface RegisterRankingBody {
    rank: number;
    wineVintageId: number;
    wineTypeId: number;
}

export const registerRanking = async (rank: number, wineVintageId: number) => {
    const body = {
        rank: rank,
        wineVintageId: wineVintageId,
        wineTypeId: 1
    } as RegisterRankingBody;
    const response = await fetch(`${process.env.API_URL}/wine-ranking`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to register ranking');
    }
    return await response.json();
}
