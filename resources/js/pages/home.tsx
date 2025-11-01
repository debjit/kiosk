import CelebrityInspiration from '@/components/celebrity-inspiration';
import FeaturedCollections from '@/components/featured-collections';
import Header from '@/components/header';
import HeroSection from '@/components/hero-section';
import { Head } from '@inertiajs/react';
import React from 'react';

interface HomePageProps {
    className?: string;
}

const HomePage: React.FC<HomePageProps> = ({ className = '' }) => {
    return (
        <>
            <Head title="Alpana Gems - Exquisite Jewelry for Every Occasion" />
            <div
                className={`group/design-root relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden bg-background ${className}`}
                style={{ fontFamily: 'Manrope, "Noto Sans", sans-serif' }}
            >
                <div className="layout-container flex h-full grow flex-col">
                    <Header />
                    <div className="flex flex-1 justify-center px-40 py-5">
                        <div className="layout-content-container flex w-[80%] flex-1 flex-col">
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
