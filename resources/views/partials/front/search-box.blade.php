<div x-data="{ searchBox: false }">
    <div class="flex items-center max-w-xs rounded-lg">
        <button @click="searchBox = !searchBox" class="flex items-center justify-center w-10 h-10 text-gray-500 bg-gray-100 rounded-l-lg focus:outline-none">
            <svg class="mr-4" width="23" height="23" viewbox="0 0 23 23" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M17.5 17.1309L12.5042 11.9551" stroke="black" stroke-miterlimit="10" stroke-linecap="round"
                stroke-linejoin="round"></path>
            <path
                d="M7.27524 13.8672C10.8789 13.8672 13.8002 10.945 13.8002 7.34033C13.8002 3.73565 10.8789 0.813477 7.27524 0.813477C3.67159 0.813477 0.750244 3.73565 0.750244 7.34033C0.750244 10.945 3.67159 13.8672 7.27524 13.8672Z"
                stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        </button>
        <input x-show="searchBox" type="text" class="w-full border-0 focus:ring-transparent focus:outline-none py-2 mr-4 rounded-md" placeholder="Search">
    </div>
</div>