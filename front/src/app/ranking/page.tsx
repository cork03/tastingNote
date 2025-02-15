import React, {ChangeEvent} from "react";
import Grid from "@/components/utils/view/grid";
import Section from "@/components/utils/view/section";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";
import {WineRankingFullInfo} from "@/types/domain/wineRanking";
import GrayCard from "@/components/utils/view/grayCard";
import Link from "next/link";
import {getWineVarietiesTextDomain} from "@/utils/utils";
import {Wine, WineVintage} from "@/types/domain/wine";
import RegisterRanking from "@/components/ranking/RegistRanking";

const RankingPage = async () => {
    const wineRankingsFullInfoData = await fetch(`${process.env.API_URL}/wine-rankings?wine_type_id=1`);
    const wineRankingsFullInfo: WineRankingFullInfo[] = await wineRankingsFullInfoData.json();
    const notRegisteredWineVintageData = await fetch(`${process.env.API_URL}/wine-vintages/not-registered-raking`);
    const notRegisteredWineVintages: {wineVintage: WineVintage, wine: Wine}[] = await notRegisteredWineVintageData.json();
    return (
        <Main>
            <Title title={"ランキング"}/>
            <RegisterRanking wineVintagesInfo={notRegisteredWineVintages} registeredCount={wineRankingsFullInfo.length}/>
            <Section>
                <Grid>
                    {wineRankingsFullInfo.map((wineRankFullInfo) => {
                        return (
                            <GrayCard key={wineRankFullInfo.wineRanking.id}>
                                <Link
                                    href={`/wine/${wineRankFullInfo.wine.id}/vintage/${wineRankFullInfo.wineVintage.vintage}`}
                                    className='text-center'
                                >
                                    <p className="text-2xl text-gray-700 font-semibold">No.{wineRankFullInfo.wineRanking.rank}</p>
                                    <p className="text-lg text-gray-700 font-semibold">{`${wineRankFullInfo.wine.name}:${wineRankFullInfo.wineVintage.vintage}年`}</p>
                                    <p className="text-lg text-gray-700 font-semibold">{getWineVarietiesTextDomain(wineRankFullInfo.wineVintage.wineBlend)}</p>
                                    <img
                                        src={wineRankFullInfo.wineVintage.imagePath ?? '/images/wine.jpg'}
                                        alt="画像"
                                        className="w-128 object-cover rounded-lg border border-gray-300 shadow-md mx-auto"
                                    />
                                </Link>
                            </GrayCard>
                        )
                    })}
                </Grid>
            </Section>
        </Main>
    );
};

export default RankingPage;