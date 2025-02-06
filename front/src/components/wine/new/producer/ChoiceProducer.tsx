"use client"

import React from "react";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import {redirect} from "next/navigation";
import NormalButton from "@/components/utils/view/button/NormalButton";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";
import Grid from "@/components/utils/view/grid";
import {Producer} from "@/types/domain/producer";

interface Props {
    producers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducerId: React.Dispatch<React.SetStateAction<number>>;
}

const ChoiceProducer = ({producers, setWines, setViewType, setSelectedProducerId}: Props) => {
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
                    {producers.map((producer) => {
                        return <ProducerDetail key={producer.id} producer={producer} setWines={setWines}
                                               setViewType={setViewType} setSelectedProducerId={setSelectedProducerId}/>
                    })}
                </Grid>
            </Section>
        </>
    )
}

export default ChoiceProducer;