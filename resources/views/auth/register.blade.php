<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-blue-300"
                       required>
            </div>

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

            <div>
                <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-blue-300"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
        </p>
    </div>
</body>
</html>
