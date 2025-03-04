"use client"

import React from "react";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import {redirect} from "next/navigation";
import NormalButton from "@/components/utils/view/button/NormalButton";
import ProducerDetail from "@/components/common/createWineVintageRoute/ProducerDetail";
import Grid from "@/components/utils/view/grid";
import {Producer} from "@/types/domain/producer";
import {ViewType} from "@/components/common/createWineVintageRoute/type";
import {ProducerWine} from "@/api/queryService/types/producer";

interface Props {
    prefix: string;
    producers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<ProducerWine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    setSelectedProducerId: React.Dispatch<React.SetStateAction<number>>;
}

const ChoiceProducer = ({prefix, producers, setWines, setViewType, setSelectedProducerId}: Props) => {
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
                    redirect(prefix + `/producer/create`)
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