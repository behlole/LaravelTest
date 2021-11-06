<template>
    <div>
        <header_vue></header_vue>
        <router-view></router-view>
        <footer_vue>
        </footer_vue>

    </div>
</template>
<script>
import header_vue from "./header";
import footer_vue from "./footer";

export default {
    name: "app",
    components: {footer_vue, header_vue},
}
</script>
<style scoped>
</style>
