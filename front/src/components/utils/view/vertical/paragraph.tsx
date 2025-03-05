import React from "react";
interface Props {
    label: string;
    text: string;
}

const Paragraph = ({label, text}: Props) => {
    return (
        <div className="flex flex-col">
            <label className="text-lg font-medium text-gray-800 w-40">{label}</label>
            <p className="text-lg text-gray-700 font-semibold">{text}</p>
        </div>
    );
}

export default Paragraph;