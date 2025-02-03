import React from "react";
import Title from "@/components/utils/view/title";
import CreateWineVintage from "@/components/wine/[id]/vintage/create/page";

const WineVintageDetailPage = async ({params}: { params: { id: number}}) => {
    const wineId = await params.id;
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape-varieties`);
    const grapeVarieties = await grapeVarietiesData.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <Title title="ワイン作成"/>
            <CreateWineVintage wineId={wineId} grapeVarieties={grapeVarieties}/>
        </main>
    );
};

export default WineVintageDetailPage;