import NavItem from "@/components/nav/NavItem";

export interface NavProps {
    url: string;
    text: string;
}

const Nav = () => {
    const navList: NavProps[] = [
        {url: "/blind-tasting", text: "BlindTasting"},
        {url: "/wine/create", text: "NewWine"},
        {url: "/wines", text: "Wines"},
        {url: "/producers", text: "Producers"},
        {url: "/map", text: "Map"},
        {url: "/ranking", text: "Ranking"},
    ];
    return (
        <nav className="bg-gray-700 text-white py-2 shadow">
            <div className="container mx-auto px-4 flex justify-center space-x-10">
                {navList.map((navProps: NavProps) => {
                    return <NavItem key={navProps.url} url={navProps.url} text={navProps.text}/>
                })}
            </div>
        </nav>
    )
}

export default Nav;