@extends('admin.main')
@section('content')
    <div class="dash-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="inbox-wrap">
                        <div class="act-title">
                            <h5>Inbox</h5>
                        </div>
                        <div class="au-inbox-wrap js-inbox-wrap">
                            <div class="au-message js-list-load">
                                <div class="au-message-list">
                                    @foreach($notifications as $notification)
                                    <div class="au-message__item unread">
                                        <div class="au-message__item-inner">
                                            <div class="au-message__item-text">
                                                <div class="avatar-wrap">
                                                    <div class="avatar">
                                                        <img loading="lazy" src="{{asset('images/agents/agent.jpg')}}" alt="John Smith">
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <h5 class="name">{{$notification->data['name']}}</h5>
                                                    <p>{{$notification->data['message']}}</p>
                                                </div>
                                            </div>
                                            <div class="au-message__item-time">
                                                <span>12 Min ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                        @foreach($oldNotifications as $notification)
                                            @if($notification->read_at != null)
                                            <div class="au-message__item">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap">
                                                            <div class="avatar">
                                                                <img loading="lazy" src="{{asset('images/agents/agent.jpg')}}" alt="John Smith">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">{{$notification->data['name']}}</h5>
                                                            <p>{{$notification->data['message']}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>12 Min ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    <div class="au-message__footer">
                                        <button class="btn v1">Load more</button>
                                    </div>
                                </div>
                            </div>
                            <div class="au-chat">
                                <div class="au-chat__title">
                                    <div class="au-chat-info">
                                        <div class="avatar-wrap online">
                                            <div class="avatar avatar--small">
                                                <img loading="lazy" src="images/others/2.jpg" alt="John Smith">
                                            </div>
                                        </div>
                                        <span class="nick">
                                                    <a href="#">Sarah Conor</a>
                                                </span>
                                    </div>
                                </div>
                                <div class="au-chat__content">
                                    <div class="recei-mess-wrap">
                                        <div class="recei-mess__inner">
                                            <div class="avatar avatar--tiny">
                                                <img loading="lazy" src="images/others/2.jpg" alt="...">
                                            </div>
                                            <div class="recei-mess-list">
                                                <div class="recei-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="send-mess-wrap">
                                        <div class="send-mess__inner">
                                            <div class="send-mess-list">
                                                <div class="send-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                <div class="send-mess"> ipsum elit non iaculis</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recei-mess-wrap">
                                        <div class="recei-mess__inner">
                                            <div class="avatar avatar--tiny">
                                                <img loading="lazy" src="images/others/2.jpg" alt="John Smith">
                                            </div>
                                            <div class="recei-mess-list">
                                                <div class="recei-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                <div class="recei-mess">Donec tempor, sapien ac viverra</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="send-mess-wrap">
                                        <div class="send-mess__inner">
                                            <div class="send-mess-list">
                                                <div class="send-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-chat-textfield">
                                    <form class="au-form-icon">
                                        <input class="au-input au-input--full au-input--h65" type="textarea" placeholder="Type a message">
                                        <div class="mess-btn mar-top-20">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="db-messages.html" class="float-left btn v3">Back</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="#" class="float-right btn v3"> Send message</a>
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
        </div>
    </div>
@endsection