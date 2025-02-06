import React from "react";

const Main = ({
                  children,
              }: Readonly<{
    children: React.ReactNode;
}>) => {
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            {children}
        </main>
    );
}

export default Main;