"use client"

import React, {useState} from "react";
import {Country, GrapeVariety} from "@/types/wine";
import {BlindTastingAnswer, WineComment} from "@/types/domain/blindTasting";
import WineCommentPage from "@/components/blind-tasting/WineComment";
import BlindTastingAnswerPage from "@/components/blind-tasting/BlindTastingAnswer";
import {redirect} from "next/navigation";
import Section from "@/components/utils/view/section";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {createBlindTasting} from "@/repository/serverActions/blindTastingRepository";

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
        alcoholContent: 13,
        anotherComment: null
    })

    const onSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await createBlindTasting({wineComment, blindTastingAnswer});
        } catch (e) {
            console.error(e);
        }
    }
    return (
        <Section>
            <form className="mx-auto space-y-8" onSubmit={onSubmit}>
                <WineCommentPage wineComment={wineComment} setWineComment={setWineComment}/>
                <BlindTastingAnswerPage blindTastingAnswer={blindTastingAnswer}
                                        setBlindTastingAnswer={setBlindTastingAnswer} grapeVarieties={grapeVarieties}
                                        countries={countries}/>
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <NormalButton text={"回答"} type={"submit"}/>
                </div>
            </form>
        </Section>
    )
}

export default CrateBlindTasting;