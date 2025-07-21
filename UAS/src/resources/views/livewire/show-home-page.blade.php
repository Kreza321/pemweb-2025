@php
    use App\Models\PageConfig;
    
    $pageconfig = PageConfig::first(); // This could be null
@endphp

<main>
    <section class="banner bg-tertiary position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="block text-center text-lg-start pe-0 pe-xl-5">
                        <h1 class="text-capitalize mb-4">{{ $pageconfig->title ?? 'Default Title' }}</h1>
                        <p class="mb-4">{{ $pageconfig->detail ?? 'Default description text' }}</p>
                        <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#applyLoan">
                            See More
                            <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 text-center">
                        <img loading="lazy" decoding="async"
                            src="{{ $pageconfig->image ? asset('storage/' . $pageconfig->image) : asset('front/image/default.png') }}"
                            alt="Banner image" class="w-100 img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>