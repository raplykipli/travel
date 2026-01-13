<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>Keystour Travel - Login</title>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-400 opacity-10 rounded-full blur-3xl"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-cyan-300 opacity-10 rounded-full blur-3xl">
        </div>
    </div>

    <div class="relative w-full max-w-5xl flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
        <!-- Left Side - Branding -->
        <div class="flex-1 text-white text-center lg:text-left space-y-6 z-10">
            <div class="float-animation">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm mb-4">
                    <i class="fas fa-plane-departure text-4xl text-white"></i>
                </div>
            </div>
            <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                Welcome to<br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-cyan-200">
                    Keystour Travel
                </span>
            </h1>
            <p class="text-lg text-blue-100 max-w-md mx-auto lg:mx-0">
                Explore the world with us. Your journey begins with a simple login.
            </p>
            <div class="flex items-center justify-center lg:justify-start gap-8 pt-4">
                <div class="text-center">
                    <p class="text-3xl font-bold">5,892</p>
                    <p class="text-sm text-blue-200">Happy Travelers</p>
                </div>
                <div class="w-px h-12 bg-white bg-opacity-30"></div>
                <div class="text-center">
                    <p class="text-3xl font-bold">34+</p>
                    <p class="text-sm text-blue-200">Tour Packages</p>
                </div>
                <div class="w-px h-12 bg-white bg-opacity-30"></div>
                <div class="text-center">
                    <p class="text-3xl font-bold">4.9</p>
                    <p class="text-sm text-blue-200">Rating</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full max-w-md z-10">
            <div class="glass-effect rounded-3xl shadow-2xl p-8 lg:p-10">
                <!-- Logo & Title -->
                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-2xl mb-4">
                        <i class="fas fa-user-lock text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back!</h3>
                    <p class="text-gray-500">Please login to your account</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="email">
                            <i class="fas fa-envelope mr-2 text-blue-600"></i>Email Address
                        </label>
                        <div class="relative">
                            <input type="email" name="email" id="email" placeholder="Enter your email"
                                value="{{ old('email') }}" required
                                class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-300 bg-gray-50 hover:bg-white">
                            <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="password">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Enter your password"
                                required
                                class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-300 bg-gray-50 hover:bg-white">
                            <i class="fas fa-key absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full py-3 px-6 text-white font-semibold rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transform hover:scale-105 transition duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login Now
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center text-white text-sm mt-6 opacity-80">
                <i class="fas fa-shield-alt mr-1"></i>
                Your data is secured with 256-bit encryption
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add input animation
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });
        });
    </script>
</body>

</html>
