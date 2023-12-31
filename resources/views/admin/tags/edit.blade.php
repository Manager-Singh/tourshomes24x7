@extends('admin.main')
@section('content')
    <div class="dash-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="db-add-list-wrap">
                        <div class="act-title">
                            <h5>Edit Category :</h5>
                        </div>
                        <div class="db-add-listing">
                            <form action="{{route('admin.tags.update',$tag->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="locale" value="{{$locale}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input type="text" name="name" @if(isset($tagTranslation->name)) value="{{$tagTranslation->name}}" @else value="" @endif class="form-control filter-input" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select class="listing-input hero__form-input  form-control custom-select" name="status">
                                            <option>Select</option>
                                            <option value="1" {{$tag->status == 1 ? 'selected': ''}}>Published</option>
                                            <option value="0" {{$tag->status == 0 ? 'selected': ''}}>Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order:</label>
                                            <input type="number" name="order" class="form-control filter-input" value="{{$tag->order}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-5">
                                        <div class="add-btn">
                                            <button class="btn v3">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection