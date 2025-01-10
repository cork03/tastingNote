import Link from "next/link";
import React from "react";
import {NavProps} from "@/components/nav/Nav";

const NavItem: React.FC<NavProps> = ({url, text}: NavProps) => {
    return (
        <Link href={url}>
            <div className="hover:text-gray-300">{text}</div>
        </Link>
    )
}

export default NavItem;