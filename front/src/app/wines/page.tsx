import React from "react";
import {WineWithProducer} from "@/types/wine";
import Link from "next/link";
import {ListWine} from "@/api/types/wine";
import {getWineList} from "@/api/queryService/wineQueryService";
import GrayCard from "@/components/utils/view/grayCard";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import Grid from "@/components/utils/view/grid";

const Wines = async () => {
    const initialWines: ListWine[] = await getWineList();
    console.log(initialWines);
    return (
        <Main>
            <Title title={"ワイン"}/>
            <div className="mb-8 flex flex-row justify-center items-center gap-x-4 mx-auto">
                <input
                    type="text"
                    placeholder="ワインを検索"
                    className="w-full max-w-md p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-400"
                />
            </div>
            <Section>
                <Grid>
                    {initialWines.map((wineWithProducer) => {
                        return (
                            <GrayCard key={wineWithProducer.id}>
                                <Link href={`/wine/${wineWithProducer.id}`} key={wineWithProducer.id} className={"text-center space-y-2"}>
                                    <h3 className="text-lg font-semibold mb-2">{wineWithProducer.name}</h3>
                                    <img
                                        src={wineWithProducer.imagePath ?? "/images/wine.jpg"}
                                        alt="ワイン画像"
                                        className="w-128 object-cover rounded-lg border border-gray-300 shadow-md mx-auto"
                                    />
                                    <label className="block text-sm">生産者</label>
                                    <p className="text-sm text-gray-600">{wineWithProducer.producer.name}</p>
                                    <label className="block text-sm">国</label>
                                    <p className="text-sm text-gray-600">{wineWithProducer.country.name}</p>
                                </Link>
                            </GrayCard>
                        );
                    })}
                </Grid>
            </Section>
        </Main>
    );
}

export default Wines;