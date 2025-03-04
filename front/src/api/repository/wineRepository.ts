'use server'
import {UpdateWineBody} from "@/api/repository/types/wine";

export const updateWine = async (id: number, body: UpdateWineBody) => {
    const response = await fetch(`${process.env.API_URL}/wine/${id}`, {
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