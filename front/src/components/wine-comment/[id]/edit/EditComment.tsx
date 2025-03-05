"use client"

import React, {useState} from "react";
import Section from "@/components/utils/view/section";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {WineComment} from "@/api/queryService/types/wine";
import WineCommentPage from "@/components/wine-comment/[id]/edit/WineComment";
import {updateWineComment} from "@/api/repository/wineCommentRepository";
import {redirect} from "next/navigation";

interface Props {
    wineComment: WineComment
}

export interface WineCommentState {
    id: number
    wineVintageId: number
    appearance: string
    aroma: string
    taste: string
    anotherComment: string | null
}

const EditComment = ({wineComment}: Props) => {
    const [wineCommentState, setWineCommentState] = useState<WineCommentState>({
        id: wineComment.id,
        wineVintageId: wineComment.wineVintageId,
        appearance: wineComment.appearance,
        aroma: wineComment.aroma,
        taste: wineComment.taste,
        anotherComment: wineComment.anotherComment
    });
    const onSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            await updateWineComment(
                wineCommentState.id,
                {
                    wineVintageId: wineCommentState.wineVintageId,
                    appearance: wineCommentState.appearance,
                    aroma: wineCommentState.aroma,
                    taste: wineCommentState.taste,
                    anotherComment: wineCommentState.anotherComment
                }
            )
        } catch (e) {
            console.error(e)
        }
        redirect(`/wines`)
    }
    return (
        <Section>
            <form className="mx-auto space-y-8" onSubmit={onSubmit}>
                <WineCommentPage wineComment={wineCommentState} setWineComment={setWineCommentState}/>
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <NormalButton text={"更新"} type={"submit"}/>
                </div>
            </form>
        </Section>
    )
}

export default EditComment;