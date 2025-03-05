"use client"

import React, {useState} from "react";
import {WineComment} from "@/types/domain/blindTasting";
import WineCommentPage from "@/components/blind-tasting/WineComment";
import {createWineComment} from "@/repository/wineCommentRepository";
import {redirect} from "next/navigation";
import Section from "@/components/utils/view/section";
import NormalButton from "@/components/utils/view/button/NormalButton";

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
    const onClick = async () => {
        await createWineComment({wineComment})
        redirect(`/wine/${id}/vintage/${vintage}`)
    }
    return (
        <Section>
            <form className="mx-auto space-y-8">
                <WineCommentPage wineComment={wineComment} setWineComment={setWineComment}/>
                <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
                    <NormalButton text={"作成"} onClick={onClick}/>
                </div>
            </form>
        </Section>
    )
}

export default CreateCommentPage;