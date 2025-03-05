'use server'
import {UpdateWineCommentBody} from "@/api/repository/types/wineComment";

export const updateWineComment = async (id: number, body: UpdateWineCommentBody) => {
    const response = await fetch(`${process.env.API_URL}/wine-comment/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    });
    if (!response.ok) {
        throw new Error('Failed to create wine');
    }
}