@extends('layouts.app2')

@section('content2')
        <!-- Contact Section-->
        <section class="page-section masthead" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Edytujesz klienta {{ $customer->id }}</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form action="{{ route('customers.update', ['klienci' => $customer->id]) }}" method="POST" id="contactForm" name="sentMessage" novalidate="novalidate">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Nazwa klienta</label>
                                    <input value="{{ $customer->name }}" class="form-control" id="name" name="name" type="text" placeholder="Nazwa" required="required" data-validation-required-message="Wpisz numer faktury." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Data wystawienia</label>
                                    <input value="{{ $customer->address }}" class="form-control" id="address" name="address" type="text" placeholder="Adres klienta" required="required" data-validation-required-message="Wprowadź datę." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Kwota</label>
                                    <input value="{{ $customer->nip }}" class="form-control" id="nip" name="nip" type="text" placeholder="Numer NIP" required="required" data-validation-required-message="Wprowadź kwotę." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Zapisz dane klienta</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection