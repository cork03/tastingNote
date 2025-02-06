import Link from "next/link";
import React from "react";
import {Producer} from "@/types/domain/producer";
import Paragraph from "@/components/utils/view/side/paragraph";
import {Wine} from "@/types/domain/wine";
import Title from "@/components/utils/view/title";
import Section from "@/components/utils/view/section";
import GrayCard from "@/components/utils/view/grayCard";
import Main from "@/components/utils/view/main";

const WineDetailPage = async ({params}: { params: { id: number } }) => {
    const {id} = await params;
    const producerData = await fetch(`${process.env.API_URL}/producer/${id}`);
    const producer: Producer = await producerData.json();
    const winesData = await fetch(`${process.env.API_URL}/producer/${id}/wines`);
    const wines: Wine[] = await winesData.json();
    return (
        <Main>
            <Title title={producer.name}/>
            <Section>
                <GrayCard>
                    <div className="space-y-6">
                        <Paragraph label={"説明"} text={producer.description}/>
                        <Paragraph label={"国"} text={producer.country.name}/>
                        {producer.url &&
                            <Paragraph label={"URL"} text={producer.url}/>
                        }
                    </div>
                </GrayCard>
                <div className="space-y-6">
                    <div className="text-center mb-8">
                        <h2 className="text-3xl font-extrabold text-gray-800 mb-4">
                            ワイン一覧
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                        {wines.map((wine) => {
                            return (
                                <Link href={`/wine/${wine.id}`} key={wine.id}>
                                    <div
                                        className="border rounded-lg shadow-lg p-6 flex items-center text-center bg-gray-100">
                                        <div className="space-y-6">
                                            <h3 className="text-lg font-semibold mb-2">{wine.name}</h3>
                                            <img
                                                src="/images/wine.jpg"
                                                alt="ワイン画像"
                                                className="mx-auto mb-4"
                                            />
                                        </div>
                                    </div>
                                </Link>
                            );
                        })}
                    </div>
                </div>
            </Section>
        </Main>
    );
};

export default WineDetailPage;