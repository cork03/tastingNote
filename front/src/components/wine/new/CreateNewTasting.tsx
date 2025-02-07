"use client"

import ChoiceProducer from "@/components/common/createWineVintageRoute/ChoiceProducer";
import ChoiceWine from "@/components/common/createWineVintageRoute/ChoiceWine";
import {useState} from "react";
import {Producer} from "@/types/domain/producer";
import {Wine} from "@/types/domain/wine";
import {ViewType} from "@/components/common/createWineVintageRoute/type";

interface Props {
    producers: Producer[];
}

const CreateNewTasting = ({producers}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [selectedProducerId, setSelectedProducerId] = useState<number>(0);
    const [viewType, setViewType] = useState<ViewType>(1);
    return (
        <>
            {viewType === 1 &&
                <ChoiceProducer
                    prefix={""}
                    producers={producers}
                    setWines={setWines}
                    setViewType={setViewType}
                    setSelectedProducerId={setSelectedProducerId}
                />}
            {viewType === 2 &&
                <ChoiceWine
                    prefix={""}
                    wines={wines}
                    setViewType={setViewType}
                    selectedProducerId={selectedProducerId}
                />}
        </>
    )
}

export default CreateNewTasting;