@extends('Admin.Admindash') <!-- Utilise la vue de base du dashboard -->
@section('dashboard-content')
    <h1>Tous les cours</h1>
    <!-- Afficher les informations des cours -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre du cours</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>
                        <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
