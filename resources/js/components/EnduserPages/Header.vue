<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>



            </ul>

            <div class="text-end">
                <a href="/login" type="button" class="btn btn-outline-light me-2">Login</a>
                <a href="/register" type="button" class="btn btn-warning">Sign-up</a>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>

</style>
