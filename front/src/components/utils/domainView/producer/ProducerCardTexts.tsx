import React from "react";
import {Producer} from "@/types/domain/producer";

interface Props {
    producer: Producer;
}


const ProducerCardTexts = ({producer}: Props) => {
    return (
        <>
            <h3 className="text-lg font-semibold mb-2">{producer.name}</h3>
            <p className="text-sm text-gray-600">
                {producer.country.name}
            </p>
            <p className="text-sm text-gray-600">
                {producer.description}
            </p>
        </>
    )
}

export default ProducerCardTexts;