<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="/astro/src/css/style.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-content {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            animation: fadeIn 0.2s ease-out;
            transition: visibility 0.2s, opacity 0.2s linear;
        }
        .nav-item:hover .dropdown-content,
        .nav-item:focus-within .dropdown-content {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }
        body { font-family: "Urbanist", sans-serif; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50">
    <header>
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo Section -->
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <img src="/images/Logo1.png" alt="IsFor Logo" class="h-10 w-auto" />
                        <span class="text-lg font-semibold text-blue-900">IsFor Pusat Riset Informatika</span>
                    </div>
                    <div class="hidden lg:flex lg:items-center">
                        <div class="flex items-center space-x-6" id="nav-items"></div>
                        <div class="relative nav-item group">
                            <button class="text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md transition-colors inline-flex items-center">
                                Dashboard
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="dropdown-content absolute right-0 mt-1 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                <div class="py-1" id="user-menu-items"></div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="hidden lg:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t" id="mobile-nav-items"></div>
                <div class="mt-4 space-y-2 px-3">
                    <div class="relative nav-item group">
                        <button class="block w-full text-center text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md transition-colors">
                            Dashboard
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="dropdown-content absolute right-0 mt-1 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1" id="mobile-user-menu-items"></div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <script>
        const navItems = [
            { name: "Beranda", href: "/" },
            {
                name: "Tentang Kami",
                dropdownItems: [
                    { name: "Sejarah", href: "#sejarah" },
                    { name: "Visi Misi", href: "#visi-misi" },
                    { name: "Roadmap", href: "#roadmap" },
                    { name: "Pengelola", href: "#pengelola" },
                    { name: "List Peneliti", href: "#list-peneliti" }
                ]
            },
            {
                name: "Riset & Publikasi",
                dropdownItems: [
                    { name: "Penelitian", href: "#" },
                    { name: "Hasil Peneliti", href: "#" }
                ]
            },
            { name: "Agenda", href: "#agenda" },
            { name: "Arsip", dropdownItems: [{ name: "Dokumen", href: "#" }] },
            { name: "Galeri", href: "/galeri" }
        ];

        const userMenuItems = [
            { name: "Dashboard", href: "/admin_dashboard" },
            { name: "Logout", href: "/" }
        ];

        const renderNavItems = () => {
            const navContainer = document.getElementById('nav-items');
            const mobileNavContainer = document.getElementById('mobile-nav-items');
            navItems.forEach(item => {
                const navItem = document.createElement('div');
                navItem.className = 'nav-item relative group';
                navItem.innerHTML = `
                    <a href="${item.href || '#'}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors inline-flex items-center" tabindex="0">
                        ${item.name}
                        ${item.dropdownItems ? `<svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>` : ''}
                    </a>
                    ${item.dropdownItems ? `
                        <div class="dropdown-content absolute left-0 mt-1 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                ${item.dropdownItems.map(dropItem => `<a href="${dropItem.href}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors">${dropItem.name}</a>`).join('')}
                            </div>
                        </div>
                    ` : ''}
                `;
                navContainer.appendChild(navItem);

                const mobileNavItem = document.createElement('div');
                mobileNavItem.innerHTML = `
                    <a href="${item.href || '#'}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">${item.name}</a>
                    ${item.dropdownItems ? `
                        <div class="pl-4 space-y-1">
                            ${item.dropdownItems.map(dropItem => `<a href="${dropItem.href}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">${dropItem.name}</a>`).join('')}
                        </div>
                    ` : ''}
                `;
                mobileNavContainer.appendChild(mobileNavItem);
            });

            const userMenuContainer = document.getElementById('user-menu-items');
            const mobileUserMenuContainer = document.getElementById('mobile-user-menu-items');
            userMenuItems.forEach(menuItem => {
                const userMenuItem = document.createElement('a');
                userMenuItem.href = menuItem.href;
                userMenuItem.className = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors';
                userMenuItem.textContent = menuItem.name;
                userMenuContainer.appendChild(userMenuItem);

                const mobileUserMenuItem = document.createElement('a');
                mobileUserMenuItem.href = menuItem.href;
                mobileUserMenuItem.className = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors';
                mobileUserMenuItem.textContent = menuItem.name;
                mobileUserMenuContainer.appendChild(mobileUserMenuItem);
            });
        };

        document.addEventListener('DOMContentLoaded', renderNavItems);
    </script>
</body>
</html>