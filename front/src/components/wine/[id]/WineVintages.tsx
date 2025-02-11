"use client"
import {redirect} from "next/navigation";
import WineVintageDetail from "@/components/utils/domainView/WineVintage/WineVintageDetail";
import Grid from "@/components/utils/view/grid";
import React from "react";
import {WineFullInfo} from "@/types/domain/wine";

interface Props {
    wineFullInfo: WineFullInfo;
}

const WineVintages = ({wineFullInfo}: Props) => {
    return (
        <Grid>
            {wineFullInfo.wineVintages.map((wineVintage) => {
                const onClick = () => {
                    redirect(`/wine/${wineFullInfo.id}/vintage/${wineVintage.vintage}`);
                }
                return (
                    <WineVintageDetail key={wineVintage.id} wineVintage={wineVintage} onClick={onClick}/>
                );
            })}
        </Grid>
    );
}

export default WineVintages;