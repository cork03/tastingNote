"use client"

import ChoiceWine from "@/components/common/createWineVintageRoute/ChoiceWine";
import {useState} from "react";
import {Producer} from "@/types/domain/producer";
import {Wine} from "@/types/domain/wine";
import ChoiceProducer from "@/components/common/createWineVintageRoute/ChoiceProducer";
import {ViewType} from "@/components/common/createWineVintageRoute/type";

interface Props {
    prefix: string;
    producers: Producer[];
}




const ChoiceWineVintage = ({prefix, producers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [selectedProducerId, setSelectedProducerId] = useState<number>(0);
    const [viewType, setViewType] = useState<ViewType>(1);
    return (
        <>
            {viewType === 1 &&
                <ChoiceProducer
                    prefix={prefix}
                    producers={producers}
                    setWines={setWines}
                    setViewType={setViewType}
                    setSelectedProducerId={setSelectedProducerId}
                />}
            {viewType === 2 &&
                <ChoiceWine
                    prefix={prefix}
                    wines={wines}
                    setViewType={setViewType}
                    selectedProducerId={selectedProducerId}
                />}
            {viewType === 3 &&
                <div>ChoiceWineVintage</div>}
        </>
    )
}

export default ChoiceWineVintage;