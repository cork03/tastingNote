"use client"
import {redirect} from "next/navigation";
import WineVintageDetail from "@/components/utils/domainView/WineVintage/WineVintageDetail";
import Grid from "@/components/utils/view/grid";
import React from "react";
import {WineWithVintages} from "@/api/queryService/types/wine";
import NormalButton from "@/components/utils/view/button/NormalButton";

interface Props {
    wineWithVintages: WineWithVintages;
}

const WineVintages = ({wineWithVintages}: Props) => {
    return (
        <>
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
            <div className="text-center">
                <NormalButton text={"ワイン情報を更新"} type="submit"
                            onClick={() => redirect(`/wine/${wineWithVintages.id}/edit`)}
                />
            </div>
        </>
    );
}

export default WineVintages;