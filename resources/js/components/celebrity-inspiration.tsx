import React from 'react';

interface InspirationItem {
    id: number;
    name: string;
    image: string;
    celebrity: string;
}

interface CelebrityInspirationProps {
    items?: InspirationItem[];
    className?: string;
}

const defaultInspirationItems: InspirationItem[] = [
    {
        id: 1,
        name: 'Inspired by Anya Taylor-Joy',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBjKxq1FOwkY0l-r-agF3zVq1qoiRY7oB_zMVQ3bC9ZhuusdgxUIm3mA26SdRYpN5P9AyNGwsKAPn3MsOFE-cbKHgOkfIekWUl6ja8V8gtFUeMe2BiOIOqvPTBuoWzkfdIocOYCJN5KUSedWpKc1sTSrzPI-fpgBJieskz0YsxRasfBgKd5OUHho-HJiRQCOMzDalfzLvcJw5hw-Znkt7lQvonJmg_4YKSudTq7SlI6vbDhl4CnIJUsomfi9LcS-O14DAZdxavF0BM',
        celebrity: 'Anya Taylor-Joy'
    },
    {
        id: 2,
        name: 'Inspired by Zendaya',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAh-NsKuywtoKkhOA2xNGkb3W2BklUrGFqT8YhcLLfAo-q4gSKYFFnRv8ztqW58NKX3KdAhjUttyG9ouyGcRZZCqT3FBDKhRRUIq0WbCBEcfju0zK4CVscuiOlhjV3ZeAvQNoq3EOvr2Ike-tUxjpgbj6KzuphIs5LDzwf8Dg0c51lgW0LSppnMLsNsvxmj6aZMFMZEN0aM-UKRUvcYkDUu-6FquKMHZUqLmj0YbSN3BzqTkVAcc8cgQcEp07d0psygmKdneI5vaiY',
        celebrity: 'Zendaya'
    },
    {
        id: 3,
        name: 'Inspired by Rihanna',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDrP9gD_xtWaN6BHU9oYrq3-yZgNNz422PgS75sY67eZ3PXcf95584OE635LuPdmeVXNUMRGO4N15hODer36hgVUA79JRResHvJb_4d8ANO9jq5RAppwWN_zxEbPf3D-sdl6dB3ueg9kYjK-ujxvJF_oqkUj4Y_lJ9RgeznVLZ0WXEDWdss4lE53Pt2UpqboKR5cj_vOfKMTcrDRawcougsTYeS3DisQ29PzF-R2boHnv7KxJoneql7w8opvtzz0XDwSVSdY-75ieY',
        celebrity: 'Rihanna'
    }
];

const CelebrityInspiration: React.FC<CelebrityInspirationProps> = ({
    items = defaultInspirationItems,
    className = ''
}) => {
    return (
        <div className={className}>
            <h2 className="text-[#181611] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
                Match Your Style: Celebrity Inspiration
            </h2>
            <div className="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
                {items.map((item) => (
                    <div key={item.id} className="flex flex-col gap-3 pb-3">
                        <div
                            className="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer"
                            style={{ backgroundImage: `url("${item.image}")` }}
                            role="img"
                            aria-label={item.name}
                        />
                        <p className="text-[#181611] text-base font-medium leading-normal">{item.name}</p>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default CelebrityInspiration;
