@extends('layouts.master')

@section('title')
    Bootstrap Maxlength
@endsection

@section('topbar-title')
    Forms
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bootstrap maxlength</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        <strong>Bootstrap Maxlength</strong> a visual feedback indicator for the maxlength attribute.
                        <strong>Bootstrap Maxlength</strong> uses a Bootstrap's badge to show a visual feedback to the user
                        about the maximum length of the field where the user is inserting text. Visit <a
                            href="http://mimo84.github.io/bootstrap-maxlength" target="_blank">Bootstrap Maxlength's page</a>
                        to look more
                        examples and references.
                    </p>
                    <div class="d-grid gap-3">
                        <div class="row">
                            <div class="col-sm-4 col-lg-2">
                                <label class="col-form-label text-sm-end">Basic demo</label>
                            </div>
                            <div class="col-sm-5 col-lg-5"><input type="text" class="form-control" id="maxlength-1"
                                    maxlength="5" placeholder="Type here..." /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-lg-2">
                                <label class="col-form-label text-sm-end">Threshold</label>
                            </div>
                            <div class="col-sm-5 col-lg-5">
                                <div class="mb-2"><input type="text" class="form-control" id="maxlength-2"
                                        maxlength="8" placeholder="Type here..." /></div>
                                <p class="mb-0">Use the <code>threshold</code> option to show up badge when there are some
                                    chars</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-lg-2">
                                <label class="col-form-label text-sm-end">Always show</label>
                            </div>
                            <div class="col-sm-5 col-lg-5">
                                <div class="mb-2"><input type="text" class="form-control" id="maxlength-3"
                                        maxlength="8" placeholder="Type here..." /></div>
                                <p class="mb-0">If the <code>alwaysShow</code> option is enabled, the
                                    <code>threshold</code> option is ignored.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-lg-2">
                                <label class="col-form-label text-sm-end">Custom text</label>
                            </div>
                            <div class="col-sm-5 col-lg-5">
                                <div class="mb-2"><input type="text" class="form-control" id="maxlength-4"
                                        maxlength="8" placeholder="Type here..." /></div>
                                <p class="mb-0">Set and combine <code>separator</code>, <code>preText</code> and
                                    <code>postText</code> classes to set custom message to the badge.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-lg-2">
                                <label class="col-form-label text-sm-end">Positions</label>
                            </div>
                            <div class="col-sm-5 col-lg-5">
                                <div class="d-grid gap-3">
                                    <input type="text" class="form-control" id="maxlength-5" maxlength="8"
                                        placeholder="Top right" />
                                    <input type="text" class="form-control" id="maxlength-6" maxlength="8"
                                        placeholder="Bottom right" />
                                    <input type="text" class="form-control" id="maxlength-7" maxlength="8"
                                        placeholder="Top left" />
                                    <input type="text" class="form-control" id="maxlength-8" maxlength="8"
                                        placeholder="Bottom left" />
                                </div>
                            </div>
                        </div>
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
    <!-- bs custom file input plugin -->
    <script src="{{ URL::asset('build/libs/bootstrap-maxlength/dist/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-bs-maxlength.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
