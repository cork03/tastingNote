"use client"

import React from "react";
import GrayCard from "@/components/utils/view/grayCard";
import TextField from "@/components/utils/form/Vertical/textField";
import {WineCommentState} from "@/components/wine-comment/[id]/edit/EditComment";

interface Props {
    wineComment: WineCommentState
    setWineComment: React.Dispatch<React.SetStateAction<WineCommentState>>
}

const WineCommentPage = ({wineComment, setWineComment}: Props) => {
    const handleChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
        setWineComment({...wineComment, [e.target.name]: e.target.value});
    }
    return (
        <GrayCard>
            <div className="space-y-6">
                <TextField label={"色調・外観"} name={"appearance"} value={wineComment.appearance} onChange={handleChange} placeholder={"ガーネット色"}/>
                <TextField label={"香り"} name={"aroma"} value={wineComment.aroma} onChange={handleChange} placeholder={"黒系も赤系もある中庸な香り"}/>
                <TextField label={"味わい"} name={"taste"} value={wineComment.taste} onChange={handleChange} placeholder={"酸味が強く、タンニンは穏やか"}/>
                <TextField label={"その他コメント"} name={"anotherComment"} value={wineComment.anotherComment || ""} onChange={handleChange} placeholder={"新樽比率の高いピノノワールに似ている"}/>
            </div>
        </GrayCard>
    )
}

export default WineCommentPage;
