<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @foreach($categories as $category)
                        @if($category->posts()->count() > 0)
                            <x-nav-link :href="route('category.show', $category)" :active="request()->routeIs('category.show', $category)">
                                {{ $category->name }}
                            </x-nav-link>
                        @endif
                    @endforeach
                        <x-nav-link :href="route('category.show.uncategorized')" :active="request()->routeIs('category.show.uncategorized')">
                            Uncategorized
                        </x-nav-link>
                </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($categories as $category)
                @if($category->posts()->count() > 0)
                    <x-responsive-nav-link :href="route('category.show', $category)" :active="request()->routeIs('category.show', $category)">
                        {{ $category->name }}
                    </x-responsive-nav-link>
                @endif
            @endforeach
            <x-responsive-nav-link :href="route('category.show.uncategorized')" :active="request()->routeIs('category.show.uncategorized')">
                Uncategorized
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">

        </div>
    </div>
</nav>
