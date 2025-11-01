import React from 'react';
import Header from '@/components/header';
import HeroSection from '@/components/hero-section';
import FeaturedCollections from '@/components/featured-collections';
import CelebrityInspiration from '@/components/celebrity-inspiration';
import { Head } from '@inertiajs/react';

interface HomePageProps {
    className?: string;
}

const HomePage: React.FC<HomePageProps> = ({ className = '' }) => {
    return (
        <>
            <Head title="Luxe Gems - Exquisite Jewelry for Every Occasion" />
            <div className={`relative flex h-auto min-h-screen w-full flex-col bg-white group/design-root overflow-x-hidden ${className}`} style={{ fontFamily: 'Manrope, "Noto Sans", sans-serif' }}>
                <div className="layout-container flex h-full grow flex-col">
                    <Header />
                    <div className="px-40 flex flex-1 justify-center py-5">
                        <div className="layout-content-container flex flex-col max-w-[960px] flex-1">
                            <div className="@container">
                                <div className="@[480px]:p-4">
                                    <HeroSection />
                                </div>
                            </div>
                            <FeaturedCollections />
                            <CelebrityInspiration />
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default HomePage;
