import React from "react";
import Title from "@/components/utils/view/title";
import {WineVintage} from "@/types/domain/wine";
import EditWineVintage from "@/components/wine-vintage/[id]/edit/editWineVintage";

const WineVintageEditPage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const initialWineVintageData = await fetch(`${process.env.API_URL}/wine-vintage/${id}`);
    const initialWineVintage: WineVintage = await initialWineVintageData.json();
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape-varieties`);
    const grapeVarieties = await grapeVarietiesData.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <Title title="ワイン編集"/>
            <EditWineVintage initialWineVintage={initialWineVintage} grapeVarieties={grapeVarieties}/>
        </main>
    );
};

export default WineVintageEditPage;