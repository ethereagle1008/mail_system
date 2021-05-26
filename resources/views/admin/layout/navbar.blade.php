<?php
    $message_count = \App\Question::where('reply','0')->where('receive_date', '<', date('Y-m-d H:i:s'))->where('type','user_sent')->count();
    $messages = \App\Question::leftjoin('users', 'users.id', 'questions.user_id')->where('reply','0')->where('receive_date', '<', date('Y-m-d H:i:s'))
        ->where('type', 'user_sent')->orderBy('receive_date', 'desc')->paginate(10);
    $user = \App\User::where('id',session()->get(SESS_ADMIN_UID))->get()->first();
?>
<header class="app-header header">

    <!-- Sidebar toggle button-->
    <!-- Navbar Right Menu-->
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{url('/')}}">
                <img alt="vobilet logo" class="header-brand-img" src="{{asset('img/SOKUAI.png')}}">
            </a>

            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="javascript:void(0);"></a>
            <div class="d-flex order-lg-2 ml-auto">
{{--                <div class="dropdown d-none d-md-flex">--}}
{{--                    <a class="nav-link icon" data-toggle="dropdown">--}}
{{--                        <i class="fa fa-bell-o"></i>--}}
{{--                        <span class="nav-unread bg-danger"></span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
{{--                        <a class="dropdown-item d-flex pb-3" href="javascript:void(0);">--}}
{{--                            <div class="notifyimg">--}}
{{--                                <i class="fa fa-thumbs-o-up"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <strong>Someone likes our posts.</strong>--}}
{{--                                <div class="small text-muted">--}}
{{--                                    3 hours ago--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a class="dropdown-item d-flex pb-3" href="javascript:void(0);">--}}
{{--                            <div class="notifyimg">--}}
{{--                                <i class="fa fa-commenting-o"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <strong>3 New Comments</strong>--}}
{{--                                <div class="small text-muted">--}}
{{--                                    5 hour ago--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a class="dropdown-item d-flex pb-3" href="javascript:void(0);">--}}
{{--                            <div class="notifyimg">--}}
{{--                                <i class="fa fa-cogs"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <strong>Server Rebooted.</strong>--}}
{{--                                <div class="small text-muted">--}}
{{--                                    45 mintues ago--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a class="dropdown-item text-center text-muted-dark" href="javascript:void(0);">View all Notification</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon" data-toggle="dropdown"><i class="fa fa-envelope-o"></i> <span class=" nav-unread badge badge-info badge-pill">{{$message_count}}</span></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item text-center text-dark" href="javascript:void(0);">{{$message_count}} 新規メッセージ</a>
                        <div class="dropdown-divider"></div>
                        @foreach($messages as $message)

                            <a class="dropdown-item d-flex pb-3" href="{{$message->character_id != 0 ? url('/manage/reply-message') : ''}} ">
                                <span class="avatar brround mr-3 align-self-center" style="background-image: url(images/faces/male/41.jpg)"></span>
                                <div class="line-clamp" style="width: 150px !important; height: 36px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                    <strong>{{$message->name}}</strong> {{$message->content}}}....
                                    <div class="small text-muted">
                                        {{$message->receive_date}}
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        <div class="dropdown-divider"></div>
{{--                        <a class="dropdown-item text-center text-muted-dark" href="javascript:void(0);">See all Messages</a>--}}
                    </div>
                </div>
                <div class="dropdown">
                    <a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="javascript:void(0);">
                        <span class="avatar avatar-md brround" style="background-image: url(../images/profile.jpg)"></span>
                        <span class="ml-2 d-none d-lg-block">
											<span class="text-white">{{$user->name}}</span>
										</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
{{--                        <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon mdi mdi-settings"></i> Settings</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0);"><span class="float-right"><span class="badge badge-primary">6</span></span> <i class="dropdown-icon mdi mdi-message-outline"></i> Inbox</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message</a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
                        <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dropdown-icon mdi mdi-logout-variant"></i> ログアウト</a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
