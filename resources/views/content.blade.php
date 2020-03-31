@extends('layout')
@section('content')

    {{--
      *
      *
      *
      *
      * REG/LOG part
      *
      *
      *
      *
      *
      --}}

    <template v-if="user == 0 || user == 1 || user == -1">
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

        <a @click="reg()">Registration /</a>
        <a @click="log()">Login</a>
        <br>
        <br>
        <h5>@{{ message }}</h5></br>
    </template>

    {{-- Registration --}}
    <template v-if="user == 0">
        <form name="registration">
            <div class="form-group">
                <h6>username</h6>
                <input  name="username" type="text" class="form-control"></input>
            </div>

            <div class="form-group">
                <h6>email</h6>
                <input name="email" type="email" class="form-control"></input>
            </div>

            <div class="form-group">
                <h6>password</h6>
                <input name="password" type="password" class="form-control"></input>
            </div>

            <div class="form-group">
                <h6>password confirm</h6>
                <input name="passConf" type="password" class="form-control"></input>
            </div>
        </form>

        <div>
            <button @click="registration()" class="btn btn-primary">Registration</button>
        </div>
    </template>

    {{--Login--}}
    <template v-if="user == 1">
        <form name="login">
            <div class="form-group">
                <h6>username</h6>
                <input  name="username" type="text" class="form-control"></input>
            </div>

            <div class="form-group">
                <h6>password</h6>
                <input name="password" type="password" class="form-control"></input>
            </div>
        </form>

        <div>
            <button @click="login()" class="btn btn-primary">Log in</button>
        </div>
    </template>

    {{--
      *
      *
      *
      *
      * PERSONALS DATA SAVE PART
      *
      *
      *
      *
      *
      --}}

    <template v-if="cv_step == 0">
        <button  @click="logout()" class="small">log out</button>
        <br>
        <br>
        <h5>Hello, @{{username}}!</h5>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        <h2>Welcome to CV Maker</h2>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
        <h5>@{{ message }}</h5>
        <form name="personals">
            <div class="form-group">
                <input  name="name" type="text" placeholder="name" class="form-control"></input>
            </div>

            <div class="form-group">
                <input name="last_name" type="text" placeholder="last name" class="form-control"></input>
            </div>

            <div class="form-group">
                <input name="address" type="text" placeholder="address" class="form-control"></input>
            </div>

            <div class="form-group">
                <input name="phone" type="text" placeholder="phone" class="form-control"></input>
            </div>

            <div class="form-group">
                <input name="email" type="email" placeholder="eMail" class="form-control"></input>
            </div>
        </form>

        <div>
            <button @click="personalsSave()" class="btn btn-primary">Save</button>
        </div>
    </template>

    {{--
      *
      *
      *
      *
      * GENERIC DATA SAVE PART
      *
      *
      *
      *
      *
      --}}

    <template v-if="cv_step == 1">
        <button  @click="logout()" class="small">log out</button>
        <br>
        <br>
        <h5>Hello, @{{username}}!</h5>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        <h2>Welcome to CV Maker</h2>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
        <h5>@{{ message }}</h5>
        <form name="generic">
            <div class="form-group">
                    <textarea name="about"
                              placeholder="write something ABOUT yourself through line breaks (enter)" name="about" type="text" rows="3" class="form-control">
                    </textarea>
            </div>

            <div class="form-group">
                    <textarea name="experience"
                              placeholder="list your job EXPERIENCE through line breaks ..." name="experience" type="text" rows="3" class="form-control">
                    </textarea>
            </div>

            <div class="form-group">
                    <textarea name="skills"
                              placeholder="list your job SKILLS through line breaks ..." name="skills" type="text" rows="3" class="form-control">
                    </textarea>
            </div>
        </form>

        <div>
            <button @click="genericSave()" class="btn btn-primary">Save</button>
        </div>
    </template>

    {{--
      *
      *
      *
      *
      * PHOTO UPLOAD / CV DOWNLOAD PART
      *
      *
      *
      *
      *
      --}}

    <template v-if="cv_step == 2">
        <button  @click="logout()" class="small">log out</button>
        <br>
        <br>
        <h5>Hello, @{{username}}!</h5>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        <h2>Welcome to CV Maker</h2>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
        <h5>@{{ message }}</h5>
        <form method="post" action="/index.php/download" enctype="multipart/form-data">
            @csrf
            __
            <br>
            <br>
            <br>
            __
            <br>
            <br>
            <br>
            __
            <br>
            <br>
            <br>
            <input type="file" name="file" class="small">
            <br>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Download CV</button>
            </div>
        </form>
        <br>
        <a @click="reset()"><< Reset & start again</a>
    </template>

    <script>
        var vue = new Vue({
            el: '#app',
            data:{
                user: -1,
                message: '',
                cv_step: -1,
                username: '',
            },

            methods:{

                reset(){

                    axios.get('/index.php/reset')
                        .then(response =>{
                            this.message  = response.data.message;
                            this.cv_step  = response.data.cv_step;
                            this.user     = response.data.user;
                            this.username = response.data.username;
                        })
                },

                genericSave(){

                    let about = document.generic.about.value;
                    about = about.replace(/(?:\r\n|\r|\n)/g, '|*|');

                    let experience = document.generic.experience.value;
                    experience = experience.replace(/(?:\r\n|\r|\n)/g, '|*|');

                    let skills = document.generic.skills.value;
                    skills = skills.replace(/(?:\r\n|\r|\n)/g, '|*|');

                    axios.get('/index.php/generics/' + about + '/' + experience + '/' + skills)
                        .then(response =>{
                            this.message  = response.data.message;
                            this.cv_step  = response.data.cv_step;
                            this.user     = response.data.user;
                            this.username = response.data.username;
                        })
                },

                personalsSave(){

                    let name = document.personals.name.value;
                    let last_name = document.personals.last_name.value;
                    let address = document.personals.address.value;
                    let phone = document.personals.phone.value;
                    let email = document.personals.email.value;

                    axios.get('/index.php/personals/' + name + '/' + last_name + '/' + address + '/' + phone + '/' + email)
                        .then(response => {

                            this.message  = response.data.message;
                            this.cv_step  = response.data.cv_step;
                            this.user     = response.data.user;
                            this.username = response.data.username;
                        })
                },

                logout(){

                    axios.get('/index.php/logout')
                        .then(response => {
                            this.message  = response.data.message;
                            this.cv_step  = response.data.cv_step;
                            this.user     = response.data.user;
                            this.username = response.data.username;
                        })

                },

                login(){

                    let username = document.login.username.value;
                    let password = document.login.password.value

                    axios.get('/index.php/login/' + username + '/' + password)
                        .then(response => {
                            this.message  = response.data.message;
                            this.cv_step  = response.data.cv_step;
                            this.user     = response.data.user;
                            this.username = response.data.username;
                        })
                },

                registration(){

                    let username = document.registration.username.value;
                    let email    = document.registration.email.value;
                    let password = document.registration.password.value;
                    let passConf = document.registration.passConf.value;

                    axios.get('/index.php/registration/' + username + '/' + email + '/' + password + '/' + passConf)
                        .then(response => {
                            this.message  = response.data.message;
                            this.cv_step  = response.data.cv_step;
                            this.user     = response.data.user;
                            this.username = response.data.username;
                        })
                },

                reg(){
                    this.user = 0;
                },

                log(){
                    this.user = 1;
                },

            }
        });
    </script>
@endsection()


