@extends('layouts.dashboard')


@section('title')
    UTILISATEURS
@endsection

@section('subtitle')
    DÉTAILS UTILISATEURS
@endsection
@section('dash')

    <div class="bg-image" style="background-image: url('{{ asset('assets/media/avatars/photo12@2x.jpg') }}');">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                </div>
                <h1 class="h2 text-white mb-0">{{ $user->last_name }} {{ $user->first_name }}</h1>
                <span class="text-white-75">{{ $user->postes->last()->name }}</span>
                <div class="fs-sm text-muted">{{ $user->roles->last()->name }}</div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Edit Customer
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-danger">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-danger mb-0">
                            Remove Customer
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    <div class="mb-3">
                        <img class="img-avatar img-avatar-thumb" src="{{ asset('assets/media/avatars/avatar10.jpg') }}"
                            alt="">
                    </div>
                    <h1 class="fs-lg mb-0">
                        <span>{{ \Str::ucfirst($user->civilite) }} {{ str_replace('\\', '', $user->last_name) }}
                            {{ str_replace('\\', '', $user->first_name) }}</span>
                    </h1>
                    <p class="fs-sm fw-medium text-muted">
                        @foreach ($user->postes as $poste)
                            {{ \Str::upper(str_replace('\\', '', $poste->name)) }}
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Postes</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $user->postes->count() }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Rôles</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $user->roles->count() }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Permissions</div>
                        <a class="link-fx fs-3 text-primary"
                            href="javascript:void(0)">{{ $user->permissions->count() }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Abscences</div>
                        <a class="link-fx fs-3 text-primary"
                            href="javascript:void(0)">{{ $user->presences->count() }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="d-xl-none push">
            <div class="row g-sm">
                <div class="col-6">
                    <button type="button" class="btn btn-alt-secondary w-100" data-toggle="class-toggle"
                        data-target=".js-ecom-div-nav" data-class="d-none">
                        <i class="fa fa-fw fa-bars text-muted me-1"></i> Navigation
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-alt-secondary w-100" data-toggle="class-toggle"
                        data-target=".js-ecom-div-cart" data-class="d-none">
                        <i class="fa fa-fw fa-shopping-cart text-muted me-1"></i> Cart (3)
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 order-xl-1">
                <div class="block block-rounded js-ecom-div-nav d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-boxes text-muted me-1"></i> Postes
                        </h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav nav-pills flex-column push">
                            @foreach ($user->postes as $poste)
                                <li class="nav-item mb-1">
                                    <a class="nav-link d-flex justify-content-between align-items-center"
                                        href="javascript:void(0)">
                                        {{ $poste->name }} <span class="badge rounded-pill bg-black-50 ms-1"></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="block block-rounded js-ecom-div-cart d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-shopping-cart text-muted me-1"></i> EVOLUTION SALARIAL
                        </h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-hover table-vcenter">
                            <tbody>

                                {{-- @if($salaire->motif == 'augmentation')
                                <tr>
                                    <td class="text-center">
                                        <a class="text-muted" href="javascript:void(0)"><i
                                                class="fa fa-up"></i></a>
                                    </td>
                                    <td style="width: 60px;">
                                        <img class="img-fluid" src="assets/media/various/ecom_product1.png" alt="">
                                    </td>
                                    <td>
                                        <a class="h6" href="be_pages_ecom_store_product.html">Iconic</a>
                                        <div class="fs-sm text-muted">Beautifully crafted icon set</div>
                                    </td>
                                    <td class="text-end">
                                        <div class="fw-semibold">{{ $salaire->montant }}</div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td class="text-center">
                                        <a class="text-muted" href="javascript:void(0)"><i
                                                class="fa fa-down"></i></a>
                                    </td>
                                    <td style="width: 60px;">
                                        <img class="img-fluid" src="assets/media/various/ecom_product1.png" alt="">
                                    </td>
                                    <td>
                                        <a class="h6" href="be_pages_ecom_store_product.html">Iconic</a>
                                        <div class="fs-sm text-muted">Beautifully crafted icon set</div>
                                    </td>
                                    <td class="text-end">
                                        <div class="fw-semibold">{{ $salaire->montant }}</div>
                                    </td>
                                </tr>
                                @endif --}}

                                <tr class="table-active">
                                    <td class="text-center" colspan="3">
                                        <span class="h4 fw-medium">AUCUNE EVOLUTION</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-full bg-body-light text-end">
                        <a class="btn btn-primary" href="#">
                            Augmenter
                            <i class="fa fa-arrow-up opacity-50 ms-1"></i>
                        </a>
                        <a class="btn btn-danger" href="#">
                            Réduire
                            <i class="fa fa-arrow-down opacity-50 ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-0">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Informations personnelles</h3>
                    </div>
                    <div class="block-content">
                        {{-- <div class="row items-push">
                            <div class="col-md-6">
                                <div class="row g-sm js-gallery img-fluid-100 js-gallery-enabled">
                                    <div class="col-12 mb-3">
                                        <a class="img-link img-link-zoom-in img-lightbox"
                                            href="assets/media/various/ecom_product6.png">
                                            <img class="img-fluid" src="assets/media/various/ecom_product6.png"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="img-link img-link-zoom-in img-lightbox"
                                            href="assets/media/various/ecom_product6_a.png">
                                            <img class="img-fluid" src="assets/media/various/ecom_product6_a.png"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="img-link img-link-zoom-in img-lightbox"
                                            href="assets/media/various/ecom_product6_b.png">
                                            <img class="img-fluid" src="assets/media/various/ecom_product6_b.png"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="img-link img-link-zoom-in img-lightbox"
                                            href="assets/media/various/ecom_product6_c.png">
                                            <img class="img-fluid" src="assets/media/various/ecom_product6_c.png"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-sm fw-semibold text-success">IN STOCK</div>
                                        <div class="fs-sm text-muted">200 Available</div>
                                    </div>
                                    <div class="fs-2 fw-bold">
                                        $58
                                    </div>
                                </div>
                                <form class="d-flex justify-content-between my-3 border-top border-bottom"
                                    action="be_pages_ecom_store_product.html" method="post" onsubmit="return false;">
                                    <div class="py-3">
                                        <select class="form-select form-select-sm" id="ecom-license" name="ecom-license"
                                            size="1">
                                            <option value="0" disabled="" selected="">LICENSE</option>
                                            <option value="simple">Simple</option>
                                            <option value="multiple">Multiple</option>
                                        </select>
                                    </div>
                                    <div class="py-3">
                                        <button type="submit" class="btn btn-sm btn-alt-secondary">
                                            <i class="fa fa-plus text-success me-1"></i> Add to Cart
                                        </button>
                                    </div>
                                </form>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet
                                    adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut
                                    metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis
                                    purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="">
                                <div class="block block-rounded block-bordered">
                                    <div class="block-header border-bottom">
                                        <h3 class="block-title">Billing Address</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="fs-4 mb-1">John Parker</div>
                                        <address class="fs-sm">
                                            Sunrise Str 620<br>
                                            Melbourne<br>
                                            Australia, 11-587<br><br>
                                            <svg class="svg-inline--fa fa-phone fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg><!-- <i class="fa fa-phone"></i> --> (999) 888-55555<br>
                                            <svg class="svg-inline--fa fa-envelope-o fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="envelope-o" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><g><path fill="currentColor" d="M156.5,447.7l-12.6,29.5c-18.7-9.5-35.9-21.2-51.5-34.9l22.7-22.7C127.6,430.5,141.5,440,156.5,447.7z M40.6,272H8.5 c1.4,21.2,5.4,41.7,11.7,61.1L50,321.2C45.1,305.5,41.8,289,40.6,272z M40.6,240c1.4-18.8,5.2-37,11.1-54.1l-29.5-12.6 C14.7,194.3,10,216.7,8.5,240H40.6z M64.3,156.5c7.8-14.9,17.2-28.8,28.1-41.5L69.7,92.3c-13.7,15.6-25.5,32.8-34.9,51.5 L64.3,156.5z M397,419.6c-13.9,12-29.4,22.3-46.1,30.4l11.9,29.8c20.7-9.9,39.8-22.6,56.9-37.6L397,419.6z M115,92.4 c13.9-12,29.4-22.3,46.1-30.4l-11.9-29.8c-20.7,9.9-39.8,22.6-56.8,37.6L115,92.4z M447.7,355.5c-7.8,14.9-17.2,28.8-28.1,41.5 l22.7,22.7c13.7-15.6,25.5-32.9,34.9-51.5L447.7,355.5z M471.4,272c-1.4,18.8-5.2,37-11.1,54.1l29.5,12.6 c7.5-21.1,12.2-43.5,13.6-66.8H471.4z M321.2,462c-15.7,5-32.2,8.2-49.2,9.4v32.1c21.2-1.4,41.7-5.4,61.1-11.7L321.2,462z M240,471.4c-18.8-1.4-37-5.2-54.1-11.1l-12.6,29.5c21.1,7.5,43.5,12.2,66.8,13.6V471.4z M462,190.8c5,15.7,8.2,32.2,9.4,49.2h32.1 c-1.4-21.2-5.4-41.7-11.7-61.1L462,190.8z M92.4,397c-12-13.9-22.3-29.4-30.4-46.1l-29.8,11.9c9.9,20.7,22.6,39.8,37.6,56.9 L92.4,397z M272,40.6c18.8,1.4,36.9,5.2,54.1,11.1l12.6-29.5C317.7,14.7,295.3,10,272,8.5V40.6z M190.8,50 c15.7-5,32.2-8.2,49.2-9.4V8.5c-21.2,1.4-41.7,5.4-61.1,11.7L190.8,50z M442.3,92.3L419.6,115c12,13.9,22.3,29.4,30.5,46.1 l29.8-11.9C470,128.5,457.3,109.4,442.3,92.3z M397,92.4l22.7-22.7c-15.6-13.7-32.8-25.5-51.5-34.9l-12.6,29.5 C370.4,72.1,384.4,81.5,397,92.4z"></path><circle fill="currentColor" cx="256" cy="364" r="28"><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="r" values="28;14;28;28;14;28;"></animate><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="opacity" values="1;0;1;1;0;1;"></animate></circle><path fill="currentColor" opacity="1" d="M263.7,312h-16c-6.6,0-12-5.4-12-12c0-71,77.4-63.9,77.4-107.8c0-20-17.8-40.2-57.4-40.2c-29.1,0-44.3,9.6-59.2,28.7 c-3.9,5-11.1,6-16.2,2.4l-13.1-9.2c-5.6-3.9-6.9-11.8-2.6-17.2c21.2-27.2,46.4-44.7,91.2-44.7c52.3,0,97.4,29.8,97.4,80.2 c0,67.6-77.4,63.5-77.4,107.8C275.7,306.6,270.3,312,263.7,312z"><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="opacity" values="1;0;0;0;0;1;"></animate></path><path fill="currentColor" opacity="0" d="M232.5,134.5l7,168c0.3,6.4,5.6,11.5,12,11.5h9c6.4,0,11.7-5.1,12-11.5l7-168c0.3-6.8-5.2-12.5-12-12.5h-23 C237.7,122,232.2,127.7,232.5,134.5z"><animate attributeType="XML" repeatCount="indefinite" dur="2s" attributeName="opacity" values="0;0;1;1;0;0;"></animate></path></g></svg><!-- <i class="fa fa-envelope-o"></i> --> <a href="javascript:void(0)">company@example.com</a>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="block block-rounded block-bordered">
                            <div
                                class="block-content block-content-full d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="mb-2">
                                        By <a class="fw-semibold" href="javascript:void(0)">Emma Cooper</a>
                                    </div>
                                    <div>
                                        <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </a>
                                        <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-envelope text-muted"></i>
                                        </a>
                                    </div>
                                </div>
                                <img class="img-avatar" src="assets/media/avatars/avatar2.jpg" alt="">
                            </div>
                        </div>
                        <div class="block block-rounded">
                            <ul class="nav nav-tabs nav-tabs-alt align-items-center" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" id="ecom-product-info-tab"
                                        data-bs-toggle="tab" data-bs-target="#ecom-product-info" role="tab"
                                        aria-controls="ecom-product-reviews" aria-selected="true">Info</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="ecom-product-comments-tab"
                                        data-bs-toggle="tab" data-bs-target="#ecom-product-comments" role="tab"
                                        aria-controls="ecom-product-reviews" aria-selected="false">Comments</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="ecom-product-reviews-tab"
                                        data-bs-toggle="tab" data-bs-target="#ecom-product-reviews" role="tab"
                                        aria-controls="ecom-product-reviews" aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane pull-x active" id="ecom-product-info" role="tabpanel"
                                    aria-labelledby="ecom-product-info-tab">
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">File Formats</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 20%;">Sketch</td>
                                                <td>
                                                    <i class="fa fa-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PSD</td>
                                                <td>
                                                    <i class="fa fa-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PDF</td>
                                                <td>
                                                    <i class="fa fa-times text-danger"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>AI</td>
                                                <td>
                                                    <i class="fa fa-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>EPS</td>
                                                <td>
                                                    <i class="fa fa-check text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Extra</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 20%;">
                                                    <i class="fa fa-fw fa-calendar text-muted me-1"></i> Date
                                                </td>
                                                <td>January 15, 2019</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-anchor text-muted me-1"></i> File Size
                                                </td>
                                                <td>265.36 MB</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-vector-square text-muted me-1"></i> Vector
                                                </td>
                                                <td>
                                                    <i class="fa fa-fw fa-check text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane pull-x fs-sm" id="ecom-product-comments" role="tabpanel"
                                    aria-labelledby="ecom-product-comments-tab">
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar3.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <a class="fw-semibold" href="javascript:void(0)">Lori Grant</a>
                                            <mark class="fw-semibold text-danger">Purchased</mark>
                                            <p class="my-1">High quality, thanks so much for sharing!</p>
                                            <a class="me-1" href="javascript:void(0)">Like</a>
                                            <a class="me-1" href="javascript:void(0)">Reply</a>
                                            <span class="text-muted"><em>12 min ago</em></span>
                                            <div class="d-flex mt-3">
                                                <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                                    <img class="img-avatar img-avatar32"
                                                        src="assets/media/avatars/avatar2.jpg" alt="">
                                                </a>
                                                <div class="flex-grow-1">
                                                    <a class="fw-semibold" href="javascript:void(0)">Emma Cooper</a>
                                                    <mark class="fw-semibold text-success">Author</mark>
                                                    <p class="my-1">Thanks so much!!</p>
                                                    <a class="me-1" href="javascript:void(0)">Like</a>
                                                    <a class="me-1" href="javascript:void(0)">Reply</a>
                                                    <span class="text-muted"><em>20 min ago</em></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <a class="fw-semibold" href="javascript:void(0)">Henry Harrison</a>
                                            <mark class="fw-semibold text-danger">Purchased</mark>
                                            <p class="my-1">Great work, thank you!</p>
                                            <a class="me-1" href="javascript:void(0)">Like</a>
                                            <a class="me-1" href="javascript:void(0)">Reply</a>
                                            <span class="text-muted"><em>30 min ago</em></span>
                                            <div class="d-flex mt-3">
                                                <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                                    <img class="img-avatar img-avatar32"
                                                        src="assets/media/avatars/avatar2.jpg" alt="">
                                                </a>
                                                <div class="flex-grow-1">
                                                    <a class="fw-semibold" href="javascript:void(0)">Emma Cooper</a>
                                                    <mark class="fw-semibold text-success">Author</mark>
                                                    <p class="my-1">Thanks so much!!</p>
                                                    <a class="me-1" href="javascript:void(0)">Like</a>
                                                    <a class="me-1" href="javascript:void(0)">Reply</a>
                                                    <span class="text-muted"><em>20 min ago</em></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar14.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <a class="fw-semibold" href="javascript:void(0)">Adam McCoy</a>
                                            <p class="my-1">Really nice!</p>
                                            <a class="me-1" href="javascript:void(0)">Like</a>
                                            <a class="me-1" href="javascript:void(0)">Reply</a>
                                            <span class="text-muted"><em>42 min ago</em></span>
                                            <div class="d-flex mt-3">
                                                <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                                    <img class="img-avatar img-avatar32"
                                                        src="assets/media/avatars/avatar2.jpg" alt="">
                                                </a>
                                                <div class="flex-grow-1">
                                                    <a class="fw-semibold" href="javascript:void(0)">Emma Cooper</a>
                                                    <mark class="fw-semibold text-success">Author</mark>
                                                    <p class="my-1">Thanks so much!!</p>
                                                    <a class="me-1" href="javascript:void(0)">Like</a>
                                                    <a class="me-1" href="javascript:void(0)">Reply</a>
                                                    <span class="text-muted"><em>20 min ago</em></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="be_pages_ecom_store_product.html" method="POST" onsubmit="return false;">
                                        <input type="text" class="form-control form-control-alt"
                                            placeholder="Write a comment..">
                                    </form>
                                </div>
                                <div class="tab-pane pull-x fs-sm" id="ecom-product-reviews" role="tabpanel"
                                    aria-labelledby="ecom-product-reviews-tab">
                                    <div class="block block-rounded bg-body-light">
                                        <div class="block-content text-center">
                                            <p class="text-warning mb-2">
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                                <i class="fa fa-star fa-2x"></i>
                                            </p>
                                            <p>
                                                <strong>5.0</strong>/5.0 out of <strong>5</strong> Ratings
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <span class="text-warning">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <a class="fw-semibold" href="javascript:void(0)">Scott Young</a>
                                            <p class="my-1">Awesome Quality!</p>
                                            <span class="text-muted"><em>2 hours ago</em></span>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar4.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <span class="text-warning">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <a class="fw-semibold" href="javascript:void(0)">Amanda Powell</a>
                                            <p class="my-1">So cool badges!</p>
                                            <span class="text-muted"><em>5 hours ago</em></span>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <span class="text-warning">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <a class="fw-semibold" href="javascript:void(0)">Jose Parker</a>
                                            <p class="my-1">They look great, thank you!</p>
                                            <span class="text-muted"><em>15 hours ago</em></span>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <span class="text-warning">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <a class="fw-semibold" href="javascript:void(0)">Albert Ray</a>
                                            <p class="my-1">Badges for life!</p>
                                            <span class="text-muted"><em>20 hours ago</em></span>
                                        </div>
                                    </div>
                                    <div class="d-flex push">
                                        <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar6.jpg"
                                                alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <span class="text-warning">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <a class="fw-semibold" href="javascript:void(0)">Alice Moore</a>
                                            <p class="my-1">So good, keep it up!</p>
                                            <span class="text-muted"><em>22 hours ago</em></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-body-light text-end">
                        <a class="btn btn-primary" href="be_pages_ecom_store_checkout.html">
                            Checkout
                            <svg class="svg-inline--fa fa-arrow-right fa-w-14 opacity-50 ms-1" aria-hidden="true" data-prefix="fa" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg><!-- <i class="fa fa-arrow-right opacity-50 ms-1"></i> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Private Notes</h3>
            </div>
            <div class="block-content">
                <form action="be_pages_ecom_customer.html" onsubmit="return false;">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-customer-note">Note</label>
                        <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4"
                            placeholder="Maybe a special request?"></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-alt-primary">Add Note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#editRapport', function(event) {
                document.getElementById('rapport_form_method').innerHTML =
                    '{{ method_field('PUT') }}';
                console.log($('#rapport_form'));
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');


            });
            document.getElementById("bar").style.display = "none";
        });
    </script>
@endpush



@push('custom-js')
    {{-- <script src="{{ asset('assets/js/oneui.app.min-5.1.js') }}"></script>
<script src="{{ asset('assets/js/be_pages_dashboard.min.js') }}"></script> --}}
@endpush
