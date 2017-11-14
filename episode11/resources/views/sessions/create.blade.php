@extends ('layouts.master')

@section ('content')
    <div class="col-md-8">
        <h1>Sign in</h1>

            <form action="/sessions" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        @include ('layouts.errors')
    </div>
@endsection