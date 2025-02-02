<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 20px;
        }
        h1, h2 {
            margin: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
        }
        .alert-success {
            color: green;
            margin-bottom: 20px;
            font-weight: bold;
            padding: 10px;
            background-color: #d4edda;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="date"], select {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .card {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .table-container {
            margin-top: 30px;
        }
        .btn-edit, .btn-delete {
            padding: 8px 16px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-edit {
            background-color: #ffc107;
            color: white;
        }
        .btn-edit:hover {
            background-color: #e0a800;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .action-btns {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
    </style>
</head>
<body>

    <header>
        <h1>Absensi Siswa</h1>
    </header>

    <div class="container">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Absensi -->
        <div class="card">
            <h2>Catat Kehadiran</h2>
            <form method="POST" action="{{ route('attendance.store') }}">
                @csrf
                <div class="form-group">
                    <label for="date">Tanggal:</label>
                    <input type="date" name="date" id="date" required>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->class }}</td>
                                <td>
                                    <select name="attendance[{{ $student->id }}]">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Alfa" selected>Alfa</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit">Simpan Absensi</button>
            </form>
        </div>

        <!-- Daftar Absensi -->
        <div class="card table-container">
            <h2>Daftar Absensi</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        @foreach ($student->attendances as $attendance)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>{{ $attendance->status }}</td>
                                <td class="action-btns">
                                    <a href="{{ route('attendance.edit', ['student_id' => $attendance->student_id, 'date' => $attendance->date]) }}" class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('attendance.destroy', $attendance->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
