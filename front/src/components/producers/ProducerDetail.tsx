import React from "react";
import {Producer} from "@/types/domain/producer";

interface Props {
    producer: Producer;
}


const ProducerDetail = ({producer}: Props) => {
    return (
        <div className="border rounded-lg shadow-lg p-6 text-center bg-gray-100 space-y-3">
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
        </div>
    )
}

export default ProducerDetail;