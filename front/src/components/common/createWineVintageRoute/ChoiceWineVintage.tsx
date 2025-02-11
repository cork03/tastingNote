"use client"

import React from "react";
import Wines from "@/components/common/createWineVintageRoute/Wines";
import Section from "@/components/utils/view/section";
import Title from "@/components/utils/view/title";
import {redirect} from "next/navigation";
import NormalButton from "@/components/utils/view/button/NormalButton";
import {Wine, WineVintage} from "@/types/domain/wine";
import {ViewType} from "@/components/common/createWineVintageRoute/type";
import Grid from "@/components/utils/view/grid";
import WineVintageDetail from "@/components/utils/domainView/WineVintage/WineVintageDetail";
import {linkToWineVintage} from "@/repository/serverActions/wineCommentRepository";
import ButtonsDiv from "@/components/utils/view/button/ButtonsDiv";
import GrayButton from "@/components/utils/view/button/GrayButton";

interface Props {
    wineId: number
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
    commentId: number
    wineVintages: WineVintage[]
}

const ChoiceWineVintage = ({wineId, setViewType, commentId, wineVintages}: Props) => {

    return (
        <>
            <Title title={"ヴィンテージ"}/>
            <Section>
                <Grid>
                    {wineVintages.map((wineVintage) => {
                        const onClick = async () => {
                            if (!wineVintage.id) {
                                throw new Error("wineVintage.id is not defined");
                            }
                            await linkToWineVintage(commentId, wineVintage.id);
                            redirect(`/wine/${wineId}/vintage/${wineVintage.vintage}`);
                        }
                        return (
                            <WineVintageDetail key={wineVintage.id} wineVintage={wineVintage} onClick={onClick}/>
                        );
                    })}
                </Grid>
                <ButtonsDiv>
                    <NormalButton text={"新しいワインを登録"} onClick={() => {
                        redirect(`/wine-comment/${commentId}/wine/${wineId}/vintage/create`)
                    }}/>
                    <GrayButton text={"戻る"} onClick={() => {setViewType(2)}}/>
                </ButtonsDiv>
            </Section>
        </>
    )
}

export default ChoiceWineVintage;