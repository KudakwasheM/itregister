<?php
/**
 * Created by vscode for itreg
 * User: Tadiwa Dauya
 * Date: 6/25/2021
 * Time: 9:04 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Showing All Beitbridge O365 Accounts
@endsection

@section('head')
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets\pages\data-table\css\buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets\pages\data-table\extensions\select\css\select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets\pages\data-table\extensions\buttons\css\buttons.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Beitbridge O365</h4>
                        <span>Beitbridge O365 user accounts</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/home') }}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/beitaccounts') }}">Beitbridge O365</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="card">
            <div class="card-header">
                <h5>Beitbridge O365</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <a href="{{ url('beitaccounts/create') }}" class="btn btn-round btn-light float-right">
                            <i class="feather icon-plus" aria-hidden="true"></i>
                            Add Beitbridge O365 Account
                        </a>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="vince-tables" class="table table-striped table-bordered nowrap">
                        <thead class="thead">
                            <tr>
                                <th>Employee</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Previous Password</th>
                                <th>Last Edited by</th>
                                <th class="no-search no-sort notexport">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beitaccounts as $beitaccount)
                                <tr>
                                    <td>{{ $beitaccount->user }}</td>
                                    <td>{{ $beitaccount->email }}</td>
                                    <td>{{ $beitaccount->password }}</td>
                                    <td>{{ $beitaccount->prev_password }}</td>
                                    <td>{{ $beitaccount->last_agent }}</td>
                                    <td style="white-space: nowrap;">
                                        {!! Form::open(['url' => 'beitaccounts/' . $beitaccount->id, 'class' => 'btn btn-mini']) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<i class="feather icon-trash-2"></i>', [
                                            'class' => 'btn btn-danger btn-mini',
                                            'type' => 'button',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#confirmDelete',
                                            'data-title' => 'Delete Beitbridge O365 Acoount',
                                            'data-message' => 'Are you sure you want to delete this account ?',
                                        ]) !!}
                                        {!! Form::close() !!}

                                        {{-- <a class="btn btn-success btn-mini" href="{{ URL::to('beitaccounts/' . $beitaccount->id) }}" >
                                        <i class="feather icon-eye"></i>
                                    </a> --}}

                                        <a class="btn btn-primary btn-mini"
                                            href="{{ URL::to('beitaccounts/' . $beitaccount->id . '/edit') }}">
                                            <i class="feather icon-edit"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('modals.modal-delete')
@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    <!-- data-table js -->
    <script src="{{ asset('bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\js\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\js\pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\js\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\buttons\js\buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\buttons\js\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\buttons\js\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\buttons\js\buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\select\js\dataTables.select.min.js') }}"></script>
    <script src="{{ asset('bower_components\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
    <script src="{{ asset('bower_components\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
    <script src="{{ asset('bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets\pages\data-table\extensions\select\js\select-custom.js') }}"></script>

    <script src="{{ asset('assets\pages\data-table\extensions\buttons\js\extension-btns-custom.js') }}"></script>
@endsection
