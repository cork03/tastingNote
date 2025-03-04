import Link from "next/link";
import React from "react";
import {Producer} from "@/types/domain/producer";
import Paragraph from "@/components/utils/view/side/paragraph";
import {ProducerWine} from "@/types/domain/wine";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import Main from "@/components/utils/view/main";
import Grid from "@/components/utils/view/grid";
import NormalImage from "@/components/utils/view/normalImage";
import {ProducerWine} from "@/api/queryService/types/producer";
import {getWines} from "@/api/queryService/producerQueryService";

const WineDetailPage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const producerData = await fetch(`${process.env.API_URL}/producer/${id}`);
    const producer: Producer = await producerData.json();
    const producerWines: ProducerWine[] = await getWines(id);
    return (
        <Main>
            <Title title={producer.name}/>
            <Section>
                <GrayCard>
                    <div className="space-y-6">
                        <Paragraph label={"説明"} text={producer.description}/>
                        <Paragraph label={"国"} text={producer.country.name}/>
                        {producer.url &&
                            <a href={producer.url} target="_blank" className={"block"}>
                                <Paragraph label={"URL"} text={producer.url}/>
                            </a>
                        }
                    </div>
                </GrayCard>
                <div className="space-y-6">
                    <div className="text-center mb-8">
                        <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                            ワイン一覧
                        </h2>
                    </div>
                    <Grid>
                        {producerWines.map((producerWine) => {
                            return (
                                <GrayCard key={producerWine.id}>
                                    <Link href={`/wine/${producerWine.id}`} key={producerWine.id}
                                          className={"text-center space-y-2"}>
                                        <h3 className="text-lg font-semibold mb-2">{producerWine.name}</h3>
                                        {producerWine.appellation &&
                                            <p className="text-sm font-semibold mb-2">{producerWine.appellation.appellationType.name} {producerWine.appellation.name}</p>
                                        }
                                        <NormalImage src={producerWine.imagePath}/>
                                    </Link>
                                </GrayCard>
                            );
                        })}
                    </Grid>
                </div>
            </Section>
        </Main>
    );
};

export default WineDetailPage;