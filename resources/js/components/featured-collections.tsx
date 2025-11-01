import React from 'react';

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
    return (
        <div className={className}>
            <h2 className="text-[#181611] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
                Featured Collections
            </h2>
            <div className="flex overflow-y-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <div className="flex items-stretch p-4 gap-3">
                    {collections.map((collection) => (
                        <div key={collection.id} className="flex h-full flex-1 flex-col gap-4 rounded-lg min-w-60">
                            <div
                                className="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg flex flex-col hover:scale-105 transition-transform duration-300 cursor-pointer"
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
