@extends('layouts.master')

@section('content')
<div class="flex w-full justify-between py-9">
    <h1 class="text-3xl font-bold">Tasks</h1>
    <x-search />
</div>
<x-newtask :priorities="$priorities" :tags="$tags" :projects="$projects"></x-newtask>

<div class="bg-white rounded-lg shadow overflow-hidden mt-10">
    <table class="min-w-full divide-y divide-gray-200">
        <x-layouts.tabletitles />
        <tbody class="divide-y divide-gray-200">
            @forelse($tasks as $task)
            <x-layouts.table-row :task="$task" :priorities="$priorities" :tags="$tags" />
            @empty
            <tr>
                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                    No tasks found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $tasks->links() }}
    </div>
</div>
<script>
    function dropdown() {
            return {
                options: [],
                selected: [],
                show: false,
                open() { this.show = true },
                close() { this.show = false },
                isOpen() { return this.show === true },
                select(index, event) {

                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);


                },
                loadOptions() {
                    const options = document.getElementById('select').options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                            value: options[i].value,
                            text: options[i].innerText,
                            selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                        });
                    }


                },
                selectedValues(){
                    return this.selected.map((option)=>{
                        return this.options[option].value;
                    })
                }
            }
        }

</script>
@endsection