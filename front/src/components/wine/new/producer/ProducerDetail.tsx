import React from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import GrayCard from "@/components/utils/view/grayCard";
import {Producer} from "@/types/domain/producer";
import ProducerCardTexts from "@/components/utils/domainView/producer/ProducerCardTexts";
import {Wine} from "@/types/domain/wine";
import {getWinesByProducerId} from "@/repository/serverActions/wineRepository";

interface Props {
    producer: Producer;
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducerId: React.Dispatch<React.SetStateAction<number>>;
}


const ProducerDetail = ({producer, setWines, setViewType, setSelectedProducerId}: Props) => {
    const selectProducer = async () => {
        if (!producer.id) {
            throw new Error("Producer id is not defined");
        }
        const wines = await getWinesByProducerId(producer.id);
        setWines(wines);
        setSelectedProducerId(producer.id);
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