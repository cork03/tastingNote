import React from "react";
interface Props {
    text: string;
    type?: ButtonType;
    onClick?: (e: React.FormEvent<HTMLButtonElement>) => any;
}

type ButtonType = "button" | "submit" | "reset";

const GrayButton = ({text, type, onClick}: Props) => {
    return (
        <button
            onClick={onClick}
            type={type ?? "button"}
            className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
        >
            {text}
        </button>
    );
}

export default GrayButton;