@extends('layouts.master')

@section('title')
    List Group
@endsection

@section('topbar-title')
    Elements
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Variation</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">List groups are a flexible and powerful component for displaying a series of
                        content. Modify and extend them to support just about any content within.</p>
                    <p class="text-muted">Add <code>.list-group-flush</code> to remove some borders and rounded corners to
                        render list group items edge-to-edge in a parent container (e.g., cards).</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="card border mb-0">
                                <div class="card-header card-header-bordered">
                                    <h3 class="card-title">Default</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">An item</li>
                                        <li class="list-group-item">A second item</li>
                                        <li class="list-group-item">A third item</li>
                                        <li class="list-group-item">A fourth item</li>
                                        <li class="list-group-item">And a fifth one</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border mb-0">
                                <div class="card-header card-header-bordered">
                                    <h3 class="card-title">Flush</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">An item</li>
                                        <li class="list-group-item">A second item</li>
                                        <li class="list-group-item">A third item</li>
                                        <li class="list-group-item">A fourth item</li>
                                        <li class="list-group-item">And a fifth one</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Contextual color</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Use contextual classes to style list items with a stateful background and color.
                    </p>
                    <div class="list-group"><a href="#" class="list-group-item list-group-item-action">A simple
                            default list group item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-primary">A simple primary list
                            group item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-secondary">A simple secondary list
                            group item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-success">A simple success list
                            group item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-danger">A simple danger list group
                            item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-warning">A simple warning list
                            group item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-info">A simple info list group
                            item</a> <a href="#"
                            class="list-group-item list-group-item-action list-group-item-light">A simple light list group
                            item</a> <a href="#" class="list-group-item list-group-item-action list-group-item-dark">A
                            simple dark list group item</a></div>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Horizontal</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Add <code>.list-group-horizontal</code> to change the layout of list group items
                        from vertical to horizontal across all breakpoints. Alternatively, choose a responsive variant
                        <code>.list-group-horizontal-{sm|md|lg|xl|xxl}</code> to make a list group horizontal starting at
                        that breakpoint’s <code>min-width</code>. Currently <strong>horizontal list groups cannot be
                            combined with flush list groups.</strong>
                    </p>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                    </ul>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Checkboxes and radios</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Place Bootstrap’s checkboxes and radios within list group items and customize as
                        needed. You can use them without <code>&lt;label&gt;</code>s.</p>
                    <ul class="list-group">
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox" value="">
                            First checkbox</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox" value="">
                            Second checkbox</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox" value="">
                            Third checkbox</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox" value="">
                            Fourth checkbox</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox" value="">
                            Fifth checkbox</li>
                    </ul>
                    <p class="mt-3">And if you want <code>&lt;label&gt;</code>s as the <code>.list-group-item</code> for
                        large hit areas, you can do that, too.</p>
                    <ul class="list-group">
                        <li class="list-group-item"><input class="form-check-input me-2" type="radio"
                                name="list-group-radios" value=""> First radio</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="radio"
                                name="list-group-radios" value=""> Second radio</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="radio"
                                name="list-group-radios" value=""> Third radio</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="radio"
                                name="list-group-radios" value=""> Fourth radio</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="radio"
                                name="list-group-radios" value=""> Fifth radio</li>
                    </ul>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Links and buttons</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Use <code>&lt;a&gt;</code>s or <code>&lt;button&gt;</code>s to create
                        <em>actionable</em> list group items with hover, disabled, and active states by adding
                        <code>.list-group-item-action</code>. We separate these pseudo-classes to ensure list groups made of
                        non-interactive elements (like <code>&lt;li&gt;</code>s or <code>&lt;div&gt;</code>s) don’t provide
                        a click or tap affordance.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="card border mb-0">
                                <div class="card-header card-header-bordered">
                                    <h3 class="card-title">Links</h3>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action active">The
                                            current link item</a>
                                        <a href="#" class="list-group-item list-group-item-action">A second link
                                            item</a>
                                        <a href="#" class="list-group-item list-group-item-action">A third link
                                            item</a>
                                        <a href="#" class="list-group-item list-group-item-action">A fourth link
                                            item</a>
                                        <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="card border mb-0">
                                <div class="card-header card-header-bordered">
                                    <h3 class="card-title">Buttons</h3>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <button type="button" class="list-group-item list-group-item-action active">The
                                            current button</button>
                                        <button type="button" class="list-group-item list-group-item-action">A second
                                            item</button>
                                        <button type="button" class="list-group-item list-group-item-action">A third
                                            button item</button>
                                        <button type="button" class="list-group-item list-group-item-action">A fourth
                                            button item</button>
                                        <button type="button" class="list-group-item list-group-item-action"
                                            disabled="disabled">A disabled button item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">States</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Add <code>.active</code> to a <code>.list-group-item</code> to indicate the
                        current active selection.</p>
                    <p class="text-muted">Add <code>.disabled</code> to a <code>.list-group-item</code> to make it
                        <em>appear</em> disabled. Note that some elements with <code>.disabled</code> will also require
                        custom JavaScript to fully disable their click events (e.g., links).
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item active">An active item</li>
                        <li class="list-group-item disabled">A disabled item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
                    </ul>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Numbered</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Add the <code>.list-group-numbered</code> modifier class (and optionally use an
                        <code>&lt;ol&gt;</code> element) to opt into numbered list group items. Numbers are generated via
                        CSS (as opposed to a <code>&lt;ol&gt;</code>s default browser styling) for better placement inside
                        list group items and to allow for better customization.
                    </p>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">A list item</li>
                        <li class="list-group-item">A list item</li>
                        <li class="list-group-item">A list item</li>
                    </ol>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Badges</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Add <a href="ui-badge.html" class="text-decoration-underline">Badges</a> to any
                        list group item to show unread counts, activity, and more with the help of some
                        <strong>utilities</strong>.
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">A list item <span
                                class="badge badge-primary rounded-pill">14</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">A second list item
                            <span class="badge badge-primary rounded-pill">2</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">A third list item
                            <span class="badge badge-primary rounded-pill">1</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Additional content</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Add nearly any HTML within, even for linked list groups like the one below, with
                        the help of <strong>flexbox utilities</strong>.</p>
                    <div class="list-group"><a href="#" class="list-group-item list-group-item-action active"
                            aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content in a paragraph.</p>
                            <small>And some small print.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content in a paragraph.</p>
                            <small class="text-muted">And some muted small print.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content in a paragraph.</p>
                            <small class="text-muted">And some muted small print.</small>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('scripts')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
