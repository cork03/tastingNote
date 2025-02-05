import React from "react";
interface Props {
    text: string;
    onClick?: () => void;
}

const NormalButton = ({text, onClick}: Props) => {
    return (
        <button
            onClick={onClick}
            type="button"
            className="bg-gray-700 text-white py-2 px-4 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring focus:ring-gray-400 transition-all duration-300"
        >
            {text}
        </button>
    );
}

export default NormalButton;