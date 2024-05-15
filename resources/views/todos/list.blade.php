@extends('layouts.master')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-12 p-12">
        @if (isset(Auth::user()->type) && Auth::user()->type == 'admin')
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 text-right">
                <div>
                    <a type="button" href="{{ route('add-todo') }}"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Add</a>
                </div>
            </div>
        @endif
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Assigned to
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($taskList as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->status }}
                        </td>
                        <td class="px-6 py-4 ">

                            <a href="{{ route('edit-todo', ['id' => $item->id]) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>


                            @if (isset(Auth::user()->type) && Auth::user()->type == 'admin')
                                /
                                <form method="POST" action="{{ route('delete-todo', ['id' => $item->id]) }}">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</a>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 whitespace-nowrap">
                            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
                                <p class="text-gray-700 font-bold text-xl mb-6">No Result Found</p>
                                <!-- You can add additional message or instructions here -->
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@stop
