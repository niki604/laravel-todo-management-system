@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ route('create-todo') }}" class="max-w-sm mx-auto">
        @csrf
        <div class="max-w-md mx-auto">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <input type="hidden" name="task_id" value="{{ isset($task) ? $task->id : '' }}" />
                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        @if (isset(Auth::user()->type) && Auth::user()->type != 'admin') readonly @endif
                        value="{{ isset($task) ? $task->title : old('title') }}" id="title" name="title"
                        maxlength="50" type="text" placeholder="Enter title" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <!-- Replace this with your preferred rich text editor component -->
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="10" maxlength="500" @if (isset(Auth::user()->type) && Auth::user()->type != 'admin') readonly @endif id="description" name="description"
                        required placeholder="Enter description">{{ isset($task) ? $task->description : old('description') }}</textarea>
                </div>
                @if (isset(Auth::user()->type) && Auth::user()->type == 'admin')
                    <!-- Assigned To -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="assigned-to">
                            Assigned To
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required name="user_id" id="assigned-to">
                            <option>Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if (isset($task) && $user->id == $task->user_id) selected @endif>
                                    {{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <!-- Status -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required id="status" name="status">
                        <option>Select a status</option>
                        <!-- Add options for status dynamically or manually -->
                        @if (isset(Auth::user()->type) && Auth::user()->type == 'admin')
                            <option value="Open" @if (isset($task) && 'Open' == $task->status) selected @endif>Open</option>
                        @endif
                        <option value="InProgress" @if (isset($task) && 'InProgress' == $task->status) selected @endif>In Progress</option>
                        <option value="Completed" @if (isset($task) && 'Completed' == $task->status) selected @endif>Completed</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>

    </form>
@stop
