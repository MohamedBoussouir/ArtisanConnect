<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - ArtisanConnect</title>
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
                    class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                    <i class="fa-solid fa-calendar-check mr-3"></i> Mes Réservations
                </a>
                <a href="{{ route('artisan.profile.edit') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-user-gear mr-3"></i> Modifier Profil
                </a>
                <a href="{{ route('artisan.services.index') }}"
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

        <main class="flex-1 lg:ml-0">
            <header class="bg-white border-b p-4 flex justify-between items-center px-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 uppercase tracking-tighter italic">Demandes
                        d'Intervention</h2>
                    <p class="text-sm text-slate-500 italic">Consultez et répondez aux besoins de ваших clients</p>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <span
                            class="text-[10px] bg-green-100 text-green-600 px-2 py-0.5 rounded-md font-black uppercase">En
                            Ligne</span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1e293b&color=fff"
                        class="w-12 h-12 rounded-2xl border-2 border-slate-100 shadow-sm">
                </div>
            </header>

            <div class="p-8">
    <div class="space-y-6">
        @forelse($incomingBookings as $booking)
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 relative overflow-hidden group hover:shadow-xl transition-all duration-300 
                {{ $booking->status == 'pending' ? 'border-l-8 border-l-orange-500 shadow-orange-50' : '' }}">
                
                @if($booking->status == 'pending')
                    <span class="absolute top-6 left-6 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                    </span>
                @endif

                <div class="absolute top-0 right-10">
                    <span class="px-4 py-1.5 rounded-b-2xl text-[9px] font-black uppercase tracking-widest 
                        {{ $booking->status == 'pending' ? 'bg-orange-100 text-orange-600' : ($booking->status == 'accepted' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') }}">
                        {{ $booking->status }}
                    </span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="bg-slate-900 text-white p-5 rounded-[2rem] text-center min-w-[100px] shadow-lg {{ $booking->status == 'pending' ? 'ring-4 ring-orange-500/20' : '' }}">
                        <p class="text-[10px] font-black uppercase opacity-60 tracking-widest">
                            {{ \Carbon\Carbon::parse($booking->appointment_date)->translatedFormat('M') }}
                        </p>
                        <p class="text-3xl font-black italic">
                            {{ \Carbon\Carbon::parse($booking->appointment_date)->format('d') }}
                        </p>
                        <p class="text-[10px] font-bold mt-1 text-orange-500">
                            {{ $booking->appointment_time }}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xl font-black text-slate-800 leading-tight uppercase tracking-tighter italic">
                            {{ $booking->service->title }}
                        </h4>
                        <div class="flex items-center gap-3 mt-2">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->client->name) }}&background=E2E8F0" class="w-6 h-6 rounded-lg">
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">{{ $booking->client->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1 bg-slate-50 p-6 rounded-3xl border border-dashed border-slate-200 relative">
                    <i class="fa-solid fa-quote-left absolute top-4 left-4 text-slate-200 text-2xl"></i>
                    <p class="text-[9px] font-black text-slate-400 uppercase mb-2 ml-2 tracking-[0.2em]">Description du problème</p>
                    <p class="text-slate-600 text-sm italic font-medium leading-relaxed pl-4">
                        "{{ $booking->issue_description }}"
                    </p>
                </div>

                <div class="flex flex-col gap-2 min-w-[150px]">
                    @if($booking->status == 'pending')
                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-green-600 transition-all shadow-lg active:scale-95">
                                Accepter
                            </button>
                        </form>

                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full py-3 bg-white text-red-500 border border-red-100 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-red-50 transition-all">
                                Refuser
                            </button>
                        </form>
                    @else
                        <div class="text-center py-4 rounded-2xl border-2 border-dashed {{ $booking->status == 'accepted' ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                            <i class="fa-solid {{ $booking->status == 'accepted' ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-500' }} text-xl mb-1"></i>
                            <p class="text-[10px] font-black uppercase tracking-widest {{ $booking->status == 'accepted' ? 'text-green-700' : 'text-red-700' }}">
                                Demande {{ $booking->status == 'accepted' ? 'Acceptée' : 'Refusée' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            @endforelse
    </div>
</div>
        </main>
    </div>

</body>

</html>
