import {Producer, Wine} from "@/app/wine/new/page";
import React from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";

interface Props {
    producer: Producer;
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer | null>>;
}

interface WineJson {
    id: number;
    name: string;
    producerId: number;
    wineType: WineTypeJson;
}

interface WineTypeJson {
    id: number;
    label: string;
}

const ProducerDetail = ({producer, setWines, setViewType, setSelectedProducer}: Props) => {
    const selectProducer = async () => {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/producer/${producer.id}/wines`);
        if (!response.ok) {
            throw new Error('Failed to get wines');
        }
        const winesResponse: WineJson[] = await response.json();
        // wineの型に整形して親のstateを更新
        const wine: Wine[] = winesResponse.map((wine: any) => {
            return {
                id: wine.id,
                name: wine.name,
                producer: producer,
                wineType: {
                    id: wine.wineType.id,
                    label: wine.wineType.label,
                }
            }
        });
        setWines(wine);
        setSelectedProducer(producer);
        setViewType(2);
    }
    return (
        <div className="border rounded shadow p-4 text-center" onClick={selectProducer}>
            <img
                src="/images/domaine.webp"
                alt="生産者画像"
                className="mx-auto mb-4"
            />
            <h3 className="text-lg font-semibold mb-2">{producer.name}</h3>
            <p className="text-sm text-gray-600">
                こちらは生産者の説明文です。生産者の特徴や背景を簡単に説明します。
            </p>
        </div>
    )
}

export default ProducerDetail;