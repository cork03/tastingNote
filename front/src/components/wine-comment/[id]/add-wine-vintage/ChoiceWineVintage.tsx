"use client"

import ChoiceWine from "@/components/wine/new/wine/ChoiceWine";
import {useState} from "react";
import {Producer} from "@/types/domain/producer";
import {Wine} from "@/types/domain/wine";
import ChoiceProducer from "@/components/utils/domainView/producer/ChoiceProducer";

interface Props {
    wineCommentId: number;
    producers: Producer[];
}

export type ViewType = 1 | 2;


const ChoiceWineVintage = ({wineCommentId, producers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [selectedProducerId, setSelectedProducerId] = useState<number>(0);
    const [viewType, setViewType] = useState<ViewType>(1);
    return (
        <>
            {viewType === 1 &&
                <ChoiceProducer
                    wineCommentId={wineCommentId}
                    producers={producers}
                    setWines={setWines}
                    setViewType={setViewType}
                    setSelectedProducerId={setSelectedProducerId}
                />}
            {viewType === 2 &&
                <ChoiceWine
                    wineCommentId={wineCommentId}
                    wines={wines}
                    setViewType={setViewType}
                    selectedProducerId={selectedProducerId}
                />}
        </>
    )
}

export default ChoiceWineVintage;