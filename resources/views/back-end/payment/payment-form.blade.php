<div class="container payment-form">
    <div class="row">
        <article class="card">
            <div class="card-body p-5">
                {{--<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">--}}
                            {{--<i class="fa fa-credit-card"></i> Credit Card</a></li>--}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
                            <i class="fab fa-paypal"></i> Paypal</a></li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">--}}
                            {{--<i class="fa fa-university"></i> Bank Transfer</a></li>--}}
                {{--</ul>--}}

                <div class="tab-content">
                    {{--<div class="tab-pane fade show active" id="nav-tab-card">--}}
                        {{--<p class="alert alert-success">Some text success or error</p>--}}
                        {{--<form role="form" action="{{url('addmoney/postPaymentWithNmi')}}" method="post">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>First name</label>--}}
                                        {{--<input type="text" class="form-control" name="firstname" placeholder=""--}}
                                               {{--required="">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Last name</label>--}}
                                        {{--<input type="text" class="form-control" name="lastname" placeholder=""--}}
                                               {{--required="">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="cardNumber">Card number</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<input type="text" class="form-control" name="ccnumber" placeholder="" required="">--}}
                                    {{--<div class="input-group-append">--}}
                                        {{--<span class="input-group-text text-muted">--}}
                                            {{--<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  --}}
                                            {{--<i class="fab fa-cc-mastercard"></i>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label><span class="hidden-xs">Expiration</span> </label>--}}
                                        {{--<div class="input-group">--}}
                                            {{--<input type="number" class="form-control" placeholder="MM" name="ccexpmm" required="">--}}
                                            {{--<input type="number" class="form-control" placeholder="YY" name="ccexpyy" required="">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-4">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label data-toggle="tooltip" title=""--}}
                                               {{--data-original-title="3 digits code on back side of the card">CVV <i--}}
                                                    {{--class="fa fa-question-circle"></i></label>--}}
                                        {{--<input type="number" class="form-control" required="" name="cvv">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                          {{--<button class="subscribe btn btn-primary btn-block" type="submit"> Confirm</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    <div class="tab-pane fade" id="nav-tab-paypal">
                        <p>Paypal is easiest way to pay online</p>
                        <p>
                            <a href="{{{url('paypal/ec-checkout')}}}">
                                <button type="button" class="btn btn-primary">
                                    <i class="fab fa-paypal"></i> Log in Paypal
                                </button>
                            </a>
                        </p>
                    </div>
                    {{--<div class="tab-pane fade" id="nav-tab-bank">--}}
                        {{--<p>Bank accaunt details</p>--}}
                        {{--<dl class="param">--}}
                            {{--<dt>BANK:</dt>--}}
                            {{--<dd> THE WORLD BANK</dd>--}}
                        {{--</dl>--}}
                        {{--<dl class="param">--}}
                            {{--<dt>Accaunt number:</dt>--}}
                            {{--<dd> 12345678912345</dd>--}}
                        {{--</dl>--}}
                        {{--<dl class="param">--}}
                            {{--<dt>IBAN:</dt>--}}
                            {{--<dd> 123456789</dd>--}}
                        {{--</dl>--}}
                        {{--<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do--}}
                            {{--eiusmod--}}
                            {{--tempor incididunt ut labore et dolore magna aliqua. </p>--}}
                    {{--</div> <!-- tab-pane.// -->--}}
                </div> <!-- tab-content .// -->

            </div> <!-- card-body.// -->
        </article> <!-- card.// -->
    </div> <!-- row.// -->
</div>
