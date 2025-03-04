import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";
import React from "react";
import {getWineDetail, getWineTypes} from "@/api/queryService/wineQueryService";
import {WineDetail, WineType} from "@/api/queryService/types/wine";
import UpdateWine from "@/components/wine/[id]/edit/UpdateWine";
import {Appellation} from "@/types/domain/appellation";
import {getCountries} from "@/api/queryService/countryQueryService";
import {Country} from "@/api/queryService/types/country";

const WineEditPage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const wineDetail: WineDetail = await getWineDetail(id)
    const countries: Country[] = await getCountries();
    const wineTypes: WineType[] = await getWineTypes();
    const appellationsData = await fetch(`${process.env.API_URL}/appellations`);
    const appellations: Appellation[] = await appellationsData.json();
    return (
        <Main>
            <Title title={"ワイン情報を更新"}/>
            <UpdateWine wineDetail={wineDetail} countries={countries} wineTypes={wineTypes} appellations={appellations}/>
        </Main>
    );
};

export default WineEditPage;