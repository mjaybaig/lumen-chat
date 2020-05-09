<body class="container" id="guestbook"> 
  <div class="col-md-8 col-md-offset-2">
    <div class="jumbotron">
      <h2>Lumen and Vue.js Single Page Application</h2>
      <h4>Simple Guestbook</h4>
    </div>
            
    <form v-on="submit: onCreate">
      <div class="form-group">
        <input type="text" class="form-control input-sm" name="author" v-model="author" placeholder="Name">
      </div>
            
      <div class="form-group">
        <input type="text" class="form-control input-sm" name="text" v-model="text" placeholder="Put here your text">
      </div>
            
      <div class="form-group text-right">   
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
      </div>
    </form>
                       
    <div class="comment" v-repeat="comment: comments">
      <h3>Comment # <small>by </h3>
      <p></p>
      <p><span class="btn btn-primary text-muted" v-on="click: onDelete(comment)">Delete</span></p>
    </div>
  </div>