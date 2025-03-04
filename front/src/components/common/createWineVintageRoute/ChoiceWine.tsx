"use client"

import React from "react";
import Wines from "@/components/common/createWineVintageRoute/Wines";
import Section from "@/components/utils/view/section";
import Title from "@/components/utils/view/title";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {ViewType} from "@/components/common/createWineVintageRoute/type";
import {ProducerWine} from "@/api/queryService/types/producer";

interface Props {
    wines: ProducerWine[]
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    toCreateWine: () => void
    onClickWineDetail: (wineId: number) => void
}

const ChoiceWine = ({wines, setViewType, toCreateWine, onClickWineDetail}: Props) => {
    return (
        <>
            <Title title={"ワイン"}/>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="ワインを検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
                <NormalButton text={"新しいワインを登録"} onClick={toCreateWine}/>
            </div>
            <Section>
                <Wines wines={wines} setViewType={setViewType} onClickWineDetail={onClickWineDetail}/>
            </Section>
        </>
    )
}

export default ChoiceWine;