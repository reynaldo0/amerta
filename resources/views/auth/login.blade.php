<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Amerta Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Noto Serif', serif;
            background: linear-gradient(135deg, #8B4513, #D4B896);
        }
        
        .logo-text {
            background: linear-gradient(45deg, #8B4513, #CD853F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .cultural-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(139, 69, 19, 0.1);
        }
        
        .cultural-input:focus {
            border-color: #8B4513;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }
        
        .cultural-btn {
            background: linear-gradient(135deg, #8B4513, #CD853F);
            transition: all 0.3s ease;
        }
        
        .cultural-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 69, 19, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md cultural-card rounded-2xl p-8 shadow-xl">
        <!-- Logo and Brand -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-semibold logo-text">Amerta</h1>
            <p class="text-gray-600 text-sm mt-1">Admin Panel</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded-lg mb-6 text-sm">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg cultural-input focus:outline-none transition-all"
                       placeholder="Enter your email"
                       required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg cultural-input focus:outline-none transition-all"
                       placeholder="Enter your password"
                       required>
            </div>

            <button type="submit" class="w-full cultural-btn text-white py-3 rounded-lg font-medium">
                Sign In
            </button>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-6 pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                New to Amerta?
                <a href="{{ route('register') }}" class="text-yellow-700 hover:text-yellow-800 font-medium hover:underline ml-1">
                    Create Account
                </a>
            </p>
        </div>
    </div>

</body>
</html>