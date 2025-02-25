import React from "react";
import {WineType} from "@/types/domain/wine";
import Title from "@/components/utils/view/title";
import Main from "@/components/utils/view/main";
import CreateWine from "@/components/common/createWineVintageRoute/createWine/CreateWine";
import {Country} from "@/types/domain/country";
import {Appellation} from "@/types/domain/appellation";

const CreateWinePage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const countriesData = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await countriesData.json();
    const wineTypesData = await fetch(`${process.env.API_URL}/wine-types`);
    const wineTypes: WineType[] = await wineTypesData.json();
    const appellationsData = await fetch(`${process.env.API_URL}/appellations`);
    const appellations: Appellation[] = await appellationsData.json();
    return (
        <Main>
            <Title title={"新しいワインを作成"}/>
            <CreateWine prefix={""} producerId={id} countries={countries} wineTypes={wineTypes} appellations={appellations} />
        </Main>
    );
};

export default CreateWinePage;