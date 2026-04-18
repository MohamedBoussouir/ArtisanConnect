<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans flex">

    <aside class="w-72 bg-slate-900 text-white hidden lg:block shadow-xl min-h-screen">
        <div class="p-8 text-2xl font-bold border-b border-slate-800 tracking-tight">
            Artisan<span class="text-orange-500">Connect</span>
        </div>
        <nav class="mt-8 p-4 space-y-3">
            <a href="/artisan/dashboard" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-chart-line mr-3"></i> Vue d'ensemble
            </a>
            <a href="{{ route('artisan.profile.edit') }}" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-user-gear mr-3"></i> Modifier Profil
            </a>
            <a href="/artisan/portfolio" class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                <i class="fa-solid fa-images mr-3"></i> Mon Portfolio
            </a>
            <div class="pt-10">
                <a href="/logout" class="flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-500/10 transition">
                    <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1">
        <header class="bg-white border-b p-4 flex justify-between items-center px-8">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-wide">Gestion du Portfolio</h2>
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-slate-600">{{ Auth::user()->name }}</span>
                <div class="w-10 h-10 rounded-full bg-orange-100 border-2 border-orange-500"></div>
            </div>
        </header>

        <div class="p-8 space-y-8">
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6"><i class="fa-solid fa-plus-circle text-orange-500 mr-2"></i> Ajouter une réalisation</h3>
                
                <form action="{{ route('artisan.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @csrf
                    <div class="md:col-span-1">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2">Titre du projet</label>
                        <input type="text" name="title" required placeholder="Ex: Installation Cuisine" 
                               class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition">
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2">Image de réalisation</label>
                        <input type="file" name="image" required 
                               class="w-full p-3 bg-slate-50 rounded-2xl border-none text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200">
                    </div>
                    <div class="md:col-span-1 flex items-end">
                        <button type="submit" class="w-full py-4 bg-slate-900 text-white font-black rounded-2xl hover:bg-orange-600 transition shadow-lg">
                            Télécharger l'image
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($portfolios as $work)
                <div class="group relative bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('storage/' . $work->image_path) }}" alt="{{ $work->title }}" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
                        <h4 class="text-white font-bold text-lg">{{ $work->title }}</h4>
                        <p class="text-slate-300 text-xs mb-4">{{ $work->created_at->format('d M Y') }}</p>
                        
                        <form action="{{ route('artisan.portfolio.destroy', $work->id) }}" method="POST" onsubmit="return confirm('Supprimer ce travail ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2 bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/50 rounded-xl text-xs font-black transition">
                                <i class="fa-solid fa-trash-can mr-2"></i> SUPPRIMER
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            @if($portfolios->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                <i class="fa-solid fa-images text-5xl text-slate-200 mb-4"></i>
                <p class="text-slate-400 font-bold">Votre portfolio</p>
            </div>
            @endif
        </div>
    </main>
</body>
</html>