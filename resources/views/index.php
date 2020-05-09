<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
    <body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/vue/0.12.1/vue.min.js"></script>
        <div class="container" id="guestbook"> 
            <div class="col-md-8 col-md-offset-2">
                <div class="jumbotron">
                    <h2>Lumen and Vue.js Single Page Application</h2>
                    <h4>Simple Guestbook</h4>
                </div>
                        
                <form v-on="submit: onCreate">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" name="text" v-model="text" placeholder="Type Message Here">
                    </div>
                            
                    <div class="form-group text-right">   
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
                                
                <div class="comment" v-repeat="message: messages">
                    <p>{{message.message}}</p>
                </div>
        </div>

  <script type="text/javascript">

        new Vue({ 
        el: '#guestbook',
        data: {
            messages: [],
            text: ''
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
                    this.$set("messages", result) 
                }
            })
            },
            onCreate: function(e) {
                e.preventDefault()
                $.ajax({
                    context: this,
                    type: "POST",
                    data: {
                        message: this.text
                    },
                    url: "/api/chat",
                    success: function(result) {
                        this.messages.push(result);
                        this.text = ''
                    }
                })                        
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