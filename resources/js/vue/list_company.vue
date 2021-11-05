<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th> Name</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td v-for="(item,index) in items" :key="index">{{ item }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "list_company",
    props: ['items'],
}
</script>

<style scoped>

</style>
