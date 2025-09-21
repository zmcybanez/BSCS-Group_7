@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                    <h1 class="text-3xl font-bold text-gray-800">Friends & Network</h1>
                </div>
                <div class="text-sm text-gray-600">
                    Connect with fellow farmers and grow your network
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Current Friends -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-friends text-green-600 mr-2"></i>
                    My Friends ({{ $friends->count() }})
                </h2>

                @if($friends->count() > 0)
                    <div class="space-y-3">
                        @foreach($friends as $friend)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($friend->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">{{ $friend->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $friend->farm_type ?? 'Agricultural Enthusiast' }}</p>
                                </div>
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm transition-colors">
                                <i class="fas fa-comment mr-1"></i> Chat
                            </button>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-user-plus text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-600 mb-4">You don't have any friends yet.</p>
                        <p class="text-sm text-gray-500">Start by searching for farmers to connect with!</p>
                    </div>
                @endif
            </div>

            <!-- Friend Requests -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-clock text-orange-600 mr-2"></i>
                    Friend Requests ({{ $friendRequests->count() }})
                </h2>

                @if($friendRequests->count() > 0)
                    <div class="space-y-3">
                        @foreach($friendRequests as $request)
                        <div class="p-3 bg-orange-50 border-l-4 border-orange-400 rounded-r-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($request->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $request->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $request->farm_type ?? 'Agricultural Enthusiast' }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <form method="POST" action="{{ route('friends.accept') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $request->UserID }}">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm transition-colors">
                                            <i class="fas fa-check mr-1"></i> Accept
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('friends.reject') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $request->UserID }}">
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition-colors">
                                            <i class="fas fa-times mr-1"></i> Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-600 mb-2">No pending friend requests</p>
                        <p class="text-sm text-gray-500">You're all caught up!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Find New Friends Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-search text-blue-600 mr-2"></i>
                Find Friends
            </h2>
            <div class="flex space-x-4">
                <input type="text" placeholder="Search farmers, topics, or locations..."
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-green-500 text-white rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Total Friends</p>
                        <p class="text-2xl font-bold">{{ $friends->count() }}</p>
                    </div>
                    <i class="fas fa-users text-3xl text-green-300"></i>
                </div>
            </div>
            <div class="bg-orange-500 text-white rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100">Pending Requests</p>
                        <p class="text-2xl font-bold">{{ $friendRequests->count() }}</p>
                    </div>
                    <i class="fas fa-clock text-3xl text-orange-300"></i>
                </div>
            </div>
            <div class="bg-blue-500 text-white rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Network Score</p>
                        <p class="text-2xl font-bold">{{ $friends->count() * 10 }}%</p>
                    </div>
                    <i class="fas fa-chart-line text-3xl text-blue-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
    <i class="fas fa-check-circle mr-2"></i>
    {{ session('success') }}
</div>
@endif

<script>
// Auto-hide success messages
setTimeout(function() {
    const successMsg = document.querySelector('.fixed.bottom-4');
    if (successMsg) {
        successMsg.style.opacity = '0';
        setTimeout(() => successMsg.remove(), 300);
    }
}, 3000);
</script>
@endsection
