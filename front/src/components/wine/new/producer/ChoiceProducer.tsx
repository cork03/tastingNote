"use client"

import React from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import {Producer} from "@/types/producer";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import {redirect} from "next/navigation";
import NormalButton from "@/components/utils/view/button/NormalButton";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import Grid from "@/components/utils/view/grid";

interface Props {
    initialProducers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducer: React.Dispatch<React.SetStateAction<Producer>>;
}

const ChoiceProducer = ({initialProducers, setWines, setViewType, setSelectedProducer}: Props) => {
    return (
        <>
            <Title title={"生産者"}/>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="生産者を検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
                <NormalButton text={"新しい生産者を登録"} onClick={() => {
                    redirect('/producer/create')
                }}
                />
            </div>
            <Section>
                <Grid>
                    {initialProducers.map((producer) => {
                        return <ProducerDetail key={producer.id} producer={producer} setWines={setWines}
                                               setViewType={setViewType} setSelectedProducer={setSelectedProducer}/>
                    })}
                </Grid>
            </Section>
        </>
    )
}

export default ChoiceProducer;