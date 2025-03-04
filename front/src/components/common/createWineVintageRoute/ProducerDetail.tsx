import React from "react";
import GrayCard from "@/components/utils/view/grayCard";
import {Producer} from "@/types/domain/producer";
import ProducerCardTexts from "@/components/utils/domainView/producer/ProducerCardTexts";
import {ViewType} from "@/components/common/createWineVintageRoute/type";
import {getWines} from "@/api/queryService/producerQueryService";
import {ProducerWine} from "@/api/queryService/types/producer";

interface Props {
    producer: Producer;
    setWines: React.Dispatch<React.SetStateAction<ProducerWine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducerId: React.Dispatch<React.SetStateAction<number>>;
}


const ProducerDetail = ({producer, setWines, setViewType, setSelectedProducerId}: Props) => {
    const selectProducer = async () => {
        if (!producer.id) {
            throw new Error("Producer id is not defined");
        }
        const wines = await getWines(producer.id);
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