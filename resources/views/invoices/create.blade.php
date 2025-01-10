@extends('layouts.app2')

@section('content2')
        <!-- Contact Section-->
        <section class="page-section masthead" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Dodaj Fakturę</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form action="{{ route('invoices.store') }}" method="POST" id="contactForm" name="sentMessage" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Wybierz klienta</label>
                                </div>
                                <select name="customer" value="{{ old('customer') }} class="custom-select" id="customer000">
                                    <option selected>Wybierz...</option>
                                    @foreach (\App\Customer::all() as $item)
                                    <option value="{{ $item->id  }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Numer faktury</label>
                                    <input class="form-control" id="number" value="{{ old('number') }}" name="number" type="text" placeholder="Numer faktury" data-validation-required-message="Wpisz numer faktury." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Data wystawienia</label>
                                    <input class="form-control" id="date" value="{{ old('date') }}" name="date" type="text" placeholder="Data wystawienia" data-validation-required-message="Wprowadź datę." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Kwota</label>
                                    <input class="form-control" id="total" value="{{ old('total') }}" name="total" type="text" placeholder="Kwota faktury" data-validation-required-message="Wprowadź kwotę." /><!<!-- required="required"  -->
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Dodaj fakturę</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection