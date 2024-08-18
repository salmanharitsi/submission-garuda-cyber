<div>
    <div class="bg-white shadow-md rounded-lg">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Points Giver
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        User
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Amount
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($points as $point)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($point->giver->name) }}&color=7F9CF5&background=EBF4FF"
                                        alt="{{ $point->giver->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $point->giver->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $point->giver->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 w-1/2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($point->user->name) }}&color=68D391&background=F0FFF4"
                                        alt="{{ $point->user->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $point->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $point->user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                + {{ $point->amount }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                {{ $point->created_at->format('d-m-Y H:i') }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            No points history found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div>
                    {{ $points->links() }}
                </div>
                <div class="text-sm text-gray-700">
                    Page {{ $points->currentPage() }} of {{ $points->lastPage() }}
                </div>
            </div>
        </div>
    </div>
</div>
