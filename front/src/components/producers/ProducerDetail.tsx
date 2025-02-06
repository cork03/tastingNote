import React from "react";
import {Producer} from "@/types/domain/producer";
import Link from "next/link";
import GrayCard from "@/components/utils/view/grayCard";

interface Props {
    producer: Producer;
}


const ProducerDetail = ({producer}: Props) => {
    return (
        <Link href={`/producer/${producer.id}`}>
            <GrayCard>
                <h3 className="text-lg font-semibold mb-2">{producer.name}</h3>
                <p className="text-sm text-gray-600">
                    {producer.country.name}
                </p>
                <p className="text-sm text-gray-600">
                    {producer.description}
                </p>
                <p className="text-sm text-gray-600">
                    {producer.url}
                </p>
            </GrayCard>
        </Link>
    )
}

export default ProducerDetail;