<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laravel</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
    <style>
        /*
     Side Navigation Menu V2, RWD
     ===================
     License:
     https://goo.gl/EaUPrt
     ===================
     Author: @PableraShow

  */

        @charset "UTF-8";
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
            line-height: 1.42em;
            color: #A7A1AE;
            background-color: #1F2739;
        }

        h1 {
            font-size: 3em;
            font-weight: 300;
            line-height: 1em;
            text-align: center;
            color: #4DC3FA;
        }

        h2 {
            font-size: 1em;
            font-weight: 300;
            text-align: center;
            display: block;
            line-height: 1em;
            padding-bottom: 2em;
            color: #FB667A;
        }

        h2 a {
            font-weight: 700;
            text-transform: uppercase;
            color: #FB667A !important;
            text-decoration: none;
        }

        .blue {
            color: #185875;
        }

        .yellow {
            color: #FFF842;
        }

        .container-fluid th h1 {
            font-weight: bold;
            font-size: 1em;
            text-align: left;
            color: #185875;
        }

        .container-fluid td {
            font-weight: normal;
            font-size: 1em;
            -webkit-box-shadow: 0 2px 2px -2px #0E1119;
            -moz-box-shadow: 0 2px 2px -2px #0E1119;
            box-shadow: 0 2px 2px -2px #0E1119;
        }

        .container-fluid {
            text-align: left;
            overflow: hidden;
            display: table;
            padding: 0 0 8em 0;
        }

        .container-fluid td, .container-fluid th {
            border: 0px solid #fff;
            font-size: 0.8em;
            padding: 5px;
        }

        /* Background-color of the odd rows */
        .container-fluid tr:nth-child(odd) {
            background-color: #323C50;
        }

        /* Background-color of the even rows */
        .container-fluid tr:nth-child(even) {
            background-color: #2C3446;
        }

        .container-fluid th {
            background-color: #1F2739;
            font-size: 0.8em;
        }

        .container-fluid td:first-child {
            color: #FB667A;
        }

        .container-fluid tr:hover {
            background-color: #464A52;
            -webkit-box-shadow: 0 6px 6px -6px #0E1119;
            -moz-box-shadow: 0 6px 6px -6px #0E1119;
            box-shadow: 0 6px 6px -6px #0E1119;
        }

        .container-fluid td:hover {
            background-color: #FFF842;
            color: #403E10;
            font-weight: bold;

            box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
            transform: translate3d(6px, -6px, 0);

            transition-delay: 0s;
            transition-duration: 0.4s;
            transition-property: all;
            transition-timing-function: line;
        }

        @media (max-width: 800px) {
            .container-fluid td:nth-child(4),
            .container-fluid th:nth-child(4) {
                display: none;
            }
        }

        .pagination {
            float: right;
            margin-right: 30px;
        }

        .alert {
            border: 0px solid #000;
            border-radius: 0;
        }

        .page-link, .page-item.disabled .page-link {
            background-color: #2C3446;
            border: 0
        }
    </style>
</head>
<body>
<div class="container-fluid" id="app">
    <b-alert :show="dismissCountDown"
             dismissible
             variant="info"
             @dismissed="dismissCountDown=0"
             @dismiss-count-down="countDownChanged">
        <p>@{{ msg }} @{{dismissCountDown}}...</p>
        <b-progress variant="info"
                    :max="dismissSecs"
                    :value="dismissCountDown"
                    height="4px">
        </b-progress>
    </b-alert>
    <h1><span class="blue">&lt;</span>Query Notice<span class="blue">&gt;</span> <span class="yellow">PHPNO1</span></h1>
    <h2>Created with by <a href="https://github.com/phpno1" target="_blank">phpno1</a></h2>
    <div>
        <div class="form-group">
            <input type="text" class="form-control" v-model="params.key" placeholder="关键词"/>
        </div>
    </div>
    <!-- Content here -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">控制器</th>
            <th scope="col">函数</th>
            <th scope="col">执行sql</th>
            <th scope="col">查询时间</th>
            <th scope="col">状态</th>
            <th scope="col">创建时间</th>
            <th scope="col">修改时间</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(value,key) in notice">
            <th scope="row">@{{ value.id }}</th>
            <td>@{{ value.controller }}</td>
            <td>@{{ value.function }}</td>
            <td>@{{ value.query }}</td>
            <td>@{{ value.time }}</td>
            <td>@{{ is_deal[value.is_deal] }}</td>
            <td>@{{ value.created_at }}</td>
            <td>@{{ value.updated_at }}</td>
            <th scope="row"><a href="javascript:void(0)" @click="updateData(value.id)" class="btn btn-sm">标记处理</a></th>
        </tr>
        </tbody>
    </table>
    <b-pagination size="md" :total-rows="total" v-model="params.page" :per-page="perPage"/>
</div>
</body>
<!-- Scripts -->
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            notice: {},
            is_deal: {},
            total: 0,
            perPage: 1,
            dismissSecs: 5,
            dismissCountDown: 0,
            showDismissibleAlert: false,
            params: {
                key: '',
                page: 1,
            },
            msg: '',
        },
        methods: {
            getData() {
                let that = this;
                axios.post('/phpno1-notice', that.params)
                    .then(function (response) {
                        that.is_deal = response.data.is_deal;
                        that.notice = response.data.notices.data;
                        that.perPage = response.data.notices.per_page;
                        that.params.page = response.data.notices.current_page;
                        that.total = response.data.notices.total;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            updateData(id) {
                let that = this;
                axios.post('/phpno1-notice/update', {'id': id})
                    .then(function (response) {
                        that.msg = response.data.message;
                        that.dismissCountDown = that.dismissSecs;
                        that.getData();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            countDownChanged(dismissCountDown) {
                let that = this;
                that.dismissCountDown = dismissCountDown
            },
        },
        mounted: function () {
            this.getData();
        },
        watch: {
            'params.page': function ($newVal) {
                this.getData();
            },
            'params.key': function ($newVal) {
                console.log($newVal);
                this.getData();
            }
        }
    });
</script>
</html>
