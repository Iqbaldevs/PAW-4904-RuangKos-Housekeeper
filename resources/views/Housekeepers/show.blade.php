@extends('layouts.app')

@section('title', $housekeeper->nama_staff)
@section('section', 'Detail housekeeper')

@section('content')
    <div class="page-heading">
        <div>
            <a class="back-link" href="{{ route('housekeepers.index') }}">← Kembali ke daftar housekeeper</a>
            <div class="eyebrow"><span class="eyebrow-line"></span>DETAIL PETUGAS</div>
            <h1>{{ $housekeeper->nama_staff }}</h1>
            <p class="page-subtitle">Informasi penugasan staf kebersihan kos.</p>
        </div>
        @if (auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
            <a class="button button-primary" href="{{ route('housekeepers.edit', $housekeeper->id) }}">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m14 5 5 5M4 20l4.2-.9L19 8.3 15.7 5 4.9 15.8 4 20Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Ubah data
            </a>
        @endif
    </div>

    <section class="panel detail-panel">
        <div class="detail-hero">
            <span class="detail-asset-icon"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/><path d="M5 20a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
            <div>
                <span class="category-pill">{{ $housekeeper->area }}</span>
                <h2>{{ $housekeeper->nama_staff }}</h2>
                <p>Terdaftar {{ $housekeeper->created_at?->locale('id')->translatedFormat('d F Y') ?? 'Hari ini' }}</p>
            </div>
        </div>
        <div class="detail-grid">
            <div class="detail-item"><span>NAMA STAF</span><strong>{{ $housekeeper->nama_staff }}</strong></div>
            <div class="detail-item"><span>AREA KERJA</span><strong>{{ $housekeeper->area }}</strong></div>
            <div class="detail-item detail-notes"><span>TUGAS KEBERSIHAN</span><p>{{ $housekeeper->tugas }}</p></div>
        </div>
        <div class="detail-actions">
            <a class="button button-secondary" href="{{ route('housekeepers.index') }}">Kembali ke daftar</a>
            @if (auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
                <form action="{{ route('housekeepers.destroy', $housekeeper->id) }}" method="POST" onsubmit="return confirm('Hapus data staf housekeeper ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button class="button button-delete" type="submit">Hapus staf</button>
                </form>
            @endif
        </div>
    </section>
@endsection