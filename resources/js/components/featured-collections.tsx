import React, { useState, useRef, useEffect } from 'react';
import { ChevronLeft, ChevronRight } from 'lucide-react';

interface Collection {
    id: number;
    name: string;
    image: string;
}

interface FeaturedCollectionsProps {
    collections?: Collection[];
    className?: string;
}

const defaultCollections: Collection[] = [
    {
        id: 1,
        name: 'Diamond Elegance',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtwNdaqzUagRrDJi0xmilbvnSdnI6ZucHNlfGKNV9fxhhd6595hZBreZ7D90kdDUXozWFEUp5utH4xZOrAw8k6KCmUEsFUcDwjZP4AxUgYtP_S6jLhA6-m2OWYBmt_B07a5AXPFZtc-egZ19S-WTcP5c5jMGEvGyvRhVtOxCyEbIE5q9Z9GXOwFpeiiYHZ1xFMXSQD8K-ulvlERhsJzdtawxZIvnhjUDfd-gHeXQeWEMm6PgRvrdVdOYWMYj9Bpu4x-8YTa2Fjgmw'
    },
    {
        id: 2,
        name: 'Golden Radiance',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhk0UmIFA01GwCFPdr1Cu0B_AyI4gibaY9cCJpW6bj7JNDKeRzlrw3LAmJlE70Y0scf30CqveBesUEIfPY4uCoXXDtpmXEZOeuVxMxaJAa1pdHFoGwAlX8G6J74HlJs-zDbs8QQAqG1-APR31PqLhbNBHQOQEwdjAlLaOniAAl-r2WvOhUv5cH2VmwFnccDX2C-SU8NubcSoz3RYlGct63rWPWH4v1yYEDxqvse55v1bEHI6P29ZaalgEUhpA7P0D7jsh-GykcaQM'
    },
    {
        id: 3,
        name: 'Gemstone Splendor',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDDAdqsEtkcQh8R8ydrUEDi5SVpepeM80480RCuQTxf-gg93uT3julqh0P80IJbnr-kQt0hcsLL0ZH4XHofFjxO1paYoSopiLfprTRu1a0vylgTOq2VklVzEppIPR4juBWQTRm7xaOV5s6cp2Aq2mvEkO1FyJT1rjbX89-UT4oap8r0zsZinLDlsSde7ClTNB7GUbIEUu-Pb-4_YBc-10cqq76k8tzOX7QO9MZL_mi6LXjF_aPDgEV_6waS41mRvdrV0WP_XmqkQBQ'
    },
    {
        id: 4,
        name: 'Platinum Prestige',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtwNdaqzUagRrDJi0xmilbvnSdnI6ZucHNlfGKNV9fxhhd6595hZBreZ7D90kdDUXozWFEUp5utH4xZOrAw8k6KCmUEsFUcDwjZP4AxUgYtP_S6jLhA6-m2OWYBmt_B07a5AXPFZtc-egZ19S-WTcP5c5jMGEvGyvRhVtOxCyEbIE5q9Z9GXOwFpeiiYHZ1xFMXSQD8K-ulvlERhsJzdtawxZIvnhjUDfd-gHeXQeWEMm6PgRvrdVdOYWMYj9Bpu4x-8YTa2Fjgmw'
    },
    {
        id: 5,
        name: 'Ruby Passion',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhk0UmIFA01GwCFPdr1Cu0B_AyI4gibaY9cCJpW6bj7JNDKeRzlrw3LAmJlE70Y0scf30CqveBesUEIfPY4uCoXXDtpmXEZOeuVxMxaJAa1pdHFoGwAlX8G6J74HlJs-zDbs8QQAqG1-APR31PqLhbNBHQOQEwdjAlLaOniAAl-r2WvOhUv5cH2VmwFnccDX2C-SU8NubcSoz3RYlGct63rWPWH4v1yYEDxqvse55v1bEHI6P29ZaalgEUhpA7P0D7jsh-GykcaQM'
    },
    {
        id: 6,
        name: 'Sapphire Dreams',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDDAdqsEtkcQh8R8ydrUEDi5SVpepeM80480RCuQTxf-gg93uT3julqh0P80IJbnr-kQt0hcsLL0ZH4XHofFjxO1paYoSopiLfprTRu1a0vylgTOq2VklVzEppIPR4juBWQTRm7xaOV5s6cp2Aq2mvEkO1FyJT1rjbX89-UT4oap8r0zsZinLDlsSde7ClTNB7GUbIEUu-Pb-4_YBc-10cqq76k8tzOX7QO9MZL_mi6LXjF_aPDgEV_6waS41mRvdrV0WP_XmqkQBQ'
    },
    {
        id: 7,
        name: 'Emerald Bliss',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtwNdaqzUagRrDJi0xmilbvnSdnI6ZucHNlfGKNV9fxhhd6595hZBreZ7D90kdDUXozWFEUp5utH4xZOrAw8k6KCmUEsFUcDwjZP4AxUgYtP_S6jLhA6-m2OWYBmt_B07a5AXPFZtc-egZ19S-WTcP5c5jMGEvGyvRhVtOxCyEbIE5q9Z9GXOwFpeiiYHZ1xFMXSQD8K-ulvlERhsJzdtawxZIvnhjUDfd-gHeXQeWEMm6PgRvrdVdOYWMYj9Bpu4x-8YTa2Fjgmw'
    },
    {
        id: 8,
        name: 'Pearl Serenity',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhk0UmIFA01GwCFPdr1Cu0B_AyI4gibaY9cCJpW6bj7JNDKeRzlrw3LAmJlE70Y0scf30CqveBesUEIfPY4uCoXXDtpmXEZOeuVxMxaJAa1pdHFoGwAlX8G6J74HlJs-zDbs8QQAqG1-APR31PqLhbNBHQOQEwdjAlLaOniAAl-r2WvOhUv5cH2VmwFnccDX2C-SU8NubcSoz3RYlGct63rWPWH4v1yYEDxqvse55v1bEHI6P29ZaalgEUhpA7P0D7jsh-GykcaQM'
    }
];

