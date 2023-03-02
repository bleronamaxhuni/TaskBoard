<div class="flex w-full justify-end">
    <button onclick="toggleModal()"
        class="shadow inline-flex items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-4 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Create Tasks
    </button>
</div>
<div class="flex w-full justify-end">
    <div class="overflow-y-auto top-0 w-8/12 lg:w-full p-8 rounded-lg hidden shadow-lg shadow-gray-300 bg-white mt-4" id="modal">
        <form action="/tasks/create" method="POST">
            @csrf
            <label for="task_title" class="font-bold mb-1 text-gray-700 block">Title</label>
            <input type="text" name="task_title" value="{{old('task_title')}}" id="task_title" required class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
            <label for="task_description" class="font-bold mb-1 text-gray-700 block">Description</label>
            <textarea type="text" name="task_description" value="{{old('task_description')}}" required class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="task_description"></textarea>
            <label for="projects" class="font-bold mb-1 text-gray-700 block">Projects</label>
            <select name="project_id" class="w-full  p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                @foreach ($projects as $project )
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
            <label for="tags" class="font-bold mb-1 text-gray-700 block">Tags</label>
            <select x-cloak id="select" class="w-full hidden p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                @foreach ($tags as $tag )
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <div x-data="dropdown()" x-init="loadOptions()" class="w-full md:w-1/2 flex flex-col items-center mx-auto">
                    <input name="values" type="hidden" x-bind:value="selectedValues()">
                    <div class="inline-block relative w-full">
                        <div class="flex flex-col items-center relative">
                            <div x-on:click="open" class="w-full  svelte-1l8159u">
                                <div class="w-full flex p-1 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                                    <div class="flex flex-auto flex-wrap">
                                        <template x-for="(option,index) in selected" :key="options[option].value">
                                            <div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full text-blue-700 bg-blue-100 border border-blue-300 ">
                                                <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option]" x-text="options[option].text"></div>
                                                <div class="flex flex-auto flex-row-reverse">
                                                    <div x-on:click="remove(index,option)">
                                                        <svg class="fill-current h-6 w-6 " role="button" viewBox="0 0 20 20">
                                                            <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                        c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                        l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                        C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div x-show="selected.length    == 0" class="flex-1">
                                            <input placeholder="Select Tags" name="tags" class="bg-transparent px-2 appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedValues()">
                                        </div>
                                    </div>
                                    <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                                        <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                            <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                L17.418,6.109z" />
                                            </svg></button>
                                        <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                " />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full">
                                <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-gray-200 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj" x-on:click.away="close">
                                    <div class="flex flex-col w-full">
                                        <template x-for="(option,index) in options" :key="option">
                                            <div>
                                                <div class="cursor-pointer w-full border-gray-100 rounded-t  hover:bg-blue-50" @click="select(index,$event)">
                                                    <div x-bind:class="option.selected ? 'border-blue-600' : ''" class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                        <div class="w-full items-center flex">
                                                            <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class="mb-5 w-full">
                    <div class="relative">
                        <label for="due_date" class="font-bold mb-1 text-gray-700 block">Due Date</label>
                        <input type="date" name="due_date" value="{{old('due_date')}}" id="due_date" class="w-full p-2 mt-2 mb-3  pl-4 pr-4 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                    </div>
                </div>
                <div class="mb-5 w-full">
                    <label for="priority" class="font-bold mb-1 text-gray-700 block">Select priority</label>
                    <div class="relative">
                        <select id="priority" name="priority" class="w-full p-2 mt-2 mb-3  pl-4 pr-10 pt-3 pb-[10px] leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200">
                            @foreach ($priorities as $priority)
                            <option value="{{$priority}}">{{ $priority }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="py-3 flex justify-between">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal()">Cancel</button>
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2">Create</button>
            </div>
        </form>
    </div>
</div>