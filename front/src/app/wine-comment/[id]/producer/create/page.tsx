import React from "react";
import {Country} from "@/types/domain/country";
import ProducerCreate from "@/components/utils/domainView/producer/ProducerCreate";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";

const ProducerCreatePageWithWineCommentId = async ({params}: {params: {id: number}}) => {
    const {id} = await params;
    const data = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await data.json();
    return (
        <Main>
            <Title title={"生産者作成"}/>
           <ProducerCreate countries={countries} redirectPath={`/wine-comment/${id}/add-wine-vintage`}/>
        </Main>
    );
};

export default ProducerCreatePageWithWineCommentId;