@extends('layouts.master')

@section('content')
    <div class="flex w-full justify-between py-9">
        <h1 class="text-2xl font-bold">{{ $project->name }}</h1>
    </div>

    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden mt-10">
        <table class="min-w-full leading-normal bg-white">
            <x-layouts.tabletitles />
            
            <tbody>
                @forelse($project->tasks as $task)
                    <x-layouts.table-row 
                        :task="$task" 
                        :priorities="$priorities" 
                        :tags="$tags" 
                    />
                @empty
                    <tr>
                        <td colspan="9" class="px-5 py-5 text-bold">
                            <span class="font-bold">{{ $project->name }}</span> does not have any tasks yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection