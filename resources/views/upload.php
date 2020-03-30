<template v-if="cv_step == 0">
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
    <form method="post" action="/index.php/upload" enctype="multipart/form-data">
        <meta name="_token" value="{{ csrf_token() }}">
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


