import React from 'react';
import { Link } from '@inertiajs/react';

interface HeaderProps {
    className?: string;
}

const Header: React.FC<HeaderProps> = ({ className = '' }) => {
    return (
        <header className={`flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f4f3f0] px-10 py-3 ${className}`}>
            <div className="flex items-center gap-4 text-[#181611]">
                <div className="size-4">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 42.4379C4 42.4379 14.0962 36.0744 24 41.1692C35.0664 46.8624 44 42.2078 44 42.2078L44 7.01134C44 7.01134 35.068 11.6577 24.0031 5.96913C14.0971 0.876274 4 7.27094 4 7.27094L4 42.4379Z"
                            fill="currentColor"
                        />
                    </svg>
                </div>
                <h2 className="text-[#181611] text-lg font-bold leading-tight tracking-[-0.015em]">Luxe Gems</h2>
            </div>
            <div className="flex flex-1 justify-end gap-8">
                <div className="flex items-center gap-9">
                    <Link href="#" className="text-[#181611] text-sm font-medium leading-normal hover:text-[#eca413] transition-colors">
                        Browse Collections
                    </Link>
                    <Link href="#" className="text-[#181611] text-sm font-medium leading-normal hover:text-[#eca413] transition-colors">
                        Bespoke Design
                    </Link>
                    <Link href="#" className="text-[#181611] text-sm font-medium leading-normal hover:text-[#eca413] transition-colors">
                        Virtual Try-On
                    </Link>
                    <Link href="#" className="text-[#181611] text-sm font-medium leading-normal hover:text-[#eca413] transition-colors">
                        Contact Us
                    </Link>
                </div>
                <div className="flex gap-2">
                    <button
                        className="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-[#f4f3f0] text-[#181611] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5 hover:bg-[#e8e6e1] transition-colors"
                        aria-label="Search"
                    >
                        <div className="text-[#181611]" data-icon="MagnifyingGlass" data-size="20px" data-weight="regular">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"
                                />
                            </svg>
                        </div>
                    </button>
                    <button
                        className="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-[#f4f3f0] text-[#181611] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5 hover:bg-[#e8e6e1] transition-colors"
                        aria-label="User Account"
                    >
                        <div className="text-[#181611]" data-icon="User" data-size="20px" data-weight="regular">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"
                                />
                            </svg>
                        </div>
                    </button>
                </div>
                <div
                    className="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 cursor-pointer hover:ring-2 hover:ring-[#eca413] transition-all"
                    style={{
                        backgroundImage: 'url("https://lh3.googleusercontent.com/aida-public/AB6AXuCqR00EUO5hLyeUtnsZQyITpYYAUsHaOmEb96EK5KUCoIxEzahLsduRJQdnDqf22O1JpaF8vI86S76v0kYxREOBoX_bzaM6jBCeZPwGsYRKdljHkuCEA_QyhmI4t18JbDnGlZbzuKlzk5BldPyELDzZ_WlbN8W9UwlyMiDZfIyh8yS1ZemtyDcRSPnqTYwUrhpXCPdbGofptEcQmz7K0NJQ08ASSstIJ8LrAVfQU7nMGN-qYyfJ6yra0ZV4PREbx4yBkxsxgjgJyaY")'
                    }}
                    role="img"
                    aria-label="User profile"
                />
            </div>
        </header>
    );
};

export default Header;
