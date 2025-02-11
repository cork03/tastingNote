import React from "react";
import Title from "@/components/utils/view/title";
import Main from "@/components/utils/view/main";
import CreateWineVintage from "@/components/wine-comment/[id]/wine/[wineId]/vintage/create/createWineVintage";

const CreateWineVintagePage = async ({params}: { params: { id: number, wineId: number}}) => {
    const {id, wineId} = await params;
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape-varieties`);
    const grapeVarieties = await grapeVarietiesData.json();
    return (
        <Main>
            <Title title="ワイン作成"/>
            <CreateWineVintage wineCommentId={id} wineId={wineId} grapeVarieties={grapeVarieties}/>
        </Main>
    );
};

export default CreateWineVintagePage;