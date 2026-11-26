@extends('layouts.app')

@section('title', $pageTitle)
@section('section', $pageTitle)

@section('content')
    @php
        $isEdit = !empty($housekeeper->id);
    @endphp

    <div class="page-heading">
        <div>
            <a class="back-link" href="{{ route('housekeepers.index') }}">← Kembali ke daftar housekeeper</a>
            <div class="eyebrow"><span class="eyebrow-line"></span>KEBERSIHAN & PERAWATAN</div>
            <h1>{{ $pageTitle }}</h1>
            <p class="page-subtitle">Lengkapi informasi staf kebersihan beserta tugas dan area kerjanya.</p>
        </div>
    </div>

    <form class="panel form-panel" action="{{ $isEdit ? route('housekeepers.update', $housekeeper->id) : route('housekeepers.store') }}" method="POST">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="form-section-heading">
            <span class="form-section-icon"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/><path d="M5 20a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
            <div><h2>Informasi staf housekeeper</h2><p>Data identitas petugas dan pembagian area kebersihan.</p></div>
        </div>

        <div class="form-grid">
            <div class="field-group">
                <label for="nama_staff">Nama staf <span class="required">*</span></label>
                <input id="nama_staff" name="nama_staff" type="text" value="{{ old('nama_staff', $housekeeper->nama_staff ?? '') }}" placeholder="Contoh: Siti Aminah" maxlength="255" required>
                @error('nama_staff')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field-group">
                <label for="area">Area kerja <span class="required">*</span></label>
                <input id="area" name="area" type="text" value="{{ old('area', $housekeeper->area ?? '') }}" placeholder="Contoh: Lantai 1 & Koridor Utama" maxlength="255" required>
                @error('area')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field-group field-full">
                <label for="tugas">Tugas kebersihan <span class="required">*</span></label>
                <input id="tugas" name="tugas" type="text" value="{{ old('tugas', $housekeeper->tugas ?? '') }}" placeholder="Contoh: Menyapu, mengepel lantai, dan membersihkan kamar mandi bersama" maxlength="255" required>
                @error('tugas')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-footer">
            <a class="button button-secondary" href="{{ $isEdit ? route('housekeepers.show', $housekeeper->id) : route('housekeepers.index') }}">Batal</a>
            <button class="button button-primary" type="submit">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m5 12.5 4.5 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ $submitLabel }}
            </button>
        </div>
    </form>
@endsection