"use client"

import ChoiceProducer from "@/components/common/createWineVintageRoute/ChoiceProducer";
import ChoiceWine from "@/components/common/createWineVintageRoute/ChoiceWine";
import {useState} from "react";
import {Producer} from "@/types/domain/producer";
import {ViewType} from "@/components/common/createWineVintageRoute/type";
import {redirect} from "next/navigation";
import {ProducerWine} from "@/api/queryService/types/producer";

interface Props {
    producers: Producer[];
}

const CreateNewTasting = ({producers}: Props) => {
    const [wines, setWines] = useState<ProducerWine[]>([]);
    const [selectedProducerId, setSelectedProducerId] = useState<number>(0);
    const [viewType, setViewType] = useState<ViewType>(1);
    const toCreateWine = () => {
        redirect(`/producer/${selectedProducerId}/wine/create`)
    }
    const onClickWineDetail = (wineId: number) => {
        redirect(`/wine/${wineId}/vintage/create`);
    }
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
                    wines={wines}
                    setViewType={setViewType}
                    toCreateWine={toCreateWine}
                    onClickWineDetail={onClickWineDetail}
                />}
        </>
    )
}

export default CreateNewTasting;