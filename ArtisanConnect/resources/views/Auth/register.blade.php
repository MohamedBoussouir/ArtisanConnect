<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden mt-10 mb-10">
        <div class="bg-blue-700 p-8 text-center">
            <h1 class="text-3xl font-bold text-white">Artisan<span class="text-orange-500">Connect</span></h1>
            <p class="text-blue-100 mt-2">Créez votre compte en quelques secondes</p>
        </div>

        <div class="p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <label class="relative flex flex-col items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:bg-gray-50 transition has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                        <input type="radio" name="roles" value="client" class="hidden" checked>
                        <i class="fa-solid fa-user text-2xl mb-2 text-gray-400"></i>
                        <span class="text-sm font-bold text-gray-700">Je suis un Client</span>
                    </label>
                    <label class="relative flex flex-col items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:bg-gray-50 transition has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50">
                        <input type="radio" name="roles" value="artisan" class="hidden">
                        <i class="fa-solid fa-tools text-2xl mb-2 text-gray-400"></i>
                        <span class="text-sm font-bold text-gray-700">Je suis un Artisan</span>
                    </label>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nom Complet</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" name="name" required value="{{ old('name') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="Mohammed El Alami">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" name="phone" required value="{{ old('phone') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="06XXXXXXXX">
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="nom@exemple.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ville</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                            <select name="city" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition appearance-none">
                                <option value="">Choisir votre ville</option>
                                <option value="Casablanca">Casablanca</option>
                                <option value="Rabat">Rabat</option>
                                <option value="Marrakech">Marrakech</option>
                                <option value="Tanger">Tanger</option>
                                <option value="Agadir">Agadir</option>
                                <option value="Fès">Fès</option>
                                <option value="Meknès">Meknès</option>
                                <option value="Oujda">Oujda</option>
                                <option value="Kenitra">Kenitra</option>
                                <option value="Tetouan">Tetouan</option>
                                <option value="Safi">Safi</option>
                                <option value="El Jadida">El Jadida</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmation</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-shield-check"></i>
                            </span>
                            <input type="password" name="password_confirmation" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" required class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label class="ml-2 text-xs text-gray-600 italic">
                        J'accepte les conditions d'utilisation d'ArtisanConnect.
                    </label>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.01]">
                    Créer mon compte
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Déjà inscrit ? 
                    <a href="/login" class="font-bold text-blue-700 hover:underline">Connectez-vous</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>