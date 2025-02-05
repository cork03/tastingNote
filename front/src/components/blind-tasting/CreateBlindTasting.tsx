"use client"

import React, {useState} from "react";
import {Country, GrapeVariety} from "@/types/wine";
import {BlindTastingAnswer, WineComment} from "@/types/domain/blindTasting";
import WineCommentPage from "@/components/blind-tasting/WineComment";
import BlindTastingAnswerPage from "@/components/blind-tasting/BlindTastingAnswer";
import {createBlindTasting} from "@/repository/blindTastingRepository";

interface Props {
    grapeVarieties: GrapeVariety[];
    countries: Country[]
}

const CrateBlindTasting = ({grapeVarieties, countries}: Props) => {
    const [wineComment, setWineComment] = useState<WineComment>({
        id: null,
        wineVintageId: null,
        appearance: "",
        aroma: "",
        taste: "",
        anotherComment: null
    });
    const [blindTastingAnswer, setBlindTastingAnswer] = useState<BlindTastingAnswer>({
        id: null,
        wineCommentId: null,
        country: {
            id: 0,
            name: ""
        },
        wineBlend: [{"id": 0, name: "", "percentage": 50}],
        vintage: 2020,
        price: "",
        alcoholContent: 0,
        anotherComment: null
    })
    return (
        <section className="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <form className="mx-auto space-y-8">
                <WineCommentPage wineComment={wineComment} setWineComment={setWineComment}/>
                <BlindTastingAnswerPage blindTastingAnswer={blindTastingAnswer}
                                        setBlindTastingAnswer={setBlindTastingAnswer} grapeVarieties={grapeVarieties}
                                        countries={countries}/>
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <button
                        type="button"
                        onClick={async () => {
                            await createBlindTasting({wineComment, blindTastingAnswer})
                        }}
                        className="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        回答
                    </button>
                </div>
            </form>
        </section>
    )
}

export default CrateBlindTasting;