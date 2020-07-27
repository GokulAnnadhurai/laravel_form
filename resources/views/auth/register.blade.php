@extends('layouts.app')

@section('content')

<div class="container">
     @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    @if (session('warning'))
      <div class="alert alert-warning">
        {{ session('warning') }}
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="DetailsForm" method="POST" action="{{ route('register') }}" class="form-validate-jquery" data-parsley-validate name="form" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{old('mobile')}}"required >

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="image" id="image" class="form-control" required>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea  id="address" type="textarea" class="form-control " name="address"required autocomplete="address">{{old('address')}}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <select  required="required" name="city" id="city" class="form-control">
                                        <option value="">Select city</option>
                                        <option value="chennai" {{ old('city') == 'chennai' ? 'selected' : '' }} >Chennai</option>
                                        <option value="namakkal" {{ old('city') == 'namakkal' ? 'selected' : '' }}>Namakkal</option>
                                        <option value="erode" {{ old('city') == 'erode' ? 'selected' : '' }}>Erode</option>
                                        <option value="salem" {{ old('city') == 'salem' ? 'selected' : '' }}>Salem</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                <select  required="required" name="state" id="state" class="form-control">
                                        <option value="">Select state</option>
                                        <option value="TamilNadu" {{ old('state') == 'TamilNadu' ? 'selected' : '' }} >Tamil Nadu</option>
                                        <option value="Mumbai" {{ old('state') == 'Mumbai' ? 'selected' : '' }} >Mumbai</option>
                                        <option value="Kerala" {{ old('state') == 'Kerala' ? 'selected' : '' }} >Kerala</option>
                                        <option value="Karnadaka" {{ old('state') == 'Karnadaka' ? 'selected' : '' }} >Karnadaka</option>
                                </select>

                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                    <input type="radio" id="male" name="gender" value="male"  @if(old('gender') == 'male') checked @endif required>
                                    <label for="male">Male</label><br>
                                    <input type="radio" id="female" name="gender" value="female" @if(old('gender') == 'female') checked @endif required>
                                    <label for="female">Female</label><br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hobbies" class="col-md-4 col-form-label text-md-right">{{ __('Hobbies') }}</label>

                            <div class="col-md-6">
                                <div class="checkbox-group required">
                                    <input type="checkbox"  name="hobbies[]" value="cricket" @if(is_array(old('hobbies')) && in_array('cricket', old('hobbies'))) checked @endif>
                                    <label for="cricket"> Cricket</label><br>
                                    <input type="checkbox"  name="hobbies[]" value="reading book"  @if(is_array(old('hobbies')) && in_array('reading book', old('hobbies'))) checked @endif>
                                    <label for="reading book"> Reading Book</label><br>
                                    <input type="checkbox"  name="hobbies[]" value="watching tv"  @if(is_array(old('hobbies')) && in_array('watching tv', old('hobbies'))) checked @endif>
                                    <label for="watching_tv"> Watching Tv</label><br>
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary " id="Submit">
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

@endsection
