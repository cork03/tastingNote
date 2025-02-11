"use client"

import ChoiceWine from "@/components/common/createWineVintageRoute/ChoiceWine";
import {useState} from "react";
import {Producer} from "@/types/domain/producer";
import {Wine} from "@/types/domain/wine";
import ChoiceProducer from "@/components/common/createWineVintageRoute/ChoiceProducer";
import {ViewType} from "@/components/common/createWineVintageRoute/type";
import {default as ChoiceWineVintageComponent} from "@/components/common/createWineVintageRoute/ChoiceWineVintage";
import {redirect} from "next/navigation";

interface Props {
    prefix: string;
    producers: Producer[];
    commentId: number
}




const ChoiceWineVintage = ({prefix, producers, commentId}: Props) => {
    const [wines, setWines] = useState<Wine[]>([]);
    const [wineVintages, setWineVintages] = useState<Wine[]>([]);
    const [selectedProducerId, setSelectedProducerId] = useState<number>(0);
    const [selectedWineId, setSelectedWineId] = useState<number>(0);
    const [viewType, setViewType] = useState<ViewType>(1);
    const toCreateWine = () => {
        redirect(`/wine-comment/${commentId}/producer/${selectedProducerId}/wine/create`)
    }
    const clickHandleWineDetail = (wineId: number) => {
        setViewType(3);
        setSelectedWineId(wineId);
    }
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
                    wines={wines}
                    setViewType={setViewType}
                    toCreateWine={toCreateWine}
                    onClickWineDetail={clickHandleWineDetail}
                />}
            {viewType === 3 &&
                <ChoiceWineVintageComponent wineId={selectedWineId} setViewType={setViewType} commentId={commentId}/>
            }
        </>
    )
}

export default ChoiceWineVintage;