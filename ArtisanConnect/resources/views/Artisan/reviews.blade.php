<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Avis - ArtisanConnect</title>
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
                <a href="/artisan/dashboard"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-chart-line mr-3"></i> Vue d'ensemble
                </a>
                <a href="{{ route('artisan.bookings') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-calendar-check mr-3"></i> Mes Réservations
                </a>
                <a href="{{ route('artisan.services.index') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-briefcase mr-3"></i> Mes Services
                </a>
                <a href="{{ route('artisan.Mon_Portfolio') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-images mr-3"></i> Mon Portfolio
                </a>
                <a href="{{ route('artisan.reviews') }}"
                    class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                    <i class="fa-solid fa-star mr-3 text-orange-400"></i>
                    Avis Clients
                </a>
                <div class="pt-10 border-t border-slate-50">
                    <a href="{{ route('artisan.profile') }}"
                        class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-800 hover:text-blue-400 transition font-medium">
                        <i class="fa-solid fa-user-gear mr-3"></i> Mon Profil
                    </a>
                    <a href="/"
                        class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium mb-2">
                        <i class="fa-solid fa-house mr-3 text-sm"></i>
                        Retour au site
                    </a>
                    <a href="/logout"
                        class="flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-500/10 transition font-medium">
                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white border-b p-4 flex justify-between items-center px-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Gestion des Avis</h2>
                    <p class="text-sm text-slate-500 italic">Consultez et gérez les retours de vos clients</p>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-orange-600 font-semibold italic">Note:
                            {{ auth()->user()->averageRating() }}/5</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=f97316&color=fff"
                        class="w-12 h-12 rounded-2xl border-2 border-orange-100 shadow-sm">
                </div>
            </header>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600">
                            <i class="fa-solid fa-star text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase">Moyenne</p>
                            <h4 class="text-xl font-black text-slate-800">{{ auth()->user()->averageRating() }} / 5</h4>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                            <i class="fa-solid fa-comments text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase">Total Avis</p>
                            <h4 class="text-xl font-black text-slate-800">{{ $reviews->count() }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800 uppercase tracking-tighter italic">Historique des
                            avis</h3>
                    </div>

                    <div class="divide-y divide-slate-50">
                        @forelse($reviews as $review)
                            <div class="p-8 hover:bg-slate-50 transition-colors">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex items-center md:items-start gap-4 md:w-48 flex-shrink-0">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-sm">
                                            {{ substr($review->client?->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-slate-800 text-sm">{{ $review->client?->name }}
                                            </h5>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                                {{ $review->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex text-orange-400 text-[10px] mb-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'opacity-20' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="bg-slate-50/50 p-5 rounded-[2rem] border border-slate-100 relative">
                                            <i
                                                class="fa-solid fa-quote-left absolute -top-2 -left-2 text-slate-200 text-2xl"></i>
                                            <p class="text-slate-600 text-sm italic leading-relaxed">
                                                "{{ $review->comment }}"
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex md:flex-col justify-end gap-2">
                                        <button
                                            class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-blue-600 hover:bg-blue-50 rounded-xl transition">
                                            Signaler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-20 text-center">
                                <div
                                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200 text-3xl">
                                    <i class="fa-solid fa-comment-slash"></i>
                                </div>
                                <p class="text-slate-400 italic">Aucun avis reçu pour le moment.</p>
                            </div>
                        @endforelse
                    </div>

                    @if ($reviews->hasPages())
                        <div class="p-6 border-t border-slate-50">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

</body>

</html>
