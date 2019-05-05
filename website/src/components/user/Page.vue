<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.                        *
*   Date: 2019-05-04                             *
------------------------------------------------->
<template>
    <el-pagination
            @current-change = 'currentPage'
            background
            layout="total, prev, pager, next"
            :page-size=size
            :total= total>
    </el-pagination>
</template>

<script>
    export default {
        name: "Page",
        props:['total', 'size'],
        methods: {
            currentPage(page) {
                this.$emit('change-page', page)
            },
        }
    }
</script>

<style scoped>

</style>
