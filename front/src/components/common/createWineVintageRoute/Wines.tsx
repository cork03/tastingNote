import React from "react";
import WineDetail from "@/components/common/createWineVintageRoute/WineDetail";
import GrayButton from "@/components/utils/view/button/GrayButton";
import Grid from "@/components/utils/view/grid";
import {Wine} from "@/types/domain/wine";
import {redirect} from "next/navigation";
import {ViewType} from "@/components/common/createWineVintageRoute/type";

interface Props {
    prefix: string;
    wines: Wine[];
    setViewType: React.Dispatch<React.SetStateAction<ViewType>>;
}

const Wines = ({prefix, wines, setViewType}: Props) => {
    return (
        <>
            <Grid>
                {wines.map((wine) => {
                    const onClick = () => {
                        if (prefix) {
                            setViewType(3);
                        } else {
                            redirect(`/wine/${wine.id}/vintage/create`);
                        }
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