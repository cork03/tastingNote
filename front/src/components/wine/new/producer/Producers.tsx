"use client"

import React, {useState} from "react";
import {Producer, Wine} from "@/app/wine/new/page";
import ProducerDetail from "@/components/wine/new/producer/ProducerDetail";

type Props = {
    producers: Producer[];
    setWines: React.Dispatch<React.SetStateAction<Wine[]>>;
    setViewType: React.Dispatch<React.SetStateAction<number>>;
    setIsViewMode: React.Dispatch<React.SetStateAction<boolean>>
};

const Producers = ({producers, setWines, setViewType, setIsViewMode}: Props) => {
    const goToCreateProducer = () => {
        setIsViewMode(false);
    }
    return (
        <div>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="生産者を検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
                <button
                    type="submit"
                    className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    onClick={goToCreateProducer}
                >
                    新しい生産者を登録
                </button>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {producers.map((producer) => {
                    return <ProducerDetail key={producer.id} producer={producer} setWines={setWines}
                                           setViewType={setViewType}/>
                })}
            </div>
        </div>
    )
}

export default Producers;