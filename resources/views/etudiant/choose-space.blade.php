@extends('front.layout.app') {{-- Assure-toi que ce layout existe --}}
@php
    $noFooter = true;
@endphp
@section('content')
<div class="container text-center mt-5">
    <h2 class="mb-4">Choose Your Space</h2>
    <div class="d-flex justify-content-center gap-2 mt-4">
        <div class="d-flex flex-column align-items-center">
        <a href="{{ route('etudiant.index') }}" class="btn mx-1 d-flex flex-column align-items-center p-4 shadow-lg position-relative custom-btn" style="width: 400px; height: 200px; background-color: #3e1e68">
            <img src="{{ asset('assets/img/etd1.jpg') }}"  class="rounded-circle position-absolute mb-2" style="width: 200px; height: 200px; bottom: -30px;border: 5px solid #b9c5fd;">
            <span class="fw-bold mt-auto"></span>
        </a>
        <div class="mt-2" style="width: 400px; height:50px; background-color:#f0f0f0; padding: 5px; color:#261340; font-weight: bold; display:flex;  justify-content: center; align-items: center;">
            Espace Etudiant
        </div>
        </div>
        <div class="d-flex flex-column align-items-center">
        <a href="{{ route('enseignant.index') }}" class=" mx-1 d-flex flex-column align-items-center p-4 shadow-lg position-relative custom-btn" style="width: 400px; height: 200px; background-color: #b9c5fd">
            <img src="{{ asset('assets/img/ens1.jpg') }}"  class="rounded-circle  position-absolute mb-2" style="width: 200px; height: 200px; bottom: -30px;border: 5px solid #3e1e68; ">
            <span class="fw-bold mt-auto"></span>
        </a>
        <div class="mt-2" style="width: 400px; height:50px; background-color:#f0f0f0; padding: 5px; color:#261340; font-weight: bold; display:flex;  justify-content: center; align-items: center;">
            Espace Enseignant
        </div>
    </div>
    </div>
</div>
<!-- Styles personnalisés -->
<style>
    a.custom-btn:hover {
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.7) !important; /* Ajoute une ombre plus visible */
        transition: box-shadow 0.3s ease-in-out; /* Animation fluide */
    }
</style>
@endsection
