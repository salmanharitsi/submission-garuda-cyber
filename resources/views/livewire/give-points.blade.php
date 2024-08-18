<div class="bg-white shadow-md rounded-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        User
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF"
                                        alt="{{ $user->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 w-1/2 whitespace-nowrap text-sm font-medium">
                            <button wire:click="openModal({{ $user->id }})"
                                class="text-blue-600 border border-blue-600 bg-blue-100 hover:bg-blue-600 hover:text-white transition-all duration-200 px-2 py-1 rounded-xl">
                                Give Points
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div>
                    {{ $users->links() }}
                </div>
                <div class="text-sm text-gray-700">
                    Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open"
        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 transition-opacity">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
            <h2 class="text-lg font-semibold mb-4">Award Points</h2>
            <form wire:submit.prevent="givePoints">
                <div class="mb-4">
                    <label for="pointsAmount" class="block text-sm font-medium text-gray-700">Points Amount</label>
                    <input type="number" id="pointsAmount" wire:model="pointsAmount" min="1"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('pointsAmount')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" wire:click="closeModal"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                        Give Points
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
