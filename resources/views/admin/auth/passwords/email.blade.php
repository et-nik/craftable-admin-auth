@extends('brackets/admin-auth::admin.layout.simple')

@section('body')
    <div class="row">
        <div class="col-md-8 m-x-auto pull-xs-none vamiddle">
            <div class="card-group ">
                <div class="card p-a-2">
                    <div class="card-block">
                        <user-form
                            :action="'{{ route('brackets/admin-auth:admin/password/sendResetLinkEmail') }}'"
                            :data="{ 'email': '{{ old('email', '') }}' }"
                            inline-template>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('brackets/admin-auth:admin/password/sendResetLinkEmail') }}">
                                {{ csrf_field() }}
                                <h1>Reset Password</h1>
                                <p class="text-muted">Send password reset e-mail.</p>
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <div class="form-group row" :class="{'has-danger': errors.has('email'), 'has-success': this.fields.email && this.fields.email.valid }">
                                    <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="text" v-model="form.email" v-validate="'required|email'" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': this.fields.email && this.fields.email.valid}" id="email" name="email" placeholder="Email">
                                        <div v-if="errors.has('email')" class="form-control-feedback" v-cloak>@{{ errors.first('email') }}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="hidden" name="remember" value="1">
                                        <button type="submit" class="btn btn-primary p-x-2">Send Password Reset Link</button>
                                    </div>
                                </div>
                            </form>
                        </user-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection