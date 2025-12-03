<!-- filepath: /c:/xampp/htdocs/moonlit/resources/views/profile/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div style="background-color: #f0f4f8;">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
    <div class="bg-white shadow sm:rounded-lg p-6 flex flex-col items-center">
        <!-- Centered Content -->
        @livewire('profile.update-profile-information-form')
        <x-section-border />
    </div>
    @endif



            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="bg-white shadow sm:rounded-lg p-6 mt-6">
                    @livewire('profile.update-password-form')
                </div>

            @endif

            <div class="bg-white shadow sm:rounded-lg p-6 mt-6">
                <h2 class="text-xl font-semibold mb-4">My Bookings</h2>

                @if($bookings->isEmpty())
                    <p class="text-gray-500">You have no bookings at the moment.</p>
                @else
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">#</th>
                                <th class="border border-gray-300 px-4 py-2">Room ID</th>
                                <th class="border border-gray-300 px-4 py-2">Room Type</th>
                                <th class="border border-gray-300 px-4 py-2">Check-In Date</th>
                                <th class="border border-gray-300 px-4 py-2">Check-Out Date</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr class="even:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $booking->room_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $booking->room_type }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $booking->check_in_date }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $booking->check_out_date }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <!-- Cancel Booking Button -->
                                        <form action="{{ route('profile.cancelBooking', $booking->booking_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Cancel Booking</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="bg-white shadow sm:rounded-lg p-6 mt-6">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

        </div>
    </div>



</x-app-layout>
