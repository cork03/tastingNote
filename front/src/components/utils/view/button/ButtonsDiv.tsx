import React from "react";

type ButtonType = "button" | "submit" | "reset";

const ButtonsDiv = ({
                        children,
                    }: Readonly<{
    children: React.ReactNode;
}>) => {
    return (
        <div className="flex flex-row justify-center items-center gap-x-10 mx-auto">
            {children}
        </div>
    );
}

export default ButtonsDiv;