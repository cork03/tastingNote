import React from "react";
import {Country, GrapeVariety} from "@/types/wine";
import CreateBlindTasting from "@/components/blind-tasting/CreateBlindTasting";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";

const BlindTastingPage = async () => {
    const countriesData = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await countriesData.json();
    const grapeVarietiesData = await fetch(`${process.env.API_URL}/grape-varieties`);
    const grapeVarieties: GrapeVariety[] = await grapeVarietiesData.json();
    return (
        <Main>
            <Title title={"Blind Tasting"}/>
            <CreateBlindTasting grapeVarieties={grapeVarieties} countries={countries}/>
        </Main>
    );
}

export default BlindTastingPage;