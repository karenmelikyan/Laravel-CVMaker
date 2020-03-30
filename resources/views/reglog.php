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
<h5>{{ message }}</h5></br>
</template>

    <template v-if="user == 0">
        <form name="registration">
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
        </form>

        <div>
            <button @click="registration()" class="btn btn-primary">Registration</button>
        </div>
    </template>

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

