<template>
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <center>
                    <p>Redirecting to the support server...</p>
                </center>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get(this.$route.fullPath + '?raw=yes').then(response => {
                if (response.status == 200) {
                    setTimeout(() => {
                        window.location.href = response.data;
                    }, 650);
                }
            });
        }
    }
</script>
