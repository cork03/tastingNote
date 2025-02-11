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
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <NormalButton text={"新しいワインを登録"} type="submit" onClick={() => {
                    redirect(`/wine-comment/${commentId}/wine/${wineId}/vintage/create`)
                }}
                />
            </div>
            <Section>
                <Grid>
                    {wineVintages.map((wineVintage) => {
                        const onClick = async () => {
                            console.log(wineVintage.id);
                        }
                        return (
                            <WineVintageDetail key={wineVintage.id} wineVintage={wineVintage} onClick={onClick}/>
                        );
                    })}
                </Grid>
            </Section>
        </>
    )
}

export default ChoiceWineVintage;