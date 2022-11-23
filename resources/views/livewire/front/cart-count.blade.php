<div>
    @if (Cart::count() > 0)
        <a x-on:click="showCart = true" href="#"
            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
            
            <svg class="mr-5 text-gray-100" width="30" height="30" viewbox="0 0 23 23" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                    d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
            <span
                class="inline-block w-6 h-6 text-center bg-gray-100 rounded-full font-semibold font-heading text-gray-900">
                {{ $cartCount }}
            </span>
        </a>
    @else
        <a class="flex items-center" href="#" x-on:click="showCart = true">
            <svg class="mr-5 text-gray-100" width="30" height="30" viewbox="0 0 23 23" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.1159 8.72461H2.50427C1.99709 8.72461 1.58594 9.12704 1.58594 9.62346V21.3085C1.58594 21.8049 1.99709 22.2074 2.50427 22.2074H18.1159C18.6231 22.2074 19.0342 21.8049 19.0342 21.3085V9.62346C19.0342 9.12704 18.6231 8.72461 18.1159 8.72461Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                    d="M6.34473 6.34469V4.95676C6.34473 3.85246 6.76252 2.79338 7.5062 2.01252C8.24988 1.23165 9.25852 0.792969 10.3102 0.792969C11.362 0.792969 12.3706 1.23165 13.1143 2.01252C13.858 2.79338 14.2758 3.85246 14.2758 4.95676V6.34469"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
            <span
                class="inline-block w-7 h-7 text-center bg-gray-100 rounded-full font-semibold font-heading text-gray-900">
                {{ $cartCount }}
            </span>
        </a>
    @endif
</div>
