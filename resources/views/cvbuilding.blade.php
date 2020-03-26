@extends('layout')
@section('content')
    <form method="post" action="/">
        @csrf
        <input type="hidden" name="action" value="logout">
        <div><button class="small" type="submit">log out</button></div>
    </form>
    </br>
    <h5>Hello, {{$username}}!</h5>
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
    <div id="cv_forms">
        <template v-if="cv_step == 0">
            <h5>{{$message ?? ''}}</h5>
            <form method="post" action="/" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action" value="upload">
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
                    <button type="submit" class="btn btn-primary">Upload Photo</button>
                </div>
            </form>
        </template>

        <template v-if="cv_step == 1">
            <h5>{{$message ?? ''}}</h5>
            <form method="post" action="/">
                @csrf
                <input type="hidden" name="action" value="personals">

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

                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </template>

        <template v-if="cv_step == 2">
            <h5>{{$message ?? ''}}</h5>
            <form method="post" action="/">
                @csrf
                <input type="hidden" name="action" value="generics">
                <div class="form-group">
                    <textarea
                        placeholder="write something ABOUT yourself through line breaks (enter)" name="about" type="text" rows="3" class="form-control">
                    </textarea>
                </div>

                <div class="form-group">
                    <textarea
                        placeholder="list your job EXPERIENCE through line breaks ..." name="experience" type="text" rows="3" class="form-control">
                    </textarea>
                </div>

                <div class="form-group">
                    <textarea
                        placeholder="list your job SKILLS through line breaks ..." name="skills" type="text" rows="3" class="form-control">
                    </textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </template>

        <template v-if="cv_step == 3">
            <h5>{{$message ?? ''}}</h5>
            <form method="post" action="/">
                @csrf
                <input type="hidden" name="action" value="download">
                <h5>Your CV is ready!</h5>
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
                <a @click="reset()"> << Reset & start again</a>
                <br>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary">Download</button>
                </div>
            </form>
        </template>
    </div>

    <script>
        var vue = new Vue({
            el: '#cv_forms',
            data:{
                cv_step: {{$cv_step}},
            },
            methods:{
                reset(){
                    this.cv_step = 0;
                }
            },
        });
    </script>
@endsection()

