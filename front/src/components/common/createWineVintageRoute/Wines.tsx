import React from "react";
import WineDetail from "@/components/common/createWineVintageRoute/WineDetail";
import GrayButton from "@/components/utils/view/button/GrayButton";
import Grid from "@/components/utils/view/grid";
import {Wine} from "@/types/domain/wine";
import {redirect} from "next/navigation";
import {ViewType} from "@/components/common/createWineVintageRoute/type";

interface Props {
    onClickWineDetail: (windId: number) => void;
    wines: Wine[];
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
}

const Wines = ({onClickWineDetail, wines, setViewType}: Props) => {
    return (
        <>
            <Grid>
                {wines.map((wine) => {
                    const onClick = () => {
                        if (!wine.id) {
                            throw new Error("wine.id is not defined");
                        }
                        onClickWineDetail(wine.id);
                    }
                    return <WineDetail key={wine.id} wine={wine} onClick={onClick}/>
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