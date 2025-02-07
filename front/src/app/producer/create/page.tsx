import React from "react";
import {Country} from "@/types/domain/country";
import ProducerCreate from "@/components/common/createWineVintageRoute/createProducer/ProducerCreate";
import Main from "@/components/utils/view/main";
import Title from "@/components/utils/view/title";

const ProducerCreatePage = async () => {
    const data = await fetch(`${process.env.API_URL}/countries`);
    const countries: Country[] = await data.json();
    return (
        <Main>
            <Title title={"生産者作成"}/>
            <ProducerCreate redirectPath={"/wine/create"} countries={countries}/>
        </Main>
    );
};

export default ProducerCreatePage;