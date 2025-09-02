<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-blue-300"
                       required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-blue-300"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </div>
</body>
</html>
