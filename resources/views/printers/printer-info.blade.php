<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/19/2020
 * Time: 2:12 PM
 */
?>
@extends('layouts.app')

@section('template_title')
    Printer Info
@endsection

@section('head')
@endsection

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Printers</h4>
                        <span>Printer Details</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/home') }}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/printers') }}">Printers</a></li>
                        <li class="breadcrumb-item"><a href="#!">Printer Info</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card product-detail-page">
                    <div class="card-header">
                        <h5>{{ $printer->assettag }} Details</h5>
                        <span>Printer assigned to @if (!$yuser)
                                {{ $asset->username }}
                                @else{{ $yuser->first_name }} {{ $yuser->last_name }}
                            @endif
                        </span>
                        <div class="card-header-right">
                            <a href="{{ url('/printers') }}" class="btn btn-round btn-light float-right">
                                <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                                Back to Printers
                            </a>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12 product-detail" id="product-detail">
                                    <div class="col-lg-12">
                                        <span class="txt-muted d-inline-block">Printer Asset Tag:
                                            <strong>{{ $printer->assettag }}</strong> </span>
                                        <span class="f-right">Asset Age : {{ $asset->age }} </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="pro-desc">{{ $asset->model }}</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <table>
                                            <tr>
                                                <td>Assigned to :</td>
                                                <td>
                                                    <strong>
                                                        @if (!$yuser)
                                                            {{ $asset->username }}
                                                        @else
                                                            {{ $yuser->first_name }} {{ $yuser->last_name }}
                                                        @endif
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Serial Number :</td>
                                                <td><strong>{{ $asset->serial }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Brand :</td>
                                                <td><strong>{{ $printer->brand }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Model :</td>
                                                <td><strong>{{ $printer->model }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Device Type :</td>
                                                <td><strong>{{ $printer->type }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Purchased On :</td>
                                                <td><strong>{{ $asset->purchased }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Warranty :</td>
                                                <td><strong>{{ $asset->warranty }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Added On :</td>
                                                <td><strong>{{ $asset->created_at }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('modals.modal-delete')
@endsection

@section('footer_scripts')
@endsection
