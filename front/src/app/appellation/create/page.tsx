import React from "react";
import Title from "@/components/utils/view/title";
import Main from "@/components/utils/view/main";
import {AppellationType} from "@/types/domain/appellation";
import AppellationCreate from "@/components/appellation/create/appelationCreate";
import {Country} from "@/types/domain/country";


const AppellationCreatePage = async () => {
    const appellationTypesData = await fetch(`${process.env.API_URL}/appellation/types`);
    const appellationTypes: AppellationType[] = await appellationTypesData.json();
    const countriesData = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await countriesData.json();
    return (
        <Main>
            <Title title="アペラシオンを作成"/>
            <AppellationCreate appellationTypes={appellationTypes} countries={countries}/>
        </Main>
    );
};

export default AppellationCreatePage;