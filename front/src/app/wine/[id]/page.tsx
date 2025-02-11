import React from "react";
import Main from "@/components/utils/view/main";
import Section from "@/components/utils/view/section";
import {WineFullInfo} from "@/types/domain/wine";
import WineVintages from "@/components/wine/[id]/WineVintages";

const WineDetailPage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const data = await fetch(`${process.env.API_URL}/wine/${id}`);
    const initialWineFullInfo: WineFullInfo = await data.json();
    return (
        <Main>
            <div className="text-center mb-8">
                <h2 className="text-2xl font-bold mb-4">{initialWineFullInfo.name}</h2>
                <div className="space-y-2">
                    <p className="text-sm text-gray-600">{initialWineFullInfo.country.name}</p>
                    <p className="text-sm text-gray-600">{initialWineFullInfo.producer.name}</p>
                </div>
            </div>
            <Section>
                <WineVintages wineFullInfo={initialWineFullInfo}/>
            </Section>
        </Main>
    );
};

export default WineDetailPage;
