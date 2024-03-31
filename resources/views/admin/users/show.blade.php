@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-title">
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Profile</h3>
            <p class="text-subtitle text-muted">All data from test's account.</p>
            <hr>
{{--
            <div class="mb-4">
                @if ($user->role !== 'admin' or $user->id_user == auth()->user()->id_user)
                    <a href="/dashboard/users/{{ $user->id_user }}/edit" class="px-2 pt-2 btn btn-warning me-1">
                        <span class="select-all fa-fw fa-lg fas"></span>
                    </a>
                @endif

                @if ($user->role !== 'admin' and $user->id_user !== auth()->user()->id_user)
                    <a class="px-2 pt-2 btn btn-danger me-1" data-confirm-user-destroy="true"
                        data-unique="{{ $user->id_user }}">
                        <span data-confirm-user-destroy="true" data-unique="{{ $user->id_user }}"
                            class="select-all fa-fw fa-lg fas"></span>
                    </a>
                @endif
            </div> --}}
        </div>
        <div class="order-first col-12 col-md-6 order-md-2">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/test">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/user">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">User @{{ $user->username }}</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
            @if($user->foto)
                <img class="object-cover " src="{{ asset('storage/profile_photos/' . $user->foto) }}" alt="Profile">
            @else
                <img class="object-cover h-35 w-32" src="{{ asset('images/undraw_profile_2.svg') }}" alt="Profile">
            @endif

            <h4 class="mt-4">{{ $user->nama_lengkap }}
                </h4>

                <small class="text-muted">{{ $user->role }}</small>
            </div>

            <div class="container text-center justify-content-center">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="font-bold">
                            <p>Email: <span style="font-weight: 400;" class="text-muted">{{ $user->email }}</span>
                            </p>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="font-bold">
                           <p>Address:
                            <span style="font-weight: 400;" class="text-muted">
                                {{ $user->alamat }}
                            </span>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="font-bold">
                            <p>Status: <span class="badge bg-primary">{{ $user->role }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="font-bold">
                            <p>Active:
                                <span style="font-weight: 400;" class="text-muted">
                                    {{-- @if ($user->flag_active == 'Y')
                                        Yes
                                    @else
                                        No
                                    @endif --}}
                                </span>
                            </p>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@include('adminPage.include.footer')
@include('adminPage.include.script')
