import React from "react";
import {Producer} from "@/types/domain/producer";
import Link from "next/link";
import GrayCard from "@/components/utils/view/grayCard";
import ProducerCardTexts from "@/components/utils/domainView/producer/ProducerCardTexts";

interface Props {
    producer: Producer;
}


const ProducerDetail = ({producer}: Props) => {
    return (
        <Link href={`/producer/${producer.id}`} className={"text-center"}>
            <GrayCard>
                <ProducerCardTexts producer={producer}/>
            </GrayCard>
        </Link>
    )
}

export default ProducerDetail;