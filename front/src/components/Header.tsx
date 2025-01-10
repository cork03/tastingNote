import Link from "next/link";

const Header = () => {
    return (
        <header className="bg-gray-800 text-white py-4 shadow-md">
            <div className="container mx-auto px-4">
                <Link href="/">
                    <h1 className="text-2xl font-bold text-center">
                        Tasting Notes
                    </h1>
                </Link>
            </div>
        </header>
    )
}

export default Header;