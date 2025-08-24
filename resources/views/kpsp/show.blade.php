@extends('layouts.app')

@section('content')
<h2>{{ $set->judul }} (Usia {{ $set->usia_dalam_bulan }} bulan)</h2>

@if ($skrining)
    <div class="alert alert-info">
        <p><strong>Sudah diisi pada:</strong> {{ $skrining->tanggal_skrining }}</p>
        <p><strong>Skor:</strong> {{ $skrining->skor_mentah }}</p>
        <p><strong>Hasil:</strong> {{ $skrining->hasil_interpretasi }}</p>
    </div>

    <ul>
        @foreach ($skrining->jawaban as $j)
            <li>
                <strong>{{ $j->pertanyaan->nomor_urut }}.</strong>
                {{ $j->pertanyaan->teks_pertanyaan }}
                → <em>{{ ucfirst($j->jawaban) }}</em>
            </li>
        @endforeach
    </ul>
@else
    <form action="{{ route('kpsp.store', $set->id) }}" method="POST">
        @csrf
        <ul>
            @foreach ($pertanyaan as $p)
                <li>
                    <strong>{{ $p->nomor_urut }}.</strong> {{ $p->teks_pertanyaan }} <br>
                    <label>
                        <input type="radio" name="jawaban_{{ $p->id }}" value="ya" required> Ya
                    </label>
                    <label>
                        <input type="radio" name="jawaban_{{ $p->id }}" value="tidak" required> Tidak
                    </label>
                </li>
            @endforeach
        </ul>
        <button type="submit">Simpan Jawaban</button>
    </form>
@endif
@endsection
