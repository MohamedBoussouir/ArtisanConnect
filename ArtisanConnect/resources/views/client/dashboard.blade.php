<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-800 text-white hidden md:block">
            <div class="p-6 text-2xl font-bold border-b border-blue-700">
                Artisan<span class="text-orange-400">Connect</span>
            </div>
            <nav class="mt-6 p-4 space-y-2">
                <a href="#" class="block py-2.5 px-4 rounded bg-blue-900 transition"><i class="fa-solid fa-gauge mr-2"></i> Dashboard</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition"><i class="fa-solid fa-user-pen mr-2"></i> Mon Profil</a>
                @if($user->roles == 'artisan')
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition"><i class="fa-solid fa-images mr-2"></i> Mon Portfolio</a>
                @endif
                <a href="/logout" class="block py-2.5 px-4 rounded hover:bg-red-600 mt-10 transition text-red-200"><i class="fa-solid fa-right-from-bracket mr-2"></i> Déconnexion</a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Bienvenue, {{ $user->name }}</h2>
                <div class="flex items-center space-x-4">
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded uppercase">{{ $user->roles }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1E3A8A&color=fff" class="w-10 h-10 rounded-full border">
                </div>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-600">
                        <p class="text-sm text-gray-500 uppercase font-bold">Statut du Compte</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">Actif</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-orange-500">
                        <p class="text-sm text-gray-500 uppercase font-bold">Ville actuelle</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $user->city ?? 'Non définie' }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500">
                        <p class="text-sm text-gray-500 uppercase font-bold">Contact</p>
                        <p class="text-lg font-bold text-gray-800 mt-1">{{ $user->phone }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 pb-2 border-b">Informations Générales</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Nom Complet</p>
                            <p class="font-medium text-gray-800">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Adresse Email</p>
                            <p class="font-medium text-gray-800">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Inscrit depuis</p>
                            <p class="font-medium text-gray-800">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Rôle</p>
                            <p class="font-medium text-blue-700 capitalize">{{ $user->roles }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <a href="#" class="bg-blue-700 text-white px-6 py-2 rounded-xl hover:bg-blue-800 transition shadow-md">
                            Modifier mon profil
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>