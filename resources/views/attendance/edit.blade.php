<!-- resources/views/attendance/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Absensi</h2>

    <!-- Menampilkan pesan error jika ada -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Formulir Edit Absensi -->
    <form action="{{ route('attendance.update', ['student_id' => $attendance->student_id, 'date' => $attendance->date]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Status Absensi</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Hadir" {{ $attendance->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="Izin" {{ $attendance->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                <option value="Sakit" {{ $attendance->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="Alfa" {{ $attendance->status == 'Alfa' ? 'selected' : '' }}>Alfa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
