import React from "react";
import {Producer} from "@/types/domain/producer";
import ProducerDetail from "@/components/producers/ProducerDetail";
import Grid from "@/components/utils/view/grid";
import Section from "@/components/utils/view/section";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";

const ProducerCreatePage = async () => {
    const data = await fetch(`${process.env.API_URL}/producers`);
    const producers: Producer[] = await data.json();
    return (
        <Main>
            <Title title={"生産者"}/>
            <Section>
                <Grid>
                    {producers.map((producer) => {
                        return <ProducerDetail producer={producer} key={producer.id}/>
                    })}
                </Grid>
            </Section>
        </Main>
    );
};

export default ProducerCreatePage;