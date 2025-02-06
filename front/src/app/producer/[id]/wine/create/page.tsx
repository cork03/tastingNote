import Link from "next/link";
import React from "react";
import {Producer} from "@/types/domain/producer";
import Paragraph from "@/components/utils/view/side/paragraph";
import {Wine, WineType} from "@/types/domain/wine";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import Main from "@/components/utils/view/main";
import CreateWine from "@/components/proucer/[id]/wine/create/CreateWine";
import {Country} from "@/types/domain/country";

const CreateWinePage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const countriesData = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await countriesData.json();
    const wineTypesData = await fetch(`${process.env.API_URL}/wine-types`);
    const wineTypes: WineType[] = await wineTypesData.json();
    return (
        <Main>
            <Title title={"新しいワインを作成"}/>
            <CreateWine producerId={id} countries={countries} wineTypes={wineTypes}/>
        </Main>
    );
};

export default CreateWinePage;