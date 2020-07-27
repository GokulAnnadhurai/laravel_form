@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('MemberController@update',$user->id) }}"enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

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
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $user->mobile }}" >

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

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
                               
                                <input type="file" name="image" id="image"  class="form-control" >
                                 @if($user->image)
                                    <img src="/images/{{ $user->image }}" width="50px">
                                @endif

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
                                <textarea  id="address" type="textarea" class="form-control @error('address') is-invalid @enderror" name="address"  required >{{$user->address}}</textarea>

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
                                    <select name="city" id="city" class="form-control " required="required">
                                            <option value="">Select city</option>
                                            <option value="chennai" {{ ($user->city == 'chennai')?'selected':'' }}>Chennai</option>
                                            <option value="namakkal" {{ ($user->city == 'namakkal')?'selected':'' }}>Namakkal</option>
                                            <option value="erode" {{ ($user->city == 'erode')?'selected':'' }}>Erode</option>
                                            <option value="salem" {{ ($user->city == 'salem')?'selected':'' }}>Salem</option>
                                    </select>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                    <select name="state" id="state" class="form-control" required="required">
                                        <option value="">Select state</option>
                                        <option value="TamilNadu" {{ $user->state == 'TamilNadu' ? 'selected' : '' }} >Tamil Nadu</option>
                                        <option value="Mumbai" {{ $user->state == 'Mumbai' ? 'selected' : '' }} >Mumbai</option>
                                        <option value="Kerala" {{ $user->state == 'Kerala' ? 'selected' : '' }} >Kerala</option>
                                        <option value="Karnadaka" {{ $user->state == 'Karnadaka' ? 'selected' : '' }} >Karnadaka</option>
                                    </select>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                    <input type="radio" id="male" name="gender" value="male" required="required" {{ ($user->gender == 'male')?'checked':'' }}>
                                    <label for="male">Male</label><br>
                                    <input type="radio" id="female" name="gender" value="female" required="required" {{ ($user->gender == 'female')?'checked':'' }}>
                                    <label for="female">Female</label><br>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hobbies" class="col-md-4 col-form-label text-md-right">{{ __('Hobbies') }}</label>
                           

                            <div class="col-md-6">
                                        <input type="checkbox"  name="hobbies[]" {{ in_array('cricket', unserialize($user->hobbies))?"checked":'' }} value="cricket">
                                        <label for="cricket"> Cricket</label><br>
                                        <input type="checkbox"  name="hobbies[]" value="reading book" {{ in_array('reading book', unserialize($user->hobbies))?"checked":'' }}> 
                                        <label for="reading book"> Reading Book</label><br>
                                        <input type="checkbox"  name="hobbies[]" value="watching tv" {{ in_array('watching tv', unserialize($user->hobbies))?"checked":'' }}>
                                        <label for="watching_tv"> Watching Tv</label><br>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
