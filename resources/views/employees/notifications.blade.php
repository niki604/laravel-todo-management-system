@extends('layouts.master')

@section('content')



    @forelse ($notificationData as $data)
        <div class="max-w-md mx-auto mt-6">
            <div id="notification" class="rounded-md bg-white shadow-md p-4 mt-4">
                <!-- Notification Content -->
                <div class="flex items-center">
                    <!-- Icon -->
                    <a href="{{ route('edit-todo', ['id' => $data->id]) }}">
                        <div class="ml-4">
                            <p class="text-gray-800 font-semibold">{{ $data->notification }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="max-w-md mx-auto mt-6">
            <div id="notification" class="rounded-md bg-white shadow-md p-4 mt-4">
                <!-- Notification Content -->
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="ml-4">
                        <p class="text-gray-800 font-semibold">No notifications yet.</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse



@stop
