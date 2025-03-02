"use client"
import {redirect} from "next/navigation";
import WineVintageDetail from "@/components/utils/domainView/WineVintage/WineVintageDetail";
import Grid from "@/components/utils/view/grid";
import React from "react";
import {WineWithVintages} from "@/api/types/wine";

interface Props {
    wineWithVintages: WineWithVintages;
}

const WineVintages = ({wineWithVintages}: Props) => {
    return (
        <Grid>
            {wineWithVintages.wineVintages.map((wineVintage) => {
                const onClick = () => {
                    redirect(`/wine/${wineWithVintages.id}/vintage/${wineVintage.vintage}`);
                }
                return (
                    <WineVintageDetail key={wineVintage.id} wineVintage={wineVintage} onClick={onClick}/>
                );
            })}
        </Grid>
    );
}

export default WineVintages;