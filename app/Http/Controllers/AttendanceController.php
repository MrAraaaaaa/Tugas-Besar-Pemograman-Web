<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;

class AttendanceController extends Controller
{
    
    public function index()
    {
        $students = Student::all();
        return view('attendance.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date', 
            'attendance' => 'required|array', 
        ]);

        foreach ($request->attendance as $student_id => $status) {
            // Gunakan updateOrCreate untuk menyimpan atau memperbarui data
            Attendance::updateOrCreate(
                ['student_id' => $student_id, 'date' => $request->date], // Kriteria pencarian
                ['status' => $status] // Data yang akan diperbarui atau ditambahkan
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }

    // Menampilkan formulir edit absensi
    public function edit($student_id, $date)
    {
        // Menampilkan absensi berdasarkan student_id dan date
        $attendance = Attendance::where('student_id', $student_id)
                                 ->where('date', $date)
                                 ->first();
        // Jika data absensi ditemukan, tampilkan form edit
        if ($attendance) {
            return view('attendance.edit', compact('attendance'));
        } else {
            return redirect()->route('attendance.index')
                             ->with('error', 'Data absensi tidak ditemukan!');
        }
    }

    // Menyimpan perubahan absensi
    public function update(Request $request, $student_id, $date)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit,Alfa', // Validasi status
        ]);

        // Mencari absensi berdasarkan student_id dan date
        $attendance = Attendance::where('student_id', $student_id)
                                 ->where('date', $date)
                                 ->first();

        if ($attendance) {
            // Update status absensi
            $attendance->update([
                'status' => $request->status,
            ]);

            return redirect()->route('attendance.index')
                             ->with('success', 'Absensi berhasil diperbarui!');
        } else {
            return redirect()->route('attendance.index')
                             ->with('error', 'Data absensi tidak ditemukan!');
        }
        
    }
    public function destroy($id)
    {
        // Temukan data absensi berdasarkan ID
        $attendance = Attendance::findOrFail($id);

        // Hapus data absensi
        $attendance->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data absensi berhasil dihapus.');

}

}