<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans flex">

    <aside class="w-72 bg-slate-900 text-white hidden lg:block shadow-xl min-h-screen">
        <div class="p-8 text-2xl font-bold border-b border-slate-800 tracking-tight">
            Artisan<span class="text-orange-500">Connect</span>
        </div>
        <nav class="mt-8 p-4 space-y-3">
                <a href="/artisan/dashboard"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-chart-line mr-3"></i> Vue d'ensemble
                </a>
                <a href="{{ route('artisan.profile.edit') }}"
                    class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                    <i class="fa-solid fa-user-gear mr-3"></i> Modifier Profil
                </a>
                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-briefcase mr-3"></i> Mes Services
                </a>
                <a href="{{ route('artisan.Mon_Portfolio') }}"
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

    <div class="flex-1">
        <header class="bg-white border-b p-4 flex justify-between items-center px-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Paramètres du profil</h2>
                <p class="text-sm text-slate-500 italic">Personnalisez votre vitrine professionnelle</p>
            </div>
            <div class="flex items-center space-x-6">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                    <p class="text-xs text-orange-600 font-semibold">{{ $user->city }}</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff" class="w-12 h-12 rounded-2xl border-2 border-orange-100 shadow-sm">
            </div>
        </header>

        <div class="p-8">
            <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-sm p-10 border border-slate-100">
                <h3 class="text-2xl font-black text-slate-800 mb-8">Modifier mon profil professionnel</h3>

                <form action="{{ route('artisan.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="text-xs text-slate-500 uppercase font-bold mb-3 block tracking-widest">Ma Spécialité</label>
                            <select name="category_id" class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $user->artisanProfile?->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-xs text-slate-500 uppercase font-bold mb-3 block tracking-widest">À propos de moi</label>
                            <textarea name="bio" rows="6"
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none"
                                placeholder="Parlez de votre expérience...">{{ old('bio', $user->artisanProfile?->bio) }}</textarea>
                        </div>

                        <div class="flex gap-4 pt-6">
                            <a href="{{ route('artisan.dashboard') }}"
                                class="flex-1 py-4 text-center text-slate-500 font-bold hover:bg-slate-50 rounded-2xl transition">
                                Annuler
                            </a>
                            <button type="submit"
                                class="flex-1 py-4 bg-orange-500 text-white font-black rounded-2xl shadow-lg shadow-orange-500/30 hover:bg-orange-600 transition uppercase tracking-wider">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>