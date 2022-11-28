@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight text-dark">List Menu</h6>
        </div>
        <div class="row-border">
            <div class="col-lg-12">
                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success col-lg-12" role="alert">
                      {{ session('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger col-lg-8" role="alert">
                      {{ session('error') }}
                    </div>
                    @endif
      
                    <div class="dashboard">
                        <form action="/users/profile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                            {{-- @method('put') --}}
                            @csrf
                            <div class="row justify-content-between align-items-center">
                                @if(auth()->user()->profile)
                                    <img src="{{ asset('/storage/' . auth()->user()->profile) }}" class="img-preview col-3 d-block" onchange="previewImage()">
                                @else
                                    <img class="img-preview col-3 d-block" width="10px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                @endif
                            </div>
                            <div class="row justify-content-between align-items-center py-3">
                                <div class="col-3">
                                    <label for="profile" class="form-label">Foto Profile</label>
                                </div>
                                <div class="col-8">
                                    <input style="border: 0;" class="form-control @error('profile') is-invalid @enderror" type="file" id="profile" name="profile" onchange="previewImage()">
                                </div>
                                {{-- <input type="hidden" name="oldprofile" value="{{ auth()->user()->employee->profile }}"> --}}
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-4">
                                  <label for="name" class="col-form-label">Name</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', Auth()->user()->name) }}">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-4">
                                  <label for="email" class="col-form-label">Email</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email', Auth()->user()->email) }}">
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-warning" onclick="edit()" type="button">Edit</button>
                                <button class="btn btn-info" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row align-items-left">
                    <div class="col-auto">
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body px-4 w-100 my-3">
                        <form action="/users/profile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title mt-3">Ganti Password</h4>
                                </div>
                            </div>
                            <div class="input-group mb-3">                                   
                                <input type="password" id="password" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Masukkan Password Baru" required>
                                <button class="btn btn-outline-secondary" onclick="change()" type="button" id="mybutton"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg>
                                    </button>
                                </div>
                                <div class="input-group mb-3">                                   
                                    <input type="password" id="password2" name="password2" class="form-control form-control-sm @error('password2') is-invalid @enderror" placeholder="Masukkan Konfirmasi Password" required>
                                    <button class="btn btn-outline-secondary" onclick="change2()" type="button" id="mybutton2"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg>
                                    </button>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-warning" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                  </div>
            </div>
        </div>
<script>

    function change() {

// membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
var x = document.getElementById('password').type;

//membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
if (x == 'password') {

    //ubah form input password menjadi text
    document.getElementById('password').type = 'text';
    
    //ubah icon mata terbuka menjadi tertutup
    document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>`;
}
else {

    //ubah form input password menjadi text
    document.getElementById('password').type = 'password';

    //ubah icon mata terbuka menjadi tertutup
    document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>`;
}
}

function change2() {

// membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
var y = document.getElementById('password2').type;

//membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
if (y == 'password') {

    //ubah form input password menjadi text
    document.getElementById('password2').type = 'text';
    
    //ubah icon mata terbuka menjadi tertutup
    document.getElementById('mybutton2').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>`;
}
else {

    //ubah form input password menjadi text
    document.getElementById('password2').type = 'password';

    //ubah icon mata terbuka menjadi tertutup
    document.getElementById('mybutton2').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>`;
}
}

    function previewImage(){
        const profile = document.querySelector('#profile');
        const imgPreview = document.querySelector('.img-preview1');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(profile.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
