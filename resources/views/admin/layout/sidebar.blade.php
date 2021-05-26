<!-- Sidebar -->
<?php
if(!empty(session()->get(SESS_ADMIN_UID))){
    $user = \App\User::where('id',session()->get(SESS_ADMIN_UID))->get()->first();
}
?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar ">
    <div class="app-sidebar__user">
        <div class="dropdown">
            <a class="nav-link p-0 leading-none d-flex" data-toggle="dropdown" href="javascript:void(0);">
                <span class="avatar avatar-md brround" style="background-image: url(../images/profile.jpg)"></span>
                <span class="ml-2 "><span class="text-dark app-sidebar__user-name font-weight-semibold">{{$user->name}}</span><br>
									<span class="text-muted app-sidebar__user-name text-sm">管理者</span>
								</span>
            </a>
{{--            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
{{--                <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>--}}
{{--                <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dropdown-icon mdi mdi-logout-variant"></i> Sign out</a>--}}
{{--            </div>--}}
        </div>
    </div>
    <ul class="side-menu">
{{--        <li class="slide">--}}
{{--            <a class="side-menu__item {{$tab == 'home' ? 'active' : ''}}" href="javascript:void(0);"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">DASHBOARD</span></a>--}}
{{--        </li>--}}
        <li>
            <a class="side-menu__item {{$tab == 'search-members' ? 'active' : ''}}" href="{{url('/manage/search-members')}}"><i class="side-menu__icon fa fa-address-book"></i><span class="side-menu__label">メンバー検索</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'character-register' ? 'active' : ''}}" href="{{url('/manage/character-register')}}"><i class="side-menu__icon fa fa-user-plus"></i><span class="side-menu__label">キャラ登録</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'search-characters' ? 'active' : ''}}" href="{{url('/manage/search-characters')}}"><i class="side-menu__icon fa fa-list-alt"></i><span class="side-menu__label">キャラ検索</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'total-sales' ? 'active' : ''}}" href="{{url('/manage/total-sales')}}"><i class="side-menu__icon fa fa-jpy"></i><span class="side-menu__label">売上集計</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'pay-list' ? 'active' : ''}}" href="{{url('/manage/pay-list')}}"><i class="side-menu__icon fa fa-signal"></i><span class="side-menu__label">課金一覧</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'csv-import' ? 'active' : ''}}" href="{{url('/manage/csv-import')}}"><i class="side-menu__icon fa fa-file-text-o"></i><span class="side-menu__label">CSVインポート</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'auto-message' ? 'active' : ''}}" href="{{url('/manage/auto-message')}}"><i class="side-menu__icon fa fa-envelope-open-o"></i><span class="side-menu__label">同報作成</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'auto-list' ? 'active' : ''}}" href="{{url('/manage/auto-list')}}"><i class="side-menu__icon fa fa-envelope"></i><span class="side-menu__label">予約メッセージ</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'reply-message' ? 'active' : ''}}" href="{{url('/manage/reply-message')}}"><i class="side-menu__icon fa fa-commenting-o"></i><span class="side-menu__label">メール返信</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'dig-user' ? 'active' : ''}}" href="{{url('/manage/dig-user')}}"><i class="side-menu__icon fa fa-binoculars"></i><span class="side-menu__label">掘り起こし</span></a>
        </li>
        <li>
            <a class="side-menu__item {{$tab == 'ad-total' ? 'active' : ''}}" href="{{url('/manage/ad-total')}}"><i class="side-menu__icon fa fa-audio-description"></i><span class="side-menu__label">広告集計</span></a>
        </li>
    </ul>
</aside>
<!-- Sidebar menu-->
