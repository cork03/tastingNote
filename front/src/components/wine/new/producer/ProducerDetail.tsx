import React from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";
import GrayCard from "@/components/utils/view/grayCard";

interface Props {
    producer: Producer;
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer>>;
}


const ProducerDetail = ({producer, setWines, setViewType, setSelectedProducer}: Props) => {
    const selectProducer = async () => {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/producer/${producer.id}/wines`);
        if (!response.ok) {
            throw new Error('Failed to get wines');
        }
        const winesResponse: Wine[] = await response.json();
        // wineの型に整形して親のstateを更新
        const wine: Wine[] = winesResponse.map((wine: Wine) => {
            return {
                id: wine.id,
                name: wine.name,
                producerId: producer.id,
                wineType: {
                    id: wine.wineType.id,
                    label: wine.wineType.label,
                },
                country: {
                    id: wine.country.id,
                    name: wine.country.name,
                }
            }
        });
        setWines(wine);
        setSelectedProducer(producer);
        setViewType(2);
    }
    return (
        <div className="text-center" onClick={selectProducer}>
            <GrayCard>
                <h3 className="text-lg font-semibold mb-2">{producer.name}</h3>
                <p className="text-sm text-gray-600">
                    こちらは生産者の説明文です。生産者の特徴や背景を簡単に説明します。
                </p>
            </GrayCard>
        </div>
    )
}

export default ProducerDetail;