"use client"

import React, {useState} from "react";
import {Country, GrapeVariety} from "@/types/wine";
import {BlindTastingAnswer, WineComment} from "@/types/domain/blindTasting";
import WineCommentPage from "@/components/blind_tasting/WineComment";
import BlindTastingAnswerPage from "@/components/blind_tasting/BlindTastingAnswer";
import {createBlindTasting} from "@/repository/blindTastingRepository";
import {createWineComment} from "@/repository/wineCommentRepository";
import {redirect} from "next/navigation";

interface Props {
    wineVintageId: number
    id: number
    vintage: number
}

const CreateCommentPage = ({wineVintageId, id, vintage}: Props) => {
    const [wineComment, setWineComment] = useState<WineComment>({
        id: null,
        wineVintageId: wineVintageId,
        appearance: "",
        aroma: "",
        taste: "",
        anotherComment: null
    });
    return (
        <section className="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <form className="mx-auto space-y-8">
                <WineCommentPage wineComment={wineComment} setWineComment={setWineComment}/>
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <button
                        type="button"
                        onClick={async () => {
                            await createWineComment({wineComment})
                            redirect(`/wine/${id}/vintage/${vintage}`)
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

export default CreateCommentPage;