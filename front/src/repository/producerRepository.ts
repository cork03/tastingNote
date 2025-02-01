import {Producer} from "@/types/domain/producer";

interface ProducerPostBody {
    "name": string,
    "countryId": number,
    "description": string,
    "url": string | null
}

export async function postProducer(producer: Producer) {
    const postBody: ProducerPostBody = {
        "name": producer.name,
        "countryId": producer.country.id,
        "description": producer.description,
        "url": producer.url
    }
    const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/producer`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(postBody)
    });
    if (!response.ok) {
        throw new Error('Failed to create producer');
    }
    return await response.json();
}