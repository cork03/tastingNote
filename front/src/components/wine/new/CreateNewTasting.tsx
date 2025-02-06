"use client"

import ChoiceProducer from "@/components/wine/new/producer/ChoiceProducer";
import ChoiceWine from "@/components/wine/new/wine/ChoiceWine";
import {useState} from "react";
import {Producer} from "@/types/domain/producer";
import {Wine} from "@/types/domain/wine";

interface Props {
    producers: Producer[];
}

export type ViewType = 1 | 2;


const CreateNewTasting = ({producers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [selectedProducerId, setSelectedProducerId] = useState<number>(0);
    const [viewType, setViewType] = useState<ViewType>(1);
    return (
        <>
            {viewType === 1 &&
                <ChoiceProducer
                    producers={producers}
                    setWines={setWines}
                    setViewType={setViewType}
                    setSelectedProducerId={setSelectedProducerId}
                />}
            {viewType === 2 &&
                <ChoiceWine
                    wines={wines}
                    setViewType={setViewType}
                    selectedProducerId={selectedProducerId}
                />}
        </>
    )
}

export default CreateNewTasting;