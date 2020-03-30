<template v-if="cv_step == 1">
    <button  @click="logout()" class="small">log out</button>
    <br>
    <br>
    <h5>Hello, {{username}}!</h5>
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
    {{ message }}
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
