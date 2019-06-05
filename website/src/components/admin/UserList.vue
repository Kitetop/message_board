<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-06-04
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col :span="6">
                <el-select v-model="initValue"
                           @change="setActive"
                           size="mini">
                    <el-option label="正常" value="0"></el-option>
                    <el-option label="封禁" value="1"></el-option>
                </el-select>
            </el-col>
            <el-col :offset="8" :span="6">
                <el-input type="text" placeholder="查询条件"
                          v-model="query"
                          style="width: 100%" size="mini"></el-input>
            </el-col>
            <el-col :span="4">
                <el-button size="mini" type="success" plain @click="search"
                           icon="el-icon-search">查找
                </el-button>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <!--用户信息记录表-->
                <div style="padding-top: 10px;width: 670px">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="text-danger">
                            <th class="text-center">序号</th>
                            <th class="text-center">账号</th>
                            <th class="text-center">用户名</th>
                            <th class="text-center">用户头像</th>
                            <th class="text-center">用户性别</th>
                            <th class="text-center">用户状态</th>
                            <th class="text-center">用户身份</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-for="(user, index) in users">
                            <td>{{user.id}}</td>
                            <td><el-link type="info" @click="UserInfo(user.id)">{{user.account}}</el-link></td>
                            <td>{{user.username}}</td>
                            <td><img :src="user.image" class="image"></td>
                            <td>{{user.sex}}</td>
                            <td>{{user.active}}</td>
                            <td>{{user.status}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </el-col>
        </el-row>

        <!--分页部分-->
        <div style="text-align: center">
            <Page v-bind:total='total'
                  v-bind:size='size'
                  @change-page = 'changePage'
            ></Page>
        </div>
    </div>
</template>

<script>
    import Page from '../Page';
    import qs from 'qs';
    export default {
        name: 'UserList',
        components: {Page},
        data () {
            return {
                show: false,
                initValue: '正常',
                query: null, //模糊查找的用户的账号
                total: 0,
                active: 0,
                size: 5,
                users: {},
            }
        },
        created() {
            this.userList();
        },
        methods: {
            showDialog () {
                this.show = !this.show
            },
            /**
             * 根据条件查找用户
             */
            search () {
                this.userList(1, this.query, this.active);
            },
            userList(page = 1, query = null, active = 0, limit = 5) {
                let userId = this.$cookies.get('userId');
                this.axios({
                    url: this.HOST.HOST + 'user/list',
                    method: 'get',
                    params: {
                        id: userId,
                        page: page,
                        active: active,
                        query: query,
                        limit: limit,
                    }
                }).then(res => {
                    if(res.data.status === 0) {
                        let data = res.data.data;
                        this.total = Number(data.total);
                        delete data['total'];
                        this.users = data;
                    } else {
                        alert(res.data.message);
                    }
                })
            },
            /**
             * 更新页数
             * @param page
             */
            changePage(page) {
                this.userList(page);
            },

            /**
             * 设置检索的用户状态
             * @param value
             */
            setActive(value) {
                this.active = value;
                this.userList(1, null, value)
            },

            /**
             * 查看指定用户的个人信息
             * @param id
             */
            UserInfo(id) {
                this.$router.push({path: '/admin/user/info', query: {id: id}})
            },
        },
    }
</script>

<style scoped>
    table td {
        vertical-align: middle !important;
    }
    .image {
        border-color: aliceblue;
        border-style: solid;
        height: 100px;
        width: 100px;
    }
</style>
