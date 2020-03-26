@extends('layout')
@section('content')
    <h5>Hi!</h5>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>
                    <h2>Find job with CV Maker</h2>
                </th>
            </tr>
            </thead>
        </table>
    </div>
    <div id="reglog">
        <a @click="reg()">Registration /</a>
        <a @click="log()">Login</a>
        <br>
        <br>
        <h5>{{$message}}</h5></br>
        <template v-if="user == 0">
            <form method="post" action="/">
                @csrf
                <input type="hidden" name="action" value="registration">
                <div class="form-group">
                    <h6>username</h6>
                    <input  name="username" type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                    <h6>password</h6>
                    <input name="password" type="password" class="form-control"></input>
                </div>

                <div class="form-group">
                    <h6>password confirm</h6>
                    <input name="passConf" type="password" class="form-control"></input>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Registration</button>
                </div>
            </form>
        </template>

        <template v-if="user == 1">
            <form method="post" action="/">
                @csrf
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <h6>username</h6>
                    <input  name="username" type="text" class="form-control"></input>
                </div>

                <div class="form-group">
                    <h6>password</h6>
                    <input name="password" type="password" class="form-control"></input>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </form>
        </template>
    </div>

    <script>
        var vue = new Vue({
            el: '#reglog',
            data:{
                user: -1,
            },
            methods:{
                reg(){
                    this.user = 0;
                },

                log(){
                    this.user = 1;
                },
            },
        });
    </script>
@endsection()
