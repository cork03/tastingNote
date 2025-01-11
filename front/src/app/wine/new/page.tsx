import CreateNewTasting from "@/components/wine/new/CreateNewTasting";

export interface Producer {
    id: number;
    name: string;
}

export interface Wine {
    id: number;
    name: string;
    producer: Producer;
    wineTypeId: number;
}

export interface WineType {
    id: number;
    label: string;
}

const WineNewPage = async () => {
    const data = await fetch(`${process.env.API_URL}/producers`);
    const producers: Producer[] = await data.json();
    return (
        <main className="flex-grow min-h-screen container mx-auto px-4 py-8">
            <CreateNewTasting initialProducers={producers}/>
        </main>
    );
};

export default WineNewPage;