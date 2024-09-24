@extends('layouts.app.main')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body py-5">                                
                                <h3 class="card-title">Welcome to <span class="text-primary">{{ $loggedUser['fullname'] }}</span></h3>
                                <p>A very simple and minimal starter kit for your PHP Project, This kit provides essential scaffolding for authentication, built with <b>Blade</b>, <b>Bootstrap</b>, and yes... <b>jQuery</b>. 😉</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-2">

                @foreach ([
                    [
                        'icon' => 'ph-duotone ph-shield-check',
                        'title' => 'Authentication',
                        'desc' => '<span class="text-primary fw-bold">Origin</span> provides robust authentication mechanisms, ensuring that only authorized users can access your application\'s resources.'
                    ],
                    [
                        'icon' => 'ph-duotone ph-leaf',
                        'title' => 'Truly Minimal',
                        'desc' => 'Built with simplicity in mind, <span class="text-primary fw-bold">Origin</span> delivers essential features without the bloat, giving you just what you need to start your project.'
                    ],
                    [
                        'icon' => 'ph-duotone ph-device-mobile',
                        'title' => 'Well-Designed UI/UX',
                        'desc' => '<span class="text-primary fw-bold">Origin</span> offers a collection of sleek, responsive UI components with intuitive UX patterns, making your app look great on any device.'
                    ],
                    [
                        'icon' => 'ph-duotone ph-gear',
                        'title' => 'Utilities & Tools',
                        'desc' => '<span class="text-primary fw-bold">Origin</span> includes additional tools for quick feature integration like form handling, CSRF protection, and more, helping you focus on your app.'
                    ]
                ] as $feature)

                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="{{ $feature['icon'] }} origin-feature-icon position-absolute"
                                style="font-size: 5rem; opacity:0.1; right: 1rem;"></i>
                                <span class="origin-feature-title">{{ $feature['title'] }}</span>
                            </h5>
                            <p class="origin-feature-desc">{!! $feature['desc'] !!}</p>
                        </div>
                    </div>
                </div>

                @endforeach
                </div>

            </div>

            
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush