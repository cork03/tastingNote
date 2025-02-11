import React from "react";
import Title from "@/components/utils/view/title";
import CreateWineVintage from "@/components/wine/[id]/vintage/create/createWineVintage";
import Main from "@/components/utils/view/main";

const WineVintageDetailPage = async ({params}: { params: { id: number}}) => {
    const {id} = await params;
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape-varieties`);
    const grapeVarieties = await grapeVarietiesData.json();
    return (
        <Main>
            <Title title="ワイン作成"/>
            <CreateWineVintage wineId={id} grapeVarieties={grapeVarieties}/>
        </Main>
    );
};

export default WineVintageDetailPage;