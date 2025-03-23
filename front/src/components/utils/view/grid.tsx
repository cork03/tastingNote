import React from "react";

const Grid = ({
                  children, number
              }: Readonly<{
    children: React.ReactNode;
    number?: number;
}>) => {
    return (
        <div className={`grid grid-cols-3 sm:grid-cols-${number ?? 3} lg:grid-cols-${number ?? 3} gap-6`}>
            {children}
        </div>
    );
}

export default Grid;