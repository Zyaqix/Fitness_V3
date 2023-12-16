<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <p class="text-lg mb-4">
                    Welcome to the Zyzz Playlist Recommendation Dashboard! This playlist is perfect for your workout sessions, providing the energy and motivation you need to crush it in the gym.
                </p>
                <p class="text-lg mb-4">
                    Feel the beats, embrace the pump, and let Zyzz guide you through an epic training experience.
                </p>

                <!-- Link to the Zyzz playlist on YouTube -->
                <div class="mb-6">
                    <a href="https://www.youtube.com/playlist?list=YOUR_PLAYLIST_ID" style="color: blue; text-decoration: underline;" target="_blank" class="text-blue-500 hover:underline text-lg font-bold underline">
                        🎧 Open Zyzz Playlist on YouTube 🎧
                    </a>
                </div>

                <p class="text-lg">
                    Keep pushing your limits, and remember: "We're all gonna make it, brah!" 💪
                </p>
            </div>
        </div>
    </div>
</x-app-layout>