const FeaturedCollections: React.FC<FeaturedCollectionsProps> = ({
    collections = defaultCollections,
    className = ''
}) => {
    const scrollRef = useRef<HTMLDivElement>(null);
    const [canScrollLeft, setCanScrollLeft] = useState(false);
    const [canScrollRight, setCanScrollRight] = useState(true);
    const [isDragging, setIsDragging] = useState(false);
    const [startX, setStartX] = useState(0);
    const [scrollLeft, setScrollLeft] = useState(0);

    const checkScrollButtons = () => {
        if (scrollRef.current) {
            const { scrollLeft, scrollWidth, clientWidth } = scrollRef.current;
            setCanScrollLeft(scrollLeft > 0);
            setCanScrollRight(scrollLeft < scrollWidth - clientWidth - 1);
        }
    };

    useEffect(() => {
        checkScrollButtons();
        const handleResize = () => checkScrollButtons();
        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, [collections]);

    const scroll = (direction: 'left' | 'right') => {
        if (scrollRef.current) {
            const scrollAmount = 320; // Approximate width of one card + gap
            const newScrollLeft = scrollRef.current.scrollLeft + (direction === 'left' ? -scrollAmount : scrollAmount);
            scrollRef.current.scrollTo({
                left: newScrollLeft,
                behavior: 'smooth'
            });
        }
    };

    const handleMouseDown = (e: React.MouseEvent) => {
        setIsDragging(true);
        setStartX(e.pageX - (scrollRef.current?.offsetLeft || 0));
        setScrollLeft(scrollRef.current?.scrollLeft || 0);
    };

    const handleMouseMove = (e: React.MouseEvent) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - (scrollRef.current?.offsetLeft || 0);
        const walk = (x - startX) * 2;
        if (scrollRef.current) {
            scrollRef.current.scrollLeft = scrollLeft - walk;
        }
    };

    const handleMouseUp = () => {
        setIsDragging(false);
    };

    const handleTouchStart = (e: React.TouchEvent) => {
        setIsDragging(true);
        setStartX(e.touches[0].pageX - (scrollRef.current?.offsetLeft || 0));
        setScrollLeft(scrollRef.current?.scrollLeft || 0);
    };

    const handleTouchMove = (e: React.TouchEvent) => {
        if (!isDragging) return;
        const x = e.touches[0].pageX - (scrollRef.current?.offsetLeft || 0);
        const walk = (x - startX) * 2;
        if (scrollRef.current) {
            scrollRef.current.scrollLeft = scrollLeft - walk;
        }
    };

    const handleTouchEnd = () => {
        setIsDragging(false);
    };

    return (
        <div className={className}>
            <div className="flex items-center justify-between px-4 pb-3 pt-5">
                <h2 className="text-[#181611] text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Featured Collections
                </h2>
                <div className="flex gap-2">
                    <button
                        onClick={() => scroll('left')}
                        disabled={!canScrollLeft}
                        className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        aria-label="Scroll left"
                    >
                        <ChevronLeft className="h-4 w-4 text-gray-600" />
                    </button>
                    <button
                        onClick={() => scroll('right')}
                        disabled={!canScrollRight}
                        className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        aria-label="Scroll right"
                    >
                        <ChevronRight className="h-4 w-4 text-gray-600" />
                    </button>
                </div>
            </div>
            <div
                ref={scrollRef}
                className={`flex overflow-x-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden cursor-grab active:cursor-grabbing select-none ${isDragging ? 'scroll-smooth' : ''}`}
                onScroll={checkScrollButtons}
                onMouseDown={handleMouseDown}
                onMouseMove={handleMouseMove}
                onMouseUp={handleMouseUp}
                onMouseLeave={handleMouseUp}
                onTouchStart={handleTouchStart}
                onTouchMove={handleTouchMove}
                onTouchEnd={handleTouchEnd}
            >
                <div className="flex items-stretch p-4 gap-3">
                    {collections.map((collection) => (
                        <div key={collection.id} className="flex h-full flex-1 flex-col gap-4 rounded-lg min-w-60">
                            <div
                                className="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg flex flex-col hover:scale-105 transition-transform duration-300 cursor-pointer shadow-sm hover:shadow-md"
                                style={{ backgroundImage: `url("${collection.image}")` }}
                                role="img"
                                aria-label={collection.name}
                            />
                            <p className="text-[#181611] text-base font-medium leading-normal">{collection.name}</p>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default FeaturedCollections;
