import React from "react";
import Main from "@/components/utils/view/main";
import {getWineDetail} from "@/api/queryService/wineQueryService";
import {WineDetail} from "@/api/types/wine";
import Section from "@/components/utils/view/section";
import WineVintages from "@/components/wine/[id]/WineVintages";

const WineDetailPage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const wineDetail : WineDetail = await getWineDetail(id);
    return (
        <Main>
            <div className="text-center mb-8">
                <h2 className="text-2xl font-bold mb-4">{wineDetail.wine.name}</h2>
                <div className="space-y-2">
                    <p className="text-sm text-gray-600">{wineDetail.wine.country.name}</p>
                    <p className="text-sm text-gray-600">{wineDetail.producer.name}</p>
                </div>
            </div>
            <Section>
                <WineVintages wineWithVintages={wineDetail.wine}/>
            </Section>
        </Main>
    );
};

export default WineDetailPage;
