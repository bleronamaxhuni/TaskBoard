<div class="flex justify-end w-8/12">
    <form class="w-6/12 flex justify-end lg:w-10/12 bg-white border-2 border-transparent rounded-lg">
        <input class="w-10/12 relative flex-auto block  px-3 py-1.5 text-base font-normal text-gray-700 bg-clip-padding  focus:border-blue-600 focus:outline-none"
        aria-label="SearchProject" placeholder="Search projects..." name="searchProject" value="{{request('searchProject')}}">
        <button value="{{ request('searchProject') }}" type="submit"
        class="btn inline-block px-4 py-2  bg-blue-500 text-white rounded-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
        type="button"><i class="fa-solid fa-magnifying-glass"></i></button> 
    </form>
</div>