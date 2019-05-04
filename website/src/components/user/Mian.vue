<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release:v1.0                        *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <el-container>
        <el-main>
            <el-row style="margin-bottom: 20px">
                <el-col :span="16" :offset="4">
                    <router-view @change-index="changeIndex"/>
                </el-col>
            </el-row>
        </el-main>
        <el-footer class="footer">
            <el-row>
                <el-col :span="4" :offset="4">
                    <div @click="index" style="text-align: center" v-bind:class="choose[0]">
                        <i class="el-icon-discount" style="font-size: 20px"></i>
                        <p>首页</p>
                    </div>
                </el-col>
                <el-col :span="4">
                    <div @click="add" style="text-align: center" v-bind:class="choose[1]">
                        <i class="el-icon-plus" style="font-size: 20px"></i>
                        <p>添加</p>
                    </div>
                </el-col>
                <el-col :span="4">
                    <div @click="message" style="text-align: center" v-bind:class="choose[2]">
                        <i class="el-icon-message" style="font-size: 20px"></i>
                        <p>消息</p>
                    </div>
                </el-col>
                <el-col :span="4">
                    <div @click="center" style="text-align: center" v-bind:class="choose[3]">
                        <i class="el-icon-s-custom" style="font-size: 20px"></i>
                        <p>我</p>
                    </div>
                </el-col>
            </el-row>
        </el-footer>
    </el-container>
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
            changeIndex()
            {
                this.choose.splice(0,4);
            },
            index() {
                this.choose.splice(0, 4);
                this.choose[0] = this.background;
                this.$router.push({path: '/'})
            },
            add() {
                this.choose.splice(0,4);
                this.choose[1] = this.background;
            },
            message() {
                this.choose.splice(0, 4);
                this.choose[2] = this.background;
            },
            center() {
                this.choose.splice(0, 4);
                this.choose[3] = this.background;
            }
        },
        created() {
            this.choose[0] = this.background;
        }
    }
</script>

<style scoped>
    .choose {
        background: #409EFF;
        color: #E4E7ED;
    }
    .footer {
        position:fixed;
        bottom: 0px;
        width:100%;
    }
</style>
