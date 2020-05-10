<html>
<head>
<script src="https://kit.fontawesome.com/beca40f6b2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #ff8100; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .navbar-light .navbar-brand{
            color: #782100;
        }
        .btn-outline-primary {
            color: #ff8100;
            border-color: #ff8100;
        }
        .btn-outline-primary:hover {
            color: #fff;
            background-color: #ff8100;
            border-color: #ff8100;
        }
        .btn-outline-primary.focus, .btn-outline-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 94, 0, 0.25);
        }
        .btn-outline-primary:not(:disabled):not(.disabled):active{
            color: #fff;
            background-color: #ff8100;
            border-color: #ff8100;
        }
        .btn-outline-primary:not(:disabled):not(.disabled):active:focus{
            box-shadow: 0 0 0 0.2rem rgba(255, 59, 0, 0.5);
        }
        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #ffa980;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 94, 0, 0.25);
        }
        .messages{
            height:350;
            overflow-y: scroll;
        } 

        #guestbook{
            height: -webkit-fill-available;
        }
    </style>
</head>
    <body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/vue/0.12.1/vue.min.js"></script>
        <nav class="navbar navbar-light" style="background-color: #fdefe3;">
            <a class='navbar-brand' href='#'>Dusk Chat</a>
        </nav>
        <div class="container d-flex flex-column justify-content-center align-items-center flex-wrap" id="guestbook"> 
                <div class="col-md-12" v-if='loading'>
                    <div class="loader mx-auto"></div>
                </div>
                <div v-if='!loading' class="col-md-12 mb-4">
                    <div id='chatArea' class="messages overflow-auto list-group">
                        <div class="list-group-item list-group-item-action" v-repeat = "message: messages">
                            <small class='float-right'><b>Sent</b> {{message.created_at | formatDate}}</small>
                            <p class="mb-1">{{message.message}}</p>
                        </div>
                    </div>
                </div>
                <div class='col-md-12 mt-3'>
                    <form v-on="submit: onCreate" class='col-md-12'>
                        <div class="form-group row">
                            <div class="input-group">
                                <input type="text" class="col-md-12 form-control form-control-lg" name="text" v-model="text" placeholder="Type Message Here"  aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit"><i class='fas fa-paper-plane'></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="row">
            </div> -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
        <script type="text/javascript">
           Vue.filter('formatDate', function(value) {
               if (value) {
                   return moment(String(value)).format('MM/DD/YYYY hh:mm')
                }
            });
            new Vue({ 
                el: '#guestbook',
                data: {
                    messages: [],
                    text: '',
                    loading: true
                },
                ready: function() {
                    this.getMessages();
                },
                methods: {
                    getMessages: function() {
                        $.ajax({
                            context: this,
                            url: "/api/chats",
                            success: function (result) {
                                console.log(result)
                                this.$set("loading", false);
                                this.$set("messages", result) 
                            }
                        })
                    },
                    onCreate: function(e) {
                        this.$set("loading", true);
                        e.preventDefault()
                        $.ajax({
                            context: this,
                            type: "POST",
                            data: {
                                message: this.text
                            },
                            url: "/api/chat",
                            success: function(result) {
                                console.log(result);
                                this.messages.push(result);
                                this.text = '';
                                Vue.nextTick(()=>{
                                    this.$set("loading", false);
                                    document.getElementById('chatArea').scrollTop = document.getElementById('chatArea').scrollHeight;
                                })
                            }                        
                            });
                    },
                    onDelete: function (comment) {
                        $.ajax({
                            context: comment,
                            type: "DELETE",
                            url: "/api/comment/" + comment.id,
                        })
                        this.comments.$remove(comment);
                    }
                }
        })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
  </html>