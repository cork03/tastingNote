import React from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import GrayCard from "@/components/utils/view/grayCard";
import {Producer} from "@/types/domain/producer";
import ProducerCardTexts from "@/components/utils/domainView/producer/ProducerCardTexts";

interface Props {
    producer: Producer;
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducerId: React.Dispatch<React.SetStateAction<number>>;
}


const ProducerDetail = ({producer, setWines, setViewType, setSelectedProducerId}: Props) => {
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
                producerId: wine.producerId,
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
        setSelectedProducerId(winesResponse[0].producerId);
        setViewType(2);
    }
    return (
        <div className="text-center cursor-pointer" onClick={selectProducer}>
            <GrayCard>
                <ProducerCardTexts producer={producer}/>
            </GrayCard>
        </div>
    )
}

export default ProducerDetail;