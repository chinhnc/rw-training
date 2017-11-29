@extends('layouts.app')

@section('pageTitle', '問い合わせ')

@section('content')
    <div class="page-header" style="background: url(/assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title">問い合わせ</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="title-2">
                        何も問い合わせましょう
                    </h2>

                    <form id="contactForm" class="contact-form" action="{{ route('contact.store') }}" method="POST" data-toggle="validator" novalidate="true">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <input type="email" class="form-control" id="email" placeholder="メール" required="" data-error="メールをを入力してください">
                                            <div class="help-block with-errors"></div>
                                            <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <input type="text" class="form-control" id="tel" name="tel" placeholder="電話番号" required="" data-error="電話番号を入力してください">
                                            <div class="help-block with-errors"></div>
                                            <span class="material-input"></span></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <input type="text" class="form-control" id="subject" placeholder="件名" required="" data-error="件名を入力してください">
                                            <div class="help-block with-errors"></div>
                                            <span class="material-input"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group is-empty">
                                            <textarea id="msg_content" class="form-control" placeholder="コンテンツ" rows="10" data-error="問い合わせの内容を入力してください" required=""></textarea>
                                            <div class="help-block with-errors"></div>
                                            <span class="material-input"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" id="submit" class="btn btn-common disabled" style="pointer-events: all; cursor: pointer;">送信</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h2 class="title-2">
                        Contact Information
                    </h2>
                    <div class="information">
                        <div class="contact-datails">
                            <div class="icon">
                                <i class="fa fa-map-marker icon-radius"></i>
                            </div>
                            <div class="info">
                                <h3>Address</h3>
                                <span class="detail">Main Office: NO.22-23 Street Name- City,Country</span>
                                <span class="datail">Customer Center: NO.130-45 Streen Name- City, Country</span>
                            </div>
                        </div>
                        <div class="contact-datails">
                            <div class="icon">
                                <i class="fa fa-phone icon-radius"></i>
                            </div>
                            <div class="info">
                                <h3>Phone Numbers</h3>
                                <span class="detail">Main Office: +880 123 456 789</span>
                                <span class="datail">Customer Supprort: +880 123 456 789 </span>
                            </div>
                        </div>
                        <div class="contact-datails">
                            <div class="icon">
                                <i class="fa fa-location-arrow icon-radius"></i>
                            </div>
                            <div class="info">
                                <h3>Email Address</h3>
                                <span class="detail">Customer
Support: info©mail.com</span>
                                <span class="detail">Technical Support: support©mail.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('assets/js/form-validator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/contact-form-script.js') }}"></script>
@endsection
