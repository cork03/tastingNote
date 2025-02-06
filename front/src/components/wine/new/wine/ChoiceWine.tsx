"use client"

import React from "react";
import Wines from "@/components/wine/new/wine/Wines";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";
import Section from "@/components/utils/view/section";
import Title from "@/components/utils/view/title";
import {redirect} from "next/navigation";
import NormalButton from "@/components/utils/view/button/NormalButton";

interface Props {
    wines: Wine[]
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    selectedProducer: Producer;
}

const ChoiceWine = ({wines, setViewType, selectedProducer}: Props) => {
    return (
        <>
            <Title title={"ワイン"}/>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="ワインを検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
                <NormalButton text={"新しいワインを登録"} type="submit" onClick={() => {
                    redirect(`/producer/${selectedProducer.id}/wine/create`)
                }}
                />
            </div>
            <Section>
                <Wines wines={wines} setViewType={setViewType}/>
            </Section>
        </>
    )
}

export default ChoiceWine;