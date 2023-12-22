@extends('admin.main')
@section('content')
    <div class="dash-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="dash-bookings">
                        <div class="act-title">
                            <h5>Bookings</h5>
                        </div>
                        <div class="db-booking-wrap table-content table-responsive">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date/Time</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Property</th>
                                    <th scope="col">User Info</th>
                                    <th scope="col">Exception</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach($notifications as $notification)
                                <tr class="bg-white">
                                    <th scope="row">{{++$i}}</th>
                                    <td>{{$notification->data['date']}}</td>
                                    <td>{{$notification->data['name']}}</td>
                                    <td>
                                        <div class="property-title-box">
                                            <h4><a href="single-listing-one.html">{{$notification->data['title']}}</a></h4>
                                            <div class="property-location">
                                                <i class="las la-map-marker-alt"></i>
                                                <p>{{$notification->data['address']}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="list">
                                            <li>
                                                <div class="contact-info">
                                                    <div class="text"><a href="tel:44078767595">{{$notification->data['phone']}}</a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="contact-info">
                                                    <div class="text"><a href="#">{{$notification->data['email']}}</a></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="listing-button">
                                            <a href="#" class="btn v3">Cancel</a>
                                            <a href="#" class="btn v4">Approve</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection