<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release:v1.0                        *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <div>
        <el-row style="margin-bottom: 20px">
            <el-col :span="18" :offset="3">
                <router-view/>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="6" :offset="3">
                <div @click="index"  style="text-align: center" v-bind:class="choose[0]">
                    <i class="el-icon-discount" style="font-size: 20px"></i>
                    <p>首页</p>
                </div>
            </el-col>
            <el-col :span="6">
                <div @click="message" style="text-align: center" v-bind:class="choose[1]">
                    <i class="el-icon-message" style="font-size: 20px"></i>
                    <p>消息</p>
                </div>
            </el-col>
            <el-col :span="6">
                <div @click="center" style="text-align: center" v-bind:class="choose[2]">
                    <i class="el-icon-s-custom" style="font-size: 20px"></i>
                    <p>我</p>
                </div>
            </el-col>
        </el-row>
    </div>
</template>
<script>
    export default {
        name: "Mian",
        data() {
            return {
                background: 'choose',
                choose: [],
            }
        }

        ,
        methods: {
            index() {
                this.choose.splice(0, 3);
                this.choose[0] = this.background;
            },
            message() {
                this.choose.splice(0, 3);
                this.choose[1] = this.background;
            },
            center() {
                this.choose.splice(0, 3);
                this.choose[2] = this.background;
            }
        },
        created() {
            this.index();
        }
    }
</script>

<style scoped>
    .choose {
        background: #409EFF;
        color: #E4E7ED;
    }
</style>
