<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-slate-200 hidden lg:block shadow-sm">
            <div class="p-8 text-2xl font-black text-blue-700 tracking-tight">
                Artisan<span class="text-orange-500">Connect</span>
            </div>

            <nav class="mt-4 p-4 space-y-2">
                <a href="{{ route('client.dashboard') }}"
                    class="flex items-center py-3 px-4 rounded-xl {{ request()->routeIs('client.dashboard') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium' }}">
                    <i class="fa-solid fa-house-chimney mr-3"></i> Vue d'ensemble
                </a>

                <a href="{{ route('client.bookings') }}"
                    class="flex items-center py-3 px-4 rounded-xl {{ request()->routeIs('client.bookings') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium' }}">
                    <i class="fa-solid fa-calendar-days mr-3"></i> Mes Réservations
                </a>

                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-heart mr-3"></i> Artisans Favoris
                </a>

                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-message mr-3"></i> Messages
                </a>

                <div class="pt-8 pb-4">
                    <p class="px-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Paramètres</p>
                </div>

                <a href="/profile/settings"
                    class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-user-gear mr-3"></i> Mon Profil
                </a>

                <a href="{{ route('logout') }}"
                    class="w-full flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-50 transition font-medium group">
                    <i class="fa-solid fa-power-off mr-3 group-hover:rotate-12 transition"></i>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white border-b border-slate-200 p-6 flex justify-between items-center px-10">
                <div>
                    <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Mes Réservations</h2>
                    <p class="text-xs text-slate-400 font-medium">Gérez vos demandes de services</p>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="relative w-10 h-10 flex items-center justify-center bg-slate-50 rounded-xl text-slate-500 hover:bg-slate-100 transition">
                        <i class="fa-solid fa-bell"></i>
                        <span
                            class="absolute top-2 right-2 w-2 h-2 bg-orange-500 rounded-full border-2 border-white"></span>
                    </button>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1E3A8A&color=fff"
                        class="w-10 h-10 rounded-xl border-2 border-white shadow-sm">
                </div>
            </header>

            <div class="p-10">
                <div class="space-y-6">
                    <div class="flex justify-between items-center px-2">
                        <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tighter">Historique des
                            services</h3>
                    </div>

                    @forelse($bookings as $booking)
                        <div
                            class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 bg-slate-900 text-white rounded-3xl flex flex-col items-center justify-center shadow-lg shadow-slate-200">
                                    <span
                                        class="text-[8px] font-black uppercase opacity-60">{{ \Carbon\Carbon::parse($booking->appointment_date)->translatedFormat('M') }}</span>
                                    <span
                                        class="text-xl font-black italic">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('d') }}</span>
                                </div>

                                <div>
                                    <h4 class="font-black text-slate-800 uppercase italic leading-none">
                                        {{ $booking->service->title }}</h4>
                                    <p class="text-xs text-slate-400 mt-2 font-medium italic tracking-tight">
                                        Artisan: <span
                                            class="text-blue-600 font-bold underline">{{ $booking->artisan->name }}</span>
                                    </p>
                                    <p class="text-[10px] text-slate-500 mt-1 font-bold">
                                        <i class="fa-solid fa-clock text-orange-500 mr-1"></i>
                                        {{ $booking->appointment_time }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                                <span
                                    class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest 
                                @if ($booking->status == 'pending') bg-orange-100 text-orange-600 
                                @elseif($booking->status == 'accepted') bg-green-100 text-green-600 
                                @else bg-red-100 text-red-600 @endif">
                                    {{ $booking->status }}
                                </span>

                                @if ($booking->status === 'pending')
                                    <form action="{{ route('client.bookings.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center text-[10px] font-black text-red-500 uppercase hover:text-red-700 transition">
                                            <i class="fa-solid fa-circle-xmark mr-1"></i>
                                            Annuler la demande
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-white rounded-[3rem] border-4 border-dashed border-slate-50">
                            <i class="fa-solid fa-calendar-xmark text-5xl text-slate-200 mb-4"></i>
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Aucune réservation
                                trouvée</p>
                            <a href="/"
                                class="inline-block mt-4 text-blue-600 font-black text-[10px] uppercase underline">Chercher
                                un artisan</a>
                        </div>
                    @endforelse

                </div>
            </div>
        </main>
    </div>

</body>

</html>
