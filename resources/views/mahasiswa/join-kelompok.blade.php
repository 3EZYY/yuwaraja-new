@extends('layouts.app')

@section('content')
<div style="max-width:400px;margin:40px auto;padding:32px;background:#222;border-radius:12px;">
    <h2 style="color:#fff;margin-bottom:24px;">Gabung ke Kelompok</h2>
    @if(session('success'))
        <div style="color:limegreen;margin-bottom:16px;">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('mahasiswa.join-kelompok.submit') }}">
        @csrf
        <div style="margin-bottom:16px;">
            <label for="code" style="color:#fff;">Kode Kelompok</label>
            <input type="text" name="code" id="code" maxlength="5" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #444;background:#111;color:#fff;">
            @error('code')
                <div style="color:tomato;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" style="padding:8px 24px;background:orange;color:#fff;border:none;border-radius:6px;">Gabung</button>
    </form>
</div>
@endsection
