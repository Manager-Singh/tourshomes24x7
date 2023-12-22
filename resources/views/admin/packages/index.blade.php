@extends('admin.main')
@section('content')
    <div class="dash-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-panel">
                        <div class="act-title d-flex justify-content-between">
                            <h5>Packages</h5><br>

                            <a href="{{route('admin.packages.create')}}" class="btn v3">Create New Package</a>
                        </div>

                        <div class="invoice-body">
                            <div class="table-responsive">
                                <table class="invoice-table table" id="package_table">
                                    <thead>
                                    <tr class="invoice-headings">
                                        <th style="max-width:100px">Action</th>
                                        <th>Package Name</th>
                                        <th>Package Type</th>
                                        <th>Property Listing</th>
                                        <th>Price</th>
                                        <th>Credit/Post</th>
                                        <th>Is Featured</th>
                                        <th>Validity</th>
                                        <th style="max-width:100px">Status</th>

                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function($){
            "use strict";
            $('#package_table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax:{
                    url: "{{  route('admin.packages.index') }}"
                },
                columns:[
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'package_type',
                        name: 'package_type'
                    },
                    {
                        data: 'listing',
                        name: 'listing'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'credits',
                        name: 'credits'
                    },
                    {
                        data: 'is_featured',
                        name: 'is_featured'
                    },
                    {
                        data: 'validity',
                        name: 'validity'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]
            });
        })(jQuery);
    </script>
@endpush