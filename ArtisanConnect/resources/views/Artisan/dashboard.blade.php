<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Artisan - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-slate-900 text-white hidden lg:block shadow-xl">
            <div class="p-8 text-2xl font-bold border-b border-slate-800 tracking-tight">
                Artisan<span class="text-orange-500">Connect</span>
            </div>
            <nav class="mt-8 p-4 space-y-3">
                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                    <i class="fa-solid fa-chart-line mr-3"></i> Vue d'ensemble
                </a>
                <a href="{{ route('artisan.profile.edit') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-user-gear mr-3"></i> Modifier Profil
                </a>
                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-briefcase mr-3"></i> Mes Services
                </a>
                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-images mr-3"></i> Mon Portfolio
                </a>
                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-star mr-3"></i> Avis Clients
                </a>
                <div class="pt-10">
                    <a href="/logout"
                        class="flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-500/10 transition">
                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 lg:ml-0">
            <header class="bg-white border-b p-4 flex justify-between items-center px-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Tableau de bord Artisan</h2>
                    <p class="text-sm text-slate-500 italic">Gérez votre visibilité et vos demandes</p>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                        <p class="text-xs text-orange-600 font-semibold">{{ $user->city }}</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff"
                        class="w-12 h-12 rounded-2xl border-2 border-orange-100 shadow-sm">
                </div>
            </header>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <div
                            class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4">
                            <i class="fa-solid fa-eye text-xl"></i>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Vues du profil</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-1">{{ number_format($stats['views']) }}</h4>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <div
                            class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4">
                            <i class="fa-solid fa-star text-xl"></i>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Note Moyenne</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['rating'] }} <span
                                class="text-sm font-normal text-slate-400">/5</span></h4>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <div
                            class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-4">
                            <i class="fa-solid fa-check-double text-xl"></i>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Réalisations</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['rating'] }}</h4>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <div
                            class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-4">
                            <i class="fa-solid fa-comments text-xl"></i>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Nouveaux Avis</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-1">{{ $stats['new_reviews'] }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-slate-100">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-lg font-bold text-slate-800">Mon Profil Professionnel</h3>
                        <a href="{{ route('artisan.profile.edit') }}"
                            class="text-blue-600 text-sm font-bold hover:underline">
                            Modifier
                        </a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-slate-50 rounded-2xl">
                            <div class="w-10 text-blue-500 text-xl">
                                <i class="fa-solid {{ $user->artisanProfile->category->icon ?? 'fa-wrench' }}"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase font-semibold">Métier / Spأcialit</p>
                                <p class="font-bold text-slate-800">
                                    {{ $user->artisanProfile->category->name ?? 'Non dfini' }}
                                </p>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-2xl">
                            <p class="text-xs text-slate-500 uppercase mb-2 font-semibold"> propos de moi</p>
                            <p class="text-sm text-slate-700 leading-relaxed">
                                {{ $user->artisanProfile->bio ?? 'Vous n\'avez pas encore ajoutأ de description. Prأsentez vos compأtences pour attirer plus de clients !' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-6">Portfolio Récent</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div
                            class="aspect-square bg-slate-100 rounded-2xl border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 hover:border-orange-500 hover:text-orange-500 cursor-pointer transition">
                            <i class="fa-solid fa-plus text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl shadow-lg p-8 text-white">
                    <h3 class="font-bold text-xl mb-2">Visibilité Premium</h3>
                    <p class="text-orange-100 text-sm mb-6">Boostez votre profil pour apparaître en tête des recherches
                        à {{ $user->city }}.</p>
                    <button
                        class="w-full py-3 bg-white text-orange-600 font-bold rounded-xl shadow-sm hover:bg-orange-50 transition">
                        En savoir plus
                    </button>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-4">Informations de contact</h3>
                    <div class="space-y-3">
                        <p class="text-sm text-slate-600"><i class="fa-solid fa-phone mr-2 text-blue-500"></i>
                            {{ $user->phone }}</p>
                        <p class="text-sm text-slate-600"><i class="fa-solid fa-envelope mr-2 text-blue-500"></i>
                            {{ $user->email }}</p>
                        <p class="text-sm text-slate-600"><i class="fa-solid fa-location-dot mr-2 text-blue-500"></i>
                            {{ $user->city }}</p>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </main>
    </div>

</body>

</html>
