import React from 'react';

interface HeroSectionProps {
    className?: string;
}

const HeroSection: React.FC<HeroSectionProps> = ({ className = '' }) => {
    return (
        <div
            className={`flex min-h-[480px] flex-col items-center justify-center gap-6 bg-cover bg-center bg-no-repeat p-4 @[480px]:gap-8 @[480px]:rounded-lg ${className}`}
            style={{
                backgroundImage:
                    'linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCSZNu_qnM0hF0yimPCy0_oWv8H4d47m9FA-OdNPydIO6-S_njTLYCIo9b-0b5nVHP3G2iZEfHO6PdWwS5QEcwyfOZgocr1AbtMAOjgt37EfDidOlIxbZngL1vO9DctZEpCWGJwFrBStedazCv28RjOdiwcsr7o5RKuDX_fXXPPcW1zb1-4ag0_B_b4kuVP7q-OTcHK7uhR64i1Mwf4rMEM28r_TfeCu8iqp5lACiK8fKiVpNTDcNaKfOebrK49Ln9sT_Vcf1BhHeg")',
            }}
        >
            <div className="flex flex-col gap-2 text-center">
                <h1 className="text-4xl leading-tight font-black tracking-[-0.033em] text-white @[480px]:text-5xl @[480px]:leading-tight @[480px]:font-black @[480px]:tracking-[-0.033em]">
                    Exquisite Jewelry for Every Occasion
                </h1>
                <h2 className="text-sm leading-normal font-normal text-white @[480px]:text-base @[480px]:leading-normal @[480px]:font-normal">
                    Discover our curated collections or create a custom piece
                    that reflects your unique style.
                </h2>
            </div>
            <button className="flex h-10 max-w-[480px] min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg bg-[#eca413] px-4 text-sm leading-normal font-bold tracking-[0.015em] text-[#181611] shadow-lg transition-colors hover:bg-[#d49310] @[480px]:h-12 @[480px]:px-5 @[480px]:text-base @[480px]:leading-normal @[480px]:font-bold @[480px]:tracking-[0.015em]">
                <span className="truncate">Explore Now</span>
            </button>
        </div>
    );
};

export default HeroSection;
