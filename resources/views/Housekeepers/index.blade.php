@extends('layouts.app')

@section('title', 'Manajemen Housekeeper')
@section('section', 'Housekeeper')

@section('content')
    <div class="page-heading">
        <div>
            <div class="eyebrow"><span class="eyebrow-line"></span>KEBERSIHAN & PERAWATAN</div>
            <h1>Manajemen housekeeper</h1>
            <p class="page-subtitle">Pantau dan kelola daftar petugas kebersihan serta area tugas di kos.</p>
        </div>
        @if (auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
            <a class="button button-primary" href="{{ route('housekeepers.create') }}">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                Tambah staf
            </a>
        @endif
    </div>

    <section class="stats-grid" aria-label="Ringkasan housekeeper">
        <article class="stat-card">
            <div class="stat-top"><span class="stat-icon icon-lilac"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/><path d="M5 20a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="stat-trend">PERSONEL</span></div>
            <div class="stat-number">{{ number_format($totalStaff, 0, ',', '.') }} <span>staf</span></div>
            <div class="stat-caption">Total petugas kebersihan aktif</div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span class="stat-icon icon-mint"><svg viewBox="0 0 24 24" fill="none"><path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="10" r="2.2" stroke="currentColor" stroke-width="1.7"/></svg></span><span class="stat-trend">CAKUPAN</span></div>
            <div class="stat-number">{{ number_format($totalAreas, 0, ',', '.') }} <span>area</span></div>
            <div class="stat-caption">Zona kerja kos yang tercakup</div>
        </article>
        <article class="stat-card">
            <div class="stat-top"><span class="stat-icon icon-peach"><svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="4" width="17" height="16" rx="2.5" stroke="currentColor" stroke-width="1.7"/><path d="M8 9h8M8 13h8M8 17h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="stat-trend">OPERASIONAL</span></div>
            <div class="stat-number">{{ number_format($totalTasks, 0, ',', '.') }} <span>tugas</span></div>
            <div class="stat-caption">Jenis pekerjaan terjadwal</div>
        </article>
    </section>

    <section class="panel asset-panel">
        <div class="panel-heading">
            <div>
                <h2>Daftar petugas kebersihan</h2>
                <p>Seluruh staf housekeeper yang bertugas menjaga kebersihan properti kos.</p>
            </div>
            <span class="record-count">{{ count($housekeepers) }} staf</span>
        </div>

        <form class="filter-bar" action="{{ route('housekeepers.index') }}" method="GET">
            <label class="search-box">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="1.7"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama staf, tugas, atau area..." aria-label="Cari housekeeper">
            </label>
            <label class="select-wrap">
                <span class="sr-only">Filter area</span>
                <select name="area">
                    <option value="">Semua area</option>
                    @foreach ($areas as $areaOption)
                        <option value="{{ $areaOption }}" @selected(($selectedArea ?? '') === $areaOption)>{{ $areaOption }}</option>
                    @endforeach
                </select>
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m7 10 5 5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </label>
            <button class="button button-filter" type="submit">Terapkan</button>
            @if (!empty($search) || !empty($selectedArea))
                <a class="clear-filter" href="{{ route('housekeepers.index') }}">Reset</a>
            @endif
        </form>

        <div class="table-wrap">
            <table class="asset-table">
                <thead>
                    <tr>
                        <th>NAMA STAF</th>
                        <th>TUGAS</th>
                        <th>AREA KERJA</th>
                        @if (auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
                            <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($housekeepers as $housekeeper)
                        <tr>
                            <td>
                                @if (auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
                                    <a class="asset-name" href="{{ route('housekeepers.show', $housekeeper->id) }}">{{ $housekeeper->nama_staff }}</a>
                                @else
                                    <span class="asset-name">{{ $housekeeper->nama_staff }}</span>
                                @endif
                                <span class="asset-date">Terdaftar {{ $housekeeper->created_at?->locale('id')->translatedFormat('d M Y') ?? 'Hari ini' }}</span>
                            </td>
                            <td><span class="category-pill">{{ $housekeeper->tugas }}</span></td>
                            <td>
                                <span class="location-cell">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="10" r="2.2" stroke="currentColor" stroke-width="1.6"/></svg>
                                    {{ $housekeeper->area }}
                                </span>
                            </td>
                            @if (auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
                                <td class="action-cell">
                                    <a class="icon-button" href="{{ route('housekeepers.show', $housekeeper->id) }}" aria-label="Lihat {{ $housekeeper->nama_staff }}" title="Lihat detail">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M2.8 12s3.2-6 9.2-6 9.2 6 9.2 6-3.2 6-9.2 6-9.2-6-9.2-6Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/></svg>
                                    </a>
                                    <a class="icon-button" href="{{ route('housekeepers.edit', $housekeeper->id) }}" aria-label="Ubah {{ $housekeeper->nama_staff }}" title="Ubah data staf">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3 15.7 5 4.9 15.8 4 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <form action="{{ route('housekeepers.destroy', $housekeeper->id) }}" method="POST" onsubmit="return confirm('Hapus data staf housekeeper ini? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="icon-button icon-danger" type="submit" aria-label="Hapus {{ $housekeeper->nama_staff }}" title="Hapus staf">
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M4.5 7h15M10 11v6M14 11v6M6.5 7l.8 13h9.4l.8-13M9 7V4.5h6V7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="empty-cell" colspan="4">
                                <div class="empty-state">
                                    <span class="empty-icon"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.6"/><path d="M5 20a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
                                    <strong>{{ !empty($search) || !empty($selectedArea) ? 'Data staf tidak ditemukan' : 'Belum ada data housekeeper' }}</strong>
                                    <p>{{ !empty($search) || !empty($selectedArea) ? 'Coba ubah kata kunci atau filter area pencarian Anda.' : 'Mulai tambahkan daftar petugas kebersihan kos.' }}</p>
                                    @if (empty($search) && empty($selectedArea) && auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
                                        <a class="button button-primary button-small" href="{{ route('housekeepers.create') }}">Tambah staf pertama</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection