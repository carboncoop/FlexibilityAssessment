@extends('layout')

@section('content')
<div id="app">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register a new Community Group') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="organisation_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of organisation*') }}</label>

                                <div class="col-md-6">
                                    <input id="organisation_name" type="text" class="form-control{{ $errors->has('organisation_name') ? ' is-invalid' : '' }}" name="organisation_name" value="{{ old('organisation_name') }}" required autofocus>

                                    @if ($errors->has('organisation_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organisation_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>                        

                            <div class="form-group row">
                                <label for="organisation_email" class="col-md-4 col-form-label text-md-right">{{ __('Organisation email*') }}</label>

                                <div class="col-md-6">
                                    <input id="organisation_email" type="email" class="form-control{{ $errors->has('organisation_email') ? ' is-invalid' : '' }}" name="organisation_email" value="{{ old('organisation_email') }}" required>

                                    @if ($errors->has('organisation_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organisation_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone*') }}</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="tel" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ old('telephone') }}" required>

                                    @if ($errors->has('telephone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="postcode_zones" class="col-md-4 col-form-label text-md-right">{{ __('Postcode zone(s)*') }}</label>

                                <div class="col-md-6">
                                    <input id="postcode_zones" type="text" class="form-control{{ $errors->has('postcode_zones') ? ' is-invalid' : '' }}" name="postcode_zones" value="{{ old('postcode_zones') }}" required>

                                    @if ($errors->has('postcode_zones'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode_zones') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>    

                            <div class="form-group row">
                                <label for="address1" class="col-md-4 col-form-label text-md-right">{{ __('Address1*') }}</label>

                                <div class="col-md-6">
                                    <input id="address1" type="text" class="form-control{{ $errors->has('address1') ? ' is-invalid' : '' }}" name="address1" value="{{ old('address1') }}" required>

                                    @if ($errors->has('address1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>     

                            <div class="form-group row">
                                <label for="address2" class="col-md-4 col-form-label text-md-right">{{ __('Address 2') }}</label>

                                <div class="col-md-6">
                                    <input id="address2" type="text" class="form-control" name="address2">
                                </div>
                            </div>     

                            <div class="form-group row">
                                <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode zone(s)*') }}</label>

                                <div class="col-md-6">
                                    <input id="postcode" type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postcode') }}" required>

                                    @if ($errors->has('postcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>     

                            <div class="form-group row">
                                <label for="city_town" class="col-md-4 col-form-label text-md-right">{{ __('City/town*') }}</label>

                                <div class="col-md-6">
                                    <input id="city_town" type="text" class="form-control{{ $errors->has('city_town') ? ' is-invalid' : '' }}" name="city_town" value="{{ old('city_town') }}" required>

                                    @if ($errors->has('city_town'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city_town') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>     

                            <div class="form-group row">
                                <label for="contact-person" class="col-md-4 col-form-label text-md-right">{{ __('Contact person')}} <span title="{{ __('A new user will be created. This new user will be administrator of the organisation') }}"><font-awesome-icon icon="question-circle" size="xs" /></span>* </label>

                                <div class="col-md-6">
                                    <input id="contact-person" type="text" class="form-control{{ $errors->has('contact_person_name') ? ' is-invalid' : '' }}" name="contact_person_name" value="{{ old('contact_person_name') }}" required autofocus>

                                    @if ($errors->has('contact_person_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_person_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact_person_email" class="col-md-4 col-form-label text-md-right">{{ __('Contact person email *') }}</label>

                                <div class="col-md-6">
                                    <input id="contact_person_email" type="contact_person_email" class="form-control{{ $errors->has('contact_person_email') ? ' is-invalid' : '' }}" name="contact_person_email" value="{{ old('contact_person_email') }}" required>

                                    @if ($errors->has('contact_person_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_person_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
