import React from "react";

interface Props {
    title: string;
}
const Title = ({title}: Props) => {
    return (
        <div className="text-center mb-8">
            <h2 className="text-3xl font-extrabold text-gray-800 mb-4">{title}</h2>
        </div>
    );
}

export default Title;