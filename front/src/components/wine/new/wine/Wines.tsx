import React from "react";
import WineDetail from "@/components/wine/new/wine/WineDetail";
import {ViewType} from "@/components/wine/new/CreateNewTasting";
import {Wine} from "@/types/wine";
import GrayButton from "@/components/utils/view/button/GrayButton";
import Grid from "@/components/utils/view/grid";

interface Props {
    wines: Wine[];
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
}

const Wines = ({wines, setViewType}: Props) => {
    return (
        <>
            <Grid>
                {wines.map((wine) => {
                    return <WineDetail key={wine.id} wine={wine}/>
                })}
            </Grid>
            <div className="text-center">
                <GrayButton text={"戻る"} type="submit"
                            onClick={() => setViewType(1)}
                />
            </div>
        </>
    )
}

export default Wines;