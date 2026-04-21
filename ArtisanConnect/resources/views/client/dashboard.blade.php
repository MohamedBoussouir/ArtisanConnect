<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-white hidden md:block shadow-2xl">
        <div class="p-8 text-2xl font-bold border-b border-slate-800">
            Artisan<span class="text-orange-500">Connect</span>
        </div>
        <nav class="mt-8 p-4 space-y-3">
            <a href="#" class="flex items-center py-3 px-4 rounded-2xl bg-orange-500 text-white shadow-lg shadow-orange-500/20 transition">
                <i class="fa-solid fa-house mr-3"></i> Mon Espace
            </a>
            <a href="/artisans" class="flex items-center py-3 px-4 rounded-2xl text-slate-400 hover:bg-slate-800 hover:text-white transition">
                <i class="fa-solid fa-magnifying-glass mr-3"></i> Trouver un Artisan
            </a>
            <a href="#" class="flex items-center py-3 px-4 rounded-2xl text-slate-400 hover:bg-slate-800 hover:text-white transition">
                <i class="fa-solid fa-heart mr-3"></i> Mes Favoris
            </a>
            <div class="pt-10">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="w-full flex items-center py-3 px-4 rounded-2xl text-red-400 hover:bg-red-500/10 transition">
                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b p-6 flex justify-between items-center px-10">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Bonjour, {{ $user->name }} 👋</h2>
                <p class="text-slate-400 text-sm font-medium">Content de vous revoir dans votre espace.</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800 leading-none">{{ $user->name }}</p>
                    <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest">Client Membre</span>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff" 
                     class="w-12 h-12 rounded-2xl border-2 border-orange-100 shadow-sm">
            </div>
        </header>

        <div class="p-10 space-y-10">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-comment-dots text-xl"></i>
                    </div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Avis Donnés</p>
                    <p class="text-3xl font-black text-slate-800 mt-2">12</p>
                </div>
                
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-heart text-xl"></i>
                    </div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Artisans Favoris</p>
                    <p class="text-3xl font-black text-slate-800 mt-2">5</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-map-pin text-xl"></i>
                    </div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Ville</p>
                    <p class="text-3xl font-black text-slate-800 mt-2">{{ $user->city ?? 'Maroc' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Informations Personnelles</h3>
                    <a href="#" class="text-orange-500 font-bold text-sm hover:underline">Modifier</a>
                </div>
                <div class="p-8 grid md:grid-cols-2 gap-10">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase">Nom Complet</p>
                        <p class="text-slate-700 font-bold">{{ $user->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase">Email</p>
                        <p class="text-slate-700 font-bold">{{ $user->email }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase">Téléphone</p>
                        <p class="text-slate-700 font-bold">{{ $user->phone ?? 'Non spécifié' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase">Membre depuis</p>
                        <p class="text-slate-700 font-bold">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-orange-500 rounded-3xl p-8 text-white flex justify-between items-center shadow-lg shadow-orange-500/20">
                <div>
                    <h4 class="text-xl font-black mb-1">Besoin d'un service aujourd'hui ?</h4>
                    <p class="text-orange-100 opacity-80 text-sm font-medium">Découvrez les meilleurs artisans notés dans votre ville.</p>
                </div>
                <a href="/artisans" class="bg-white text-orange-500 px-8 py-3 rounded-2xl font-black text-sm uppercase hover:bg-slate-900 hover:text-white transition">
                    Explorer
                </a>
            </div>

        </div>
    </main>
</body>

</html>