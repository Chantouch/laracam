<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/15/2017
 * Time: 10:58 PM
 */
?>
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i
                            class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span>
            </h3></div>
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <a href="#" class="waves-effect"><img src="{!! asset('images/users/varun.jpg') !!}" alt="user-img"
                                                      class="img-circle"> <span class="hide-menu"> Steve Gection<span
                                class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <li><a href="javascript:void(0)"><i class="ti-user"></i> <span
                                    class="hide-menu">My Profile</span></a></li>
                    <li><a href="javascript:void(0)"><i class="ti-wallet"></i> <span class="hide-menu">My Balance</span></a>
                    </li>
                    <li><a href="javascript:void(0)"><i class="ti-email"></i> <span
                                    class="hide-menu">Inbox</span></a></li>
                    <li><a href="javascript:void(0)"><i class="ti-settings"></i> <span
                                    class="hide-menu">Account Setting</span></a>
                    </li>
                    <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> <span
                                    class="hide-menu">Logout</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="index.html" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Dashboard <span class="fa arrow"></span> <span
                                class="label label-rouded label-inverse pull-right">4</span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="index.html"><i class=" fa-fw">1</i><span
                                    class="hide-menu">Dashboard 1</span></a></li>
                    <li><a href="index2.html"><i class=" fa-fw">2</i><span class="hide-menu">Dashboard 2</span></a>
                    </li>
                    <li><a href="index3.html"><i class=" fa-fw">3</i><span class="hide-menu">Dashboard 3</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="mdi mdi-av-timer fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Ref.Master Data <span class="fa arrow"></span>
                        <span class="label label-rouded label-inverse pull-right">4</span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="#">
                            <i class="fa-fw">1</i>
                            <span class="hide-menu">Dashboard 1</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{!! Request::is('admin/manage/*')? 'active' : '' !!}">
                <a href="javascript:void(0)" class="waves-effect {!! Request::is('admin/manage/*')? 'active' : '' !!}">
                    <i class="mdi mdi-content-copy fa-fw"></i>
                    <span class="hide-menu">Manage<span class="fa arrow"></span>
                        <span class="label label-rouded label-warning pull-right">30</span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('admin.manage.user.index') !!}"
                           class="{!! Request::is('admin/manage/user*')? 'active' : '' !!}">
                            <i class="ti-layout-width-default fa-fw"></i>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.manage.role.index') !!}">
                            <i class="ti-layout-sidebar-left fa-fw"></i>
                            <span class="hide-menu">Role</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.manage.permission.index') !!}">
                            <i class="ti-layout-sidebar-left fa-fw"></i>
                            <span class="hide-menu">Permission</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="waves-effect">
                            <i class="ti-email fa-fw"></i>
                            <span class="hide-menu">Email Templates</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">
                                    <i class="fa-fw">B</i>
                                    <span class="hide-menu">Basic</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect">
                    <i class="mdi mdi-logout fa-fw"></i>
                    <span class="hide-menu">Log out</span>
                </a>
            </li>
            <li class="devider"></li>
        </ul>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->