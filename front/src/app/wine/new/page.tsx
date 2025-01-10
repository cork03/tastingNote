import Producers from "@/components/wine/new/Producers";

export interface Producer {
    id: number;
    name: string;
}

const WineNewPage = async () => {
    const data = await fetch(`${process.env.API_URL}/producers`);
    const producers: Producer[] = await data.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <Producers initialProducers={producers}/>
        </main>
    );
};

export default WineNewPage;