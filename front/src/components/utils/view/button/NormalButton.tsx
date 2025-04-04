import React from "react";
interface Props {
    text: string;
    type?: ButtonType;
    onClick?: () => void;
}

type ButtonType = "button" | "submit" | "reset";

const NormalButton = ({text, type, onClick}: Props) => {
    return (
        <button
            onClick={onClick}
            type={type ?? "button"}
            className="bg-gray-700 text-white py-2 px-4 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400 transition-all duration-300"
        >
            {text}
        </button>
    );
}

export default NormalButton